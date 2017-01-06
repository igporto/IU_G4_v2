<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/INJURY.php");
require_once(__DIR__ . "/../model/PUPIL_HAS_INJURY.php");
require_once(__DIR__ . "/../model/EMPLOYER_HAS_INJURY.php");

class InjuryMapper
{

    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    //Funcion de listar: devolve un array de todos obxetos injury correspondentes á tabla lesion
    public function show()
    {
        $stmt = $this->db->query("SELECT * FROM lesion");
        $injury_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $injury = array();

        foreach ($injury_db as $in) {
            //se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
            //introduce no array o obxeto creado a partir da query
            array_push($injury, $this->view($in["id_lesion"]));
        }

        //devolve o array
        return $injury;
    }

    public function getIdByName($injuryname)
    {
        $stmt = $this->db->prepare("SELECT id_lesion FROM lesion WHERE  id_lesion= ?");
        $stmt->execute(array($injuryname));

        return $stmt->fetch(PDO::FETCH_ASSOC)['id_lesion'];
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
        $stmt = $this->db->prepare("SELECT * FROM lesion WHERE id_lesion like ? AND nombre like ? AND `descripcion` like ? AND tratamiento like ? AND tiempo_recuperacion like ?");
        $stmt->execute(array("%".$injury->getCodInjury()."%", "%".$injury->getNameInjury()."%", "%".$injury->getDescription()."%", "%".$injury->getTreatment()."%", "%".$injury->getTime()."%"));
        $sp_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $in = array();
        foreach ($sp_db as $injur){
            array_push($in, $this->view($injur['id_lesion']));
        }
        return $in;
    }

    //Recolle os dni dos alumnos que se pasan como $b
    public function selectDniA($b){
        $stmt = $this->db->prepare("SELECT * FROM alumno WHERE id_alumno=$b");
        $stmt->execute();

        $resul = $stmt->fetch();

        return $resul['dni_alumno'];
    }

    //Recolle os ids dos alumnos
    public function selectIDA(){
        $stmt = $this->db->prepare("SELECT * FROM alumno");
        $stmt->execute();

        $id = array();
        $resul = $stmt->fetchAll();
        foreach($resul as $r){
            array_push($id,$r['id_alumno']);
        }

        return $id;
    }

    //Recolle os id das lesions
    public function selectInjuryID(){
        $stmt = $this->db->prepare("SELECT * FROM lesion");
        $stmt->execute();

        $id = array();
        $resul = $stmt->fetchAll();
        foreach($resul as $r){
            array_push($id,$r['id_lesion']);
        }

        return $id;
    }

    //Recolle o nome da lesion
    public function getNameInjury($id){
        $stmt = $this->db->prepare("SELECT * FROM lesion WHERE id_lesion ='$id'");
        $stmt->execute();

        $r = $stmt->fetch();
        $id_pr = $r['nombre'];

        return $id_pr;
    }

    //Engade unha lesion a un alumno
    public function addpupil(Pupil_has_injury $pupil)
    {
        //insertamos na taboa
        $stmt = $this->db->prepare("INSERT INTO alumno_tiene_lesion(id_alumno,id_lesion,fecha_lesion,fecha_recuperacion) values (?,?,?,?)");
        $stmt->execute(array(
                $pupil->getCodPupil(),
                $pupil->getCodInjury(),
                $pupil->getDateInjury(),
                $pupil->getDateRecovery()
            )
        );
        return $this->db->lastInsertId();
    }

    //Indica si un alumno con esa lesion xa existe
    public function pupilCodExists($pupilCod,$id)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM alumno_tiene_lesion where id_alumno=? AND id_lesion = ?");
        $stmt->execute(array($pupilCod,$id));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    //Amosa os alumnos con lesion
    public function showpupil(){
        $w = $_GET['id_lesion'];
        $pupil = $this->db->query("SELECT * FROM alumno_tiene_lesion WHERE id_lesion = $w");
        $pupil_db = $pupil->fetchAll(PDO::FETCH_ASSOC);

        $pu = array();

        foreach ($pupil_db as $pup) {
            //se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
            //introduce no array o obxeto Controller creado a partir da query
            array_push($pu, new Pupil_has_injury($pup["id_alumno"],$pup['id_lesion'],$pup['fecha_lesion'], $pup['fecha_recuperacion']));
        }

        //devolve o array
        return $pu;
    }

    //Recolle o nome do alumno
    public function getNamePupil($id){
        $stmt = $this->db->prepare("SELECT * FROM alumno WHERE id_alumno ='$id'");
        $stmt->execute();

        $r = $stmt->fetch();
        $id_pr = $r['nombre'];

        return $id_pr;
    }

    //Elimina a lesion da lista de lesions do alumno
    public function deletepupil($cod,$id){
        $stmt = $this->db->prepare("DELETE from alumno_tiene_lesion WHERE id_alumno = '$cod' AND id_lesion = '$id'");
        $stmt->execute();
    }

    //Recolle o id do empregado
    public function selectIDE(){
        $stmt = $this->db->prepare("SELECT * FROM empleado");
        $stmt->execute();

        $id = array();
        $resul = $stmt->fetchAll();
        foreach($resul as $r){
            array_push($id,$r['id_empleado']);
        }

        return $id;
    }

    //Recolle o dni do empleado que se pasa como id
    public function selectDniE($b){
        $stmt = $this->db->prepare("SELECT * FROM empleado WHERE id_empleado=$b");
        $stmt->execute();

        $resul = $stmt->fetch();

        return $resul['dni'];
    }

    //Engade unha lesion a un empregado
    public function addemployer(Employer_has_injury $emp)
    {
        //insertamos na taboa
        $stmt = $this->db->prepare("INSERT INTO empleado_tiene_lesion(id_empleado,id_lesion,fecha_lesion,fecha_recuperacion) values (?,?,?,?)");
        $stmt->execute(array(
                $emp->getCodEmpl(),
                $emp->getCodInjury(),
                $emp->getDateInjury(),
                $emp->getDateRecovery()
            )
        );
        return $this->db->lastInsertId();
    }

    //Recolle o nome da lesion
    public function getNameInjuryEmp($id){
        $stmt = $this->db->prepare("SELECT * FROM lesion WHERE id_lesion ='$id'");
        $stmt->execute();

        $r = $stmt->fetch();
        $id_pr = $r['nombre'];

        return $id_pr;
    }

    //Amosa os empregados con lesion
    public function showemployer(){
        $w = $_GET['id_lesion'];
        $pupil = $this->db->query("SELECT * FROM empleado_tiene_lesion WHERE id_lesion = $w");
        $pupil_db = $pupil->fetchAll(PDO::FETCH_ASSOC);

        $pu = array();

        foreach ($pupil_db as $pup) {
            //se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
            //introduce no array o obxeto Controller creado a partir da query
            array_push($pu, new Employer_has_injury($pup["id_empleado"],$pup['id_lesion'],$pup['fecha_lesion'], $pup['fecha_recuperacion']));
        }

        //devolve o array
        return $pu;
    }

    //Elimina a lesion da lista de lesions do empregado
    public function deleteemployer($cod,$id){
        $stmt = $this->db->prepare("DELETE from empleado_tiene_lesion WHERE id_empleado = '$cod' AND id_lesion = '$id'");
        $stmt->execute();
    }

    //Recolle o nome do alumno
    public function getNameEmp($id){
        $stmt = $this->db->prepare("SELECT * FROM empleado WHERE id_empleado ='$id'");
        $stmt->execute();

        $r = $stmt->fetch();
        $id_pr = $r['nombre'];

        return $id_pr;
    }


}
