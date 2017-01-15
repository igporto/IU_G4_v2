<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/SESSION_model.php");
require_once(__DIR__ . "/../model/ALUMN_model.php");


class AttendanceMapper {

    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;
    private $alumnMapper;
    private $sessionMapper;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
        $this->alumnMapper = new AlumnMapper();
        $this->sessionMapper = new SessionMapper();
    }

    //Inserta na base de datos unha tupla cos datos do obxeto $attendance
    public function add(Attendance $attendance) {
        $stmt = $this->db->prepare("INSERT INTO asistencia(id_alumno, id_sesion) values (?, ?)");
        $stmt->execute(array($attendance->getAlumn()->getCodalumn(), $attendance->getSession()->getIdSession()));

        return $this->db->lastInsertId();
    }


    //Funcion de listar: devolve un array de todos obxetos Attendance correspondentes á tabla Accion
    public function show() {

        $stmt = $this->db->query("SELECT * FROM asistencia");
        $attendance_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $attendances = array();

        foreach ($attendance_db as $a) {
            array_push($attendances, $this->view($a['id_asistencia']));
        }

        return $attendances;
    }



    //devolve o obxecto Attendance no que o $attendance_campo_id coincida co da tupla.
    public function view($id_asistencia){
        $stmt = $this->db->prepare("SELECT * FROM asistencia WHERE id_asistencia=?");
        $stmt->execute(array($id_asistencia));
        $attendance = $stmt->fetch(PDO::FETCH_ASSOC);

        if($attendance != null) {
            return new Attendance(
                $attendance["id_asistencia"],
                $this->alumnMapper->view($attendance['id_alumno']),
                $this->sessionMapper->view($attendance['id_sesion'])
            );
        } else {
            return new Attendance();
        }
    }

    //edita a tupla correspondente co id do obxecto Attendance $attendance
    public function edit(Attendance $attendance) {
        $stmt = $this->db->prepare("UPDATE asistencia set asiste = ? where id_asistencia = ?");
        $stmt->execute(array($attendance->getAssist(),$attendance->getCod()));
    }


    //borra sobre a taboa asistencia a tupla con id igual a o do obxeto pasado
    public function delete($codattendance) {
        $stmt = $this->db->prepare("DELETE from asistencia WHERE id_asistencia=?");
        $stmt->execute(array($codattendance));
    }

    public function search(Attendance $attendance){
        if($attendance->getAlumn()->getCodalumn() != NULL){
            $stmt = $this->db->prepare("SELECT * FROM asistencia WHERE id_alumno like ? ");
            $stmt->execute(array($attendance->getAlumn()->getCodalumn()));

        }else{
            $stmt = $this->db->prepare("SELECT * FROM asistencia");
            $stmt->execute(array());
        }
        $attendances_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $attendances = array();
        foreach ($attendances_db as $a){
            array_push($attendances, $this->view($a['id_asistencia']));
        }
        return $attendances;
    }

}
