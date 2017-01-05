<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/WORKDAY.php");




class WorkdayMapper
{

    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    public function add(Workday $workday){
        $stmt = $this->db->prepare("INSERT INTO jornada(id_horario, dia_semana, hora_inicio, hora_fin) values (?,?,?,?)");
        $stmt->execute(array(
                $workday->getIdSchedule(),
                $workday->getDay(),
                $workday->getHourStart(),
                $workday->getHourEnd()
            )
        );
    }

    public function show()
    {
        $stmt = $this->db->query("SELECT * FROM jornada");
        $workday_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $uworkday = array();

        foreach ($workday_db as $workday) {

            array_push($workdays,
                new Workday(
                    $workday['id_jornada'],
                    $workday['dia_semana'],
                    $workday['hora_inicio'],
                    $workday['hora_fin'],
                    $workday['id_horario']
                )
            );
        }

        return $workdays;
    }

    public function getScheduleWorkdays($scheduleId)
    {
        $stmt = $this->db->prepare("SELECT * FROM jornada where id_horario = ?");
        $stmt->execute(array(
                        $scheduleId
                            )
                    );
        $workday_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $workdays = array();

        foreach ($workday_db as $workday) {

            array_push($workdays,
                new Workday(
                    $workday['id_jornada'],
                    $workday['dia_semana'],
                    $workday['hora_inicio'],
                    $workday['hora_fin'],
                    $workday['id_horario']
                )
            );
        }

        return $workdays;
    }


    public function view($id_workday)
    {
        $stmt = $this->db->prepare("SELECT * FROM jornada WHERE id_jornada=?");
        $stmt->execute(array($id_workday));
        $workday = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($workday != null) {
            return  new Workday(
                    $workday['id_jornada'],
                    $workday['dia_semana'],
                    $workday['hora_inicio'],
                    $workday['hora_fin'],
                    $workday['id_horario']
                );
		} else {
            return new Workday();
        }
    }

    public function edit(Workday $workday)
    {
        $stmt = $this->db->prepare("UPDATE jornada set hora_inicio = ?, hora_fin = ? where id_horario=? AND dia_semana=?");
        $stmt->execute(array($workday->getHourStart(), $workday->getHourEnd(), $workday->getIdSchedule(), $workday->getDay() ));       
    }

    public function delete($id_jornada)
    {
        $stmt = $this->db->prepare("DELETE from jornada WHERE id_jornada= '$id_jornada'");
        $stmt->execute();
    }

    public function isValidWorkdayDate(Workday $workday){

        $novale = '02/31';
        $prepareDate = substr($workday->getDate(),5,5);

        if ((strcmp($prepareDate, $novale)) == 0) {
            return false;
        }

        foreach ($this->getScheduleWorkdays($workday->getIdSchedule()) as $wd) {
            if ($workday->getDate() == $wd->getDate()) {
                return false;
            }
        }

        return true;

    }

    public function isValidWorkdayHour(Workday $workday){
        if ($workday->getHourStart() > $workday->getHourEnd()) {
            return false;
        }

        return true;
    }

}
