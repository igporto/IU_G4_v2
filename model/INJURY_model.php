<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/INJURY.php");
require_once(__DIR__ . "/../model/EMPLOYEEHASINJURY.php");
require_once(__DIR__ . "/../model/PUPILHASINJURY.php");


class InjuryMapper
{

    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    public function getIdByName($injuryname)
    {
        $stmt = $this->db->prepare("SELECT id_lesion FROM lesion WHERE  id_lesion= ?");
        $stmt->execute(array($injuryname));

        return $stmt->fetch(PDO::FETCH_ASSOC)['id_lesion'];
    }

    //Comproba se existe una lesion con ese nome
    public function injuryNameExists($injury)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM lesion where nombre=?");
        $stmt->execute(array($injury));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    //engade unha lesion á táboa lesion
    public function add(Injury $injury)
    {
        //insertamos na taboa espazos
        $stmt = $this->db->prepare("INSERT INTO lesion(nombre, descripcion, tratamiento, tiempo_recuperacion) values (?,?,?,?)");
        $stmt->execute(array(
                $injury->getNameInjury(),
                $injury->getDescription(),
                $injury->getTreatment(),
                $injury->getTime()
            )
        );
        return $this->db->lastInsertId();
    }

    //Funcion de listar: devolve un array de todos obxetos injury correspondentes á tabla lesion
    public function show()
    {
        $stmt = $this->db->query("SELECT * FROM lesion");
        $injury_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $injury = array();

        foreach ($injury_db as $in) {
            array_push($injury, $this->view($in["id_lesion"]));
        }
        return $injury;
    }

    //devolve o obxecto Injury no que o $id_lesion coincida co da tupla.
    public function view($id_lesion)
    {
        $stmt = $this->db->prepare("SELECT * FROM lesion WHERE id_lesion=?");
        $stmt->execute(array($id_lesion));
        $in = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($in != null) {
            return new Injury(
                $in['id_lesion'],
                $in['nombre'],
                $in['descripcion'],
                $in['tratamiento'],
                $in['tiempo_recuperacion']
            );
        } else {
            return new Injury();
        }
    }
    //edita a tupla correspondente co id do obxecto injury
    public function edit(Injury $injury)
    {
        $stmt = $this->db->prepare("UPDATE lesion SET nombre = ?, descripcion = ?, tratamiento = ?, tiempo_recuperacion = ? where id_lesion=?");
        $stmt->execute(array($injury->getNameInjury(), $injury->getDescription(), $injury->getTreatment(), $injury->getTime(), $injury->getCodInjury()));
    }

    //borra sobre a taboa lesion a tupla con id igual a o do obxeto pasado
    public function delete($codinjury)
    {
        $stmt = $this->db->prepare("DELETE from lesion WHERE id_lesion = '$codinjury'");
        $stmt->execute();
    }

    public function search(Injury $injury){
        $stmt = $this->db->prepare("SELECT * FROM lesion WHERE id_lesion like ? AND nombre like ? AND tiempo_recuperacion like ?");
        $stmt->execute(array("%".$injury->getCodInjury()."%", "%".$injury->getNameInjury()."%", "%".$injury->getTime()."%"));
        $sp_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $in = array();
        foreach ($sp_db as $injur){
            array_push($in, $this->view($injur['id_lesion']));
        }
        return $in;
    }
}
