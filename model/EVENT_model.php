<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/EVENT.php");
require_once(__DIR__ . "/../model/EMPLOYEE_model.php");
require_once(__DIR__ . "/../model/SPACE_model.php");
require_once(__DIR__ . "/../model/ALUMN_model.php");


class EventMapper
{

    private $db;
    private $alumnMapper;
    private $employeeMapper;
    private $spaceMapper;


    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
        $this->employeeMapper = new EmployeeMapper();
        $this->spaceMapper = new SpaceMapper();
        $this->alumnMapper = new AlumnMapper();
    }

    public function getIdByName($eventname)
    {
        $stmt = $this->db->prepare("SELECT id_evento FROM evento WHERE  id_evento= ?");
        $stmt->execute(array($eventname));

        return $stmt->fetch(PDO::FETCH_ASSOC)['id_evento'];
    }

    //Comproba se existe un evento con ese id
    public function EventNameExists($eventname)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM evento where nombre=?");
        $stmt->execute(array($eventname));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    //Inserta na base de datos unha tupla cos datos do obxeto $event
    public function add(Event $event) {
        $stmt = $this->db->prepare("INSERT INTO evento( nombre, hora_inicio, hora_fin, fecha_evento, aforo, id_espacio, id_empleado, plazas_libres) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute(array($event->getName(), $event->getIniHour(), $event->getFinHour(), $event->getDate(), $event->getCapacity(), $event->getSpace()->getCodspace(), $event->getEmployee()->getCodemployee(), $event->freeplaces));

        return $this->db->lastInsertId();
    }


    //Funcion de listar: devolve un array de todos obxetos Event correspondentes á tabla Accion
    public function show() {

        $stmt = $this->db->query("SELECT * FROM evento");
        $event_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $events = array();

        foreach ($event_db as $event) {
            array_push($events, $this->view($event['id_evento']));
        }

        return $events;
    }



    //devolve o obxecto Event no que o $event_campo_id coincida co da tupla.
    public function view($codevent){
        $stmt = $this->db->prepare("SELECT * FROM evento WHERE id_evento=?");
        $stmt->execute(array($codevent));
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if($event != null) {
            return new Event(
                $event["id_evento"],
                $event['nombre'],
                $event["hora_inicio"],
                $event["hora_fin"],
                $event["fecha_evento"],
                $event["aforo"],
                $this->spaceMapper->view($event["id_espacio"]),
                $this->employeeMapper->view($event['id_empleado']),
                $event['plazas_libres']
            );
        } else {
            return new Event();
        }
    }


    //edita a tupla correspondente co id do obxecto Event $event
    public function edit(Event $event) {
        $stmt = $this->db->prepare("UPDATE evento SET nombre = ?,hora_inicio = ?,hora_fin = ?,fecha_evento = ?,aforo = ?,id_espacio = ?,id_empleado = ?, plazas_libres = ? WHERE id_evento = ?");
        $stmt->execute(array($event->getName(), $event->getIniHour(), $event->getFinHour(), $event->getDate(), $event->getCapacity(), $event->getSpace()->getCodspace(),
                            $event->getEmployee()->getCodemployee(), $event->freeplaces,  $event->getCodevent()));
    }


    //borra sobre a taboa accion a tupla con id igual a o do obxeto pasado
    public function delete($codevent) {
        $stmt = $this->db->prepare("DELETE from evento WHERE id_evento=?");
        $stmt->execute(array($codevent));
    }

    public function search(Event $event){
        $stmt = $this->db->prepare("SELECT * FROM evento WHERE id_evento like ? AND nombre like ? AND aforo like ? AND id_espacio like ? AND id_empleado like ?");
        $stmt->execute(array("%".$event->getCodevent()."%","%".$event->getName()."%", "%".$event->getCapacity()."%", "%".$event->getSpace()->getCodspace()."%",
                            "%".$event->getEmployee()->getCodemployee()."%" ));
        $events_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $events = array();
        foreach ($events_db as $a){
            array_push($events, $this->view($a['id_evento']));
        }
        return $events;
    }

    public function addpupil(PupilAttendsEvent $pae){
        //insertamos na taboa
        $stmt = $this->db->prepare("INSERT INTO alumno_se_apunta_evento(id_evento,id_alumno) values (?,?)");
        $stmt->execute(array(
            $pae->getEvent()->getCodevent(),
                $pae->getAlumn()->getCodalumn()
            )
        );
        return $this->db->lastInsertId();
    }

    public function pupilannotated(PupilAttendsEvent $pae){
        $stmt = $this->db->prepare("SELECT count(*) FROM alumno_se_apunta_evento where id_evento = ? AND id_alumno = ?");
        $stmt->execute(array($pae->getEvent()->getCodevent(), $pae->getAlumn()->getCodalumn()));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    public function showPupils($codevent){

        $stmt = $this->db->query("SELECT * FROM alumno_se_apunta_evento WHERE id_evento = '$codevent'");
        $pupils_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pupils = array();

        foreach ($pupils_db as $pupil) {
            $alumn = $this->alumnMapper->view($pupil['id_alumno']);
            $event = $this->view($pupil['id_evento']);
            array_push($pupils, new PupilAttendsEvent($event, $alumn));
        }

        return $pupils;
    }

    public function deletePupil(PupilAttendsEvent $pae){
        //insertamos na taboa
        $stmt = $this->db->prepare("DELETE FROM alumno_se_apunta_evento WHERE id_evento = ? AND id_alumno = ?");
        $stmt->execute(array(
                $pae->getEvent()->getCodevent(),
                $pae->getAlumn()->getCodalumn()
            )
        );
        return $this->db->lastInsertId();
    }
    public function isearly($date){

        $stmt = $this->db->query("SELECT CURDATE()");
        $db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($db != NULL){
            $actual = $db[0];

            if ($date > $actual['CURDATE()']) {
                return true;
            } else {
                return false;
            }
        }


    }
}
