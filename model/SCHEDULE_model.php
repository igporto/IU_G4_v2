<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/SCHEDULE.php");
require_once(__DIR__ . "/../model/HOUR.php");
require_once(__DIR__ . "/../model/HOUR_model.php");
require_once(__DIR__ . "/../model/WORKDAY.php");
require_once(__DIR__ . "/../model/WORKDAY_model.php");



class ScheduleMapper
{

    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;
    private $hourMapper;
    private $workdayMapper;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
        $this->hourMapper = new HourMapper();
        $this->workdayMapper = new WorkdayMapper();
    }

    public function getDateSchedule($date){
        $stmt = $this->db->prepare("SELECT * FROM horario WHERE  fecha_inicio <= ? AND fecha_fin >= ?");
        $stmt->execute(array($date,$date));

        $schedule = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Schedule(
                    $schedule['id_horario'],
                    $schedule['nombre'],
                    $schedule['fecha_inicio'],
                    $schedule['fecha_fin']
                );

    }

    public function getIdByName($scname){
        $stmt = $this->db->prepare("SELECT id_horario FROM horario WHERE  nombre= ?");
        $stmt->execute(array($scname));

        return $stmt->fetch(PDO::FETCH_ASSOC)['id_horario'];
    }

    public function add(Schedule $schedule){
        $stmt = $this->db->prepare("INSERT INTO horario(nombre, fecha_inicio, fecha_fin) values (?,?,?)");
        $stmt->execute(array(
                $schedule->getSchedulename(),
                $schedule->getDateStart(),
                $schedule->getDateEnd()
            )
        );

        $schedule_id = $this->getIdByName($schedule->getSchedulename());

        //inserta a xornada por defecto para o horario
        for ($i=0; $i < 7; $i++) { 
            $stmt2 = $this->db->prepare("INSERT INTO jornada(id_horario, dia_semana) values (?,?)");
            $stmt2->execute(array(
                $schedule_id,
                $i
                                )
                            );
        }
        
    }

    public function addWorkdays(array $workdays){
        foreach ($workdays as $xornada) {
            $xornada->setIdSchedule($schedule->getIdSchedule());
            $this->workdayMapper->add($xornada);
        }
    }

    public function show()
    {
        $stmt = $this->db->query("SELECT * FROM horario");
        $schedule_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $schedules = array();

        foreach ($schedule_db as $schedule) {

            array_push($schedules,
                new Schedule(
                    $schedule['id_horario'],
                    $schedule['nombre'],
                    $schedule['fecha_inicio'],
                    $schedule['fecha_fin']
                )
            );
        }

        return $schedules;
    }

    public function getScheduleWorkdays($scheduleId)
    {
        return $this->workdayMapper->getScheduleWorkdays($scheduleId);
    }

    public function showScheduleHours($scheduleId){
        return $this->hourMapper->showScheduleHours($scheduleId);
    }


    public function view($id_schedule)
    {
        $stmt = $this->db->prepare("SELECT * FROM horario WHERE id_horario=?");
        $stmt->execute(array($id_schedule));
        $schedule = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($schedule != null) {
            return  new Schedule(
                    $schedule['id_horario'],
                    $schedule['nombre'],
                    $schedule['fecha_inicio'],
                    $schedule['fecha_fin']
                );
		} else {
            return new Schedule();
        }
    }

    public function edit(Schedule $schedule)
    {
        $stmt = $this->db->prepare("UPDATE horario set fecha_inicio = ?, fecha_fin = ?, nombre = ? where id_horario=?");
        $stmt->execute(array($schedule->getDateStart(), $schedule->getDateEnd(), $schedule->getSchedulename(), $schedule->getIdSchedule()));       
    }

    public function delete($id_schedule)
    {
        $stmt = $this->db->prepare("DELETE from horario WHERE id_horario= '$id_schedule'");
        $stmt->execute();
    }


    public function scheduleNameExists($scheduleName,$idSchedule=NULL)
    {
        if ($idSchedule != NULL) {
            if ($this->view($idSchedule)->getSchedulename() == $scheduleName) {
                return false;
            }
        }
        

        $stmt = $this->db->prepare("SELECT count(*) FROM horario where nombre=?");
        $stmt->execute(array($scheduleName));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    //devolve true se o rango de datas de $chedule non se pisa con ningún outro horario
    public function isValidSchedule(Schedule $schedule,$idSchedule=NULL){

        foreach ($this->show() as $scToCompare) {

            if ($idSchedule != NULL) {
                
                if ($idSchedule != $scToCompare->getIdSchedule()) {
                   if (
                    (($schedule->getDateStart() > $scToCompare->getDateStart()) &&
                     ($schedule->getDateStart() < $scToCompare->getDateEnd())) 
                        ||
                    (($schedule->getDateEnd() < $scToCompare->getDateEnd()) &&
                     ($schedule->getDateEnd() > $scToCompare->getDateStart()))
                )
                        {
                        return false;
                        } 
                }
            }else{
                    if (
                    (($schedule->getDateStart() > $scToCompare->getDateStart()) &&
                     ($schedule->getDateStart() < $scToCompare->getDateEnd())) 
                        ||
                    (($schedule->getDateEnd() < $scToCompare->getDateEnd()) &&
                     ($schedule->getDateEnd() > $scToCompare->getDateStart()))
                )
                        {
                        return false;
                        } 
                }
            
            
            
        }

        return true;
    }

    public function areValidWorkdays($id_schedule, $workdays){
        $schedule = $this->view("id_schedule");
        foreach ($workdays as $wd) {
            if (
                    ($schedule->getDateStart() > $wd->getDateStart()) ||
                    ($schedule->getDateEnd() < $wd->getDateEnd())
                )
            {
                return false;
            }
        }

        return true;
    }

    public function isValidDate($datestart,$dateend)
    {
       $diff = (strtotime($dateend) - strtotime($datestart));

       if ($diff>=0) {
           return true;
       }
    }

    public function search(Schedule $schedule){
        $stmt = $this->db->prepare("SELECT * FROM horario WHERE nombre like ?");
        $stmt->execute(array('%'.$schedule->getSchedulename().'%'));
        $schedules_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $schedules = array();
        foreach ($schedules_db as $schedule) {
            if ($schedule != null) {
            array_push($schedules,  new Schedule(
                    $schedule['id_horario'],
                    $schedule['nombre'],
                    $schedule['fecha_inicio'],
                    $schedule['fecha_fin']
                    )
            );
            
        }

        return $schedules;
        
    }

    }

}
