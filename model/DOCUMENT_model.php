<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/DOCUMENT.php");
require_once(__DIR__."/../model/ALUMN_model.php");
require_once(__DIR__."/../model/EMPLOYEE_model.php");

class DocumentMapper {

    private $db;
    private $alumnMapper;
    private $employeeMapper;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
        $this->employeeMapper = new EmployeeMapper();
        $this->alumnMapper = new AlumnMapper();
    }

    public function categorynameExists($categoryname) {
        $stmt = $this->db->prepare("SELECT count(*) FROM categoria where nombre=?");
        $stmt->execute(array($categoryname));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    public function add(Document $document) {

        $stmt = $this->db->prepare("INSERT INTO documento(fecha_firma, id_alumno, nombre, ruta, id_empleado) VALUES (?, ? , ?, ?, ?)");
        $stmt->execute(array($document->getSigndate(), $document->getAlumn()->getCodalumn(), $document->getName(), $document->getRoute(), $document->getEmployee()->getCodemployee()));

        return $this->db->lastInsertId();
    }


    public function show() {

        $stmt = $this->db->prepare("SELECT * FROM documento");
        $stmt->execute();
        $docs_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $docs = array();

        foreach ($docs_db as $doc) {
            array_push($docs, $this->view($doc["id_documento"]));
        }
        return $docs;
    }

    public function view($coddocument){
        $stmt = $this->db->prepare("SELECT * FROM documento WHERE id_documento=?");
        $stmt->execute(array($coddocument));
        $doc = $stmt->fetch(PDO::FETCH_ASSOC);

        if($doc != null) {
            return new Document(
                $doc["id_documento"],
                $doc["fecha_firma"],
                $doc["nombre"],
                $doc["ruta"],
                $this->alumnMapper->view($doc["id_alumno"]),
                $this->employeeMapper->view($doc["id_empleado"])
            );
        } else {
            return new Document();
        }
    }

    public function showdocsAlumn($codalumn) {

        $stmt = $this->db->prepare("SELECT * FROM documento WHERE id_alumno = ?");
        $stmt->execute(array($codalumn));
        $docs_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $docs = array();

        foreach ($docs_db as $doc) {
            array_push($docs, $this->view($doc["id_documento"]));
        }
        return $docs;
    }


    public function getDay(){
        $stmt = $this->db->query("SELECT CURDATE()");
        $db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($db != NULL){
            $actual = $db[0];
            return  $actual['CURDATE()'];

        }
    }
}
