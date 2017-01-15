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


    //Funcion de listar: devolve un array de todos obxetos Action correspondentes á tabla Accion
    public function show() {

        $stmt = $this->db->query("SELECT * FROM asistencia");
        $attendance_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $attendances = array();

        foreach ($attendance_db as $a) {
            array_push($attendances, $this->view($a['id_asistencia']));
        }

        return $attendances;
    }



    //devolve o obxecto Action no que o $attendance_campo_id coincida co da tupla.
    public function view($id_accion){
        $stmt = $this->db->prepare("SELECT * FROM accion WHERE id_accion=?");
        $stmt->execute(array($id_accion));
        $attendance = $stmt->fetch(PDO::FETCH_ASSOC);

        if($attendance != null) {
            return new Action(
                $attendance["id_accion"],
                $attendance["nombre"]
            );
        } else {
            return new Action();
        }
    }

    //edita a tupla correspondente co id do obxecto Action $attendance
    public function edit(Action $attendance) {
        $stmt = $this->db->prepare("UPDATE accion set nombre=? where id_accion=?");
        $stmt->execute(array($attendance->getActionname(),$attendance->getCodattendance()));
    }


    //borra sobre a taboa accion a tupla con id igual a o do obxeto pasado
    public function delete(Action $attendance) {
        $stmt = $this->db->prepare("DELETE from accion WHERE id_accion=?");
        $stmt->execute(array($attendance->getCodattendance()));
    }

    public function search(Action $attendance){
        $stmt = $this->db->prepare("SELECT * FROM accion WHERE id_accion like ? AND nombre like ?");
        $stmt->execute(array("%".$attendance->getCodattendance()."%","%".$attendance->getActionname()."%"));
        $attendances_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $attendances = array();
        foreach ($attendances_db as $a){
            array_push($attendances, new Action(
                    $a['id_accion'],
                    $a["nombre"])
            );
        }
        return $attendances;
    }

}
