<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/ALUMN.php");


class AlumnMapper {

    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    //return: o id da action co nome $actionname
    public function getIdByName($actionname)
    {
        $stmt = $this->db->prepare("SELECT id_accion FROM accion WHERE  nombre= ?");
        $stmt->execute(array($actionname));

        return $stmt->fetch(PDO::FETCH_ASSOC)['id_accion'];
    }

    public function alumndniExists($dni) {
        $stmt = $this->db->prepare("SELECT count(*) FROM alumno where dni_alumno=?");
        $stmt->execute(array($dni));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    //Inserta na base de datos unha tupla cos datos do obxeto $alumn
    public function add(Alumn $alumn) {
        $stmt = $this->db->prepare("INSERT INTO alumno (dni_alumno, nombre, apellidos, fecha_nac, profesion, direccion_postal, email, comentarios, clases_pendientes) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute(array($alumn->getDni(), $alumn->getAlumnname(), $alumn->getAlumnsurname(), $alumn->getBirthdate(), $alumn->getJob(), $alumn->getAddress(),
                            $alumn->getEmail(), $alumn->getComment(), $alumn->getPendingclasses()));

        return $this->db->lastInsertId();
    }


    //Funcion de listar: devolve un array de todos obxetos Alumn correspondentes á tabla Alumno
    public function show() {

        $stmt = $this->db->query("SELECT * FROM alumno");
        $alumn_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $alumns = array();

        foreach ($alumn_db as $alumn) {
            array_push($alumns, $this->view($alumn['id_alumno']));
        }

        return $alumns;
    }


    //devolve o obxecto Alumn no que o $codalumn coincida co da tupla.
    public function view($codalumn){
        $stmt = $this->db->prepare("SELECT * FROM alumno WHERE id_alumno=?");
        $stmt->execute(array($codalumn));
        $alumn = $stmt->fetch(PDO::FETCH_ASSOC);

        if($alumn != null) {
            return new Alumn(
                $alumn['id_alumno'],
                $alumn['dni_alumno'],
                $alumn['nombre'],
                $alumn['apellidos'],
                $alumn['fecha_nac'],
                $alumn['profesion'],
                $alumn['direccion_postal'],
                $alumn['email'],
                $alumn['comentarios'],
                $alumn['clases_pendientes']
            );
        } else {
            return new Alumn();
        }
    }

    //edita a tupla correspondente co id do obxecto Alumn $alumn
    public function edit(Alumn $alumn) {
        $stmt = $this->db->prepare("UPDATE alumno SET dni_alumno = ?, nombre = ?, apellidos = ?, fecha_nac = ?, profesion = ?, direccion_postal = ?, 
                                            email = ?, comentarios = ?, clases_pendientes = ? 
                                              WHERE id_alumno = ?");
        $stmt->execute(array($alumn->getDni(), $alumn->getAlumnname(), $alumn->getAlumnsurname(), $alumn->getBirthdate(), $alumn->getJob(), $alumn->getAddress(),
                            $alumn->getEmail(), $alumn->getComment(), $alumn->getPendingclasses(), $alumn->getCodalumn() ));
    }


    //borra sobre a taboa alumno a tupla con id igual a cod pasado
    public function delete($codalumn) {
        $stmt = $this->db->prepare("DELETE from alumno WHERE id_alumno = ?");
        $stmt->execute(array($codalumn()));
    }

    public function search(Alumn $alumn){
        if($alumn->getDni() == NULL){
            if($alumn->getPendingclasses() != NULL){
                $stmt = $this->db->prepare("SELECT * FROM alumno WHERE nombre like ? AND apellidos like ? AND profesion like ? AND direccion_postal like ? AND clases_pendientes = ?");
                $stmt->execute(array("%".$alumn->getAlumnname()."%", "%".$alumn->getAlumnsurname()."%", "%".$alumn->getJob()."%", "%".$alumn->getAddress()."%", $alumn->getPendingclasses()));
            }else{
                $stmt = $this->db->prepare("SELECT * FROM alumno WHERE nombre like ? AND apellidos like ? AND profesion like ? AND direccion_postal like ? ");
                $stmt->execute(array("%".$alumn->getAlumnname()."%", "%".$alumn->getAlumnsurname()."%", "%".$alumn->getJob()."%", "%".$alumn->getAddress()."%"));
            }
        }else{
            if($alumn->getPendingclasses() != NULL) {
                $stmt = $this->db->prepare("SELECT * FROM alumno WHERE dni_alumno = ? AND nombre like ? AND apellidos like ? AND profesion like ? AND direccion_postal like ?  AND clases_pendientes = ?");
                $stmt->execute(array($alumn->getDni(), "%" . $alumn->getAlumnname() . "%", "%" . $alumn->getAlumnsurname() . "%", "%" . $alumn->getJob() . "%", "%" . $alumn->getAddress() . "%",
                    $alumn->getPendingclasses()));
            }else{
                $stmt = $this->db->prepare("SELECT * FROM alumno WHERE dni_alumno = ? AND nombre like ? AND apellidos like ? AND profesion like ? AND direccion_postal like ?");
                $stmt->execute(array($alumn->getDni(), "%" . $alumn->getAlumnname() . "%", "%" . $alumn->getAlumnsurname() . "%", "%" . $alumn->getJob() . "%", "%" . $alumn->getAddress() . "%" ));
            }
        }

        $alumns_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $alumns = array();
        foreach ($alumns_db as $a){
            array_push($alumns, $this->view($a['id_alumno']));
        }
        return $alumns;
    }

    public function validar_fecha_nac($date){

        $stmt = $this->db->query("SELECT CURDATE()");
        $db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($db != NULL){
            $actual = $db[0];

            if ($date < $actual['CURDATE()']) {
                return true;
            } else {
                return false;
            }
        }


    }

}
