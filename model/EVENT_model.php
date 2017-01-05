<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/EVENT.php");
require_once(__DIR__ . "/../model/PERMISSION.php");
require_once(__DIR__ . "/../model/PERMISSION_model.php");



class EventMapper
{

    private $db;
    private $permMapper;


    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
        $this->permMapper = new PermissionMapper();
    }

    //Funcion de listar: devolve un array de todos obxetos event correspondentes á tabla evento
    public function show()
    {
        $event = $this->db->query("SELECT * FROM evento");
        $event_db = $event->fetchAll(PDO::FETCH_ASSOC);

        $event = array();

        foreach ($event_db as $ev) {
            //se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
            //introduce no array o obxeto Controller creado a partir da query
            array_push($event, new Event($ev["id_evento"],$ev['nombre'], $ev["hora_inicio"], $ev["hora_fin"], $ev["fecha_evento"], $ev["aforo"], $ev["id_espacio"], $ev["id_empleado"]));
        }

        //devolve o array
        return $event;
    }

    public function getIdByName($eventname)
    {
        $stmt = $this->db->prepare("SELECT id_evento FROM evento WHERE  id_evento= ?");
        $stmt->execute(array($eventname));

        return $stmt->fetch(PDO::FETCH_ASSOC)['id_evento'];
    }

    //devolve o obxecto event no que o $id_evento coincida co da tupla.
    public function view($id_event)
    {
        $stmt = $this->db->prepare("SELECT id_evento,nombre,hora_inicio,hora_fin,fecha_evento,aforo,id_espacio,id_empleado FROM evento WHERE nombre=?");
        $stmt->execute(array($id_event));
        $sp = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($sp != null) {
            return new Event(
                $sp['nombre'],
                $sp['hora_inicio'],
                $sp['hora_fin'],
                $sp['fecha_evento'],
                $sp['aforo'],
                $sp['id_espacio'],
                $sp['id_empleado']
            );
        } else {
            return new Event();
        }
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

    //engade un evento á táboa evento
    public function add(Event $event)
    {
        //insertamos na taboa evento
        $stmt = $this->db->prepare("INSERT INTO evento(nombre,hora_inicio, hora_fin, fecha_evento, aforo, id_espacio, id_empleado) values (?,?,?,?,?,?,?)");
        $stmt->execute(array(
                $event->getEventname(),
                $event->getInitialHour(),
                $event->getFinalHour(),
                $event->getDate(),
                $event->getCapacity(),
                $event->getCodSpace(),
                $event->getCodProf()
            )
        );
        return $this->db->lastInsertId();
    }

    //Selecciona todos os id dos espazos que hai na bd
    public function selectSpaceId(){
        $stmt = $this->db->prepare("SELECT * FROM espacio");
        $stmt->execute();

        $id = array();
        $resul = $stmt->fetchAll();
        foreach($resul as $r){
            array_push($id,$r['id_espacio']);
        }

        return $id;
    }

    //Selecciona todos os dn dos empleados que hai na bd
    public function selectIdP(){
        $stmt = $this->db->prepare("SELECT * FROM empleado");
        $stmt->execute();

        $id = array();
        $resul = $stmt->fetchAll();
        foreach($resul as $r){
            array_push($id,$r['id_empleado']);
        }

        return $id;
    }

    //edita a tupla correspondente co id do obxecto event
    public function edit(Event $events)
    {
        $stmt = $this->db->prepare("UPDATE evento SET id_evento=?, nombre=?, hora_inicio = ?, hora_fin = ?, fecha_evento = ?, aforo = ?, id_espacio = ?, id_empleado = ? where id_evento=?");
        $stmt->execute(array($events->getCodEvent(),$events->getEventname(),$events->getInitialHour(), $events->getFinalHour(), $events->getDate(),$events->getCapacity(), $events->getCodSpace(), $events->getCodProf(), $events->getCodEvent()));
    }

    //borra sobre a taboa evento a tupla con id igual a o do obxeto pasado
    //borra tamen todos os alumnos apuntados a ese evento
    public function delete($cod)
    {
        $stmt = $this->db->prepare("DELETE from evento WHERE id_evento = '$cod'");
        $stmt->execute();
        $stmt2 = $this->db->prepare("DELETE from alumno_se_apunta_evento WHERE id_evento = '$cod'");
        $stmt2->execute();
    }

    public function search(Event $event){

        $stmt = $this->db->prepare("SELECT * FROM evento WHERE id_evento like ? AND nombre like ? AND hora_inicio like ? AND hora_fin like ? AND fecha_evento like ? AND aforo like ? AND id_espacio like ? AND id_empleado like ?");
        $stmt->execute(array("%".$event->getCodEvent()."%",
            "%".$event->getEventname()."%",
            "%".$event->getInitialHour()."%",
            "%".$event->getFinalHour()."%",
            "%".$event->getDate()."%",
            "%".$event->getCapacity()."%",
            "%".$event->getCodSpace()."%"
        , "%".$event->getCodProf()."%"));
        $ev_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $ev = array();
        foreach ($ev_db as $e){
            array_push($ev, new Event(
                $e['id_evento'],
                $e['nombre'],
                $e['hora_inicio'],
                $e['hora_fin'],
                $e['fecha_evento'],
                $e['aforo'],
                $e['id_espacio'],
                $e['id_empleado']
            ));
        }
        return $ev;
    }

    //Mostra os alumnos engadidos a un evento
    public function showpupil(){
        $w = $_GET['id_evento'];
        $pupil = $this->db->query("SELECT * FROM alumno_se_apunta_evento WHERE id_evento = $w");
        $pupil_db = $pupil->fetchAll(PDO::FETCH_ASSOC);

        $pu = array();

        foreach ($pupil_db as $pup) {
            //se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
            //introduce no array o obxeto Controller creado a partir da query
            array_push($pu, new pupil_attends_event($pup["id_evento"],$pup['id_alumno']));
        }

        //devolve o array
        return $pu;
    }

    //engade un alumno a taboa alumno_se_apunta_evento
    public function addpupil(pupil_attends_event $pupil){
        //insertamos na taboa
        $stmt = $this->db->prepare("INSERT INTO alumno_se_apunta_evento(id_evento,id_alumno) values (?,?)");
        $stmt->execute(array(
                $pupil->getCodEvent(),
                $pupil->getCodStudent()
            )
        );
        return $this->db->lastInsertId();
    }

    //Recolle os id dos alumnos
    public function selectDniA(){
        $stmt = $this->db->prepare("SELECT * FROM alumno");
        $stmt->execute();

        $id = array();
        $resul = $stmt->fetchAll();
        foreach($resul as $r){
            array_push($id,$r['id_alumno']);
        }

        return $id;
    }

    //Recolle os id dos eventos
    public function selectEventID(){
        $stmt = $this->db->prepare("SELECT * FROM evento");
        $stmt->execute();

        $id = array();
        $resul = $stmt->fetchAll();
        foreach($resul as $r){
            array_push($id,$r['id_evento']);
        }

        return $id;
    }

    //Comproba se existe un alumno con ese dni en el evento que se pasa como $id
    public function pupilCodExists($pupilCod,$id)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM alumno_se_apunta_evento where id_alumno=? AND id_evento = ?");
        $stmt->execute(array($pupilCod,$id));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    //Elimina un alumno do evento que se pasa como $id
    public function deletepupil($cod,$id){
        $stmt = $this->db->prepare("DELETE from alumno_se_apunta_evento WHERE id_alumno = '$cod' AND id_evento = '$id'");
        $stmt->execute();
    }

    //Devolve os dni dos alumnos que coinciden cun id
    public function getDniId($i){
        $stmt = $this->db->prepare("SELECT * FROM alumno WHERE id_alumno ='$i'");
        $stmt->execute();

        $r = $stmt->fetch();
        $id = $r['dni_alumno'];

        return $id;
    }
}
