<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/HOUR.php");




class HourMapper
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

    public function add(Hour $hour){
        $stmt = $this->db->prepare("INSERT INTO hora(id_horario, id_sesion, dia_semana, hora_inicio, hora_fin) values (?,?,?,?,?)");
        $stmt->execute(array(
                $hour->getIdSchedule(),
                $hour->getIdSession(),
                $hour->getDay(),
                $hour->getHourStart(),
                $hour->getHourEnd()
            )
        );
    }

    public function show()
    {
        $stmt = $this->db->query("SELECT * FROM hora");
        $hour_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $hour = array();

        foreach ($hour_db as $hour) {

            array_push($hours,
                new Hour(
                    $hour['id_hora'],
                    $hour['dia_semana'],
                    $hour['hora_inicio'],
                    $hour['hora_fin'],
                    $hour['id_horario'],
                    $hour['id_sesion']
                )
            );
        }

        return $hours;
    }

    public function getScheduleHours($scheduleId)
    {
        $stmt = $this->db->prepare("SELECT * FROM hora where id_horario = ?");
        $stmt->execute(array(
                        $scheduleId
                            )
                    );
        $hour_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $uhour = array();

        foreach ($hour_db as $hour) {

            array_push($hours,
                new Hour(
                    $hour['id_hora'],
                    $hour['dia_semana'],
                    $hour['hora_inicio'],
                    $hour['hora_fin'],
                    $hour['id_horario'],
                    $hour['id_sesion']
                )
            );
        }

        return $hours;
    }

    public function getSessionHours($sessionId)
    {
        $stmt = $this->db->prepare("SELECT * FROM hora where id_sesion = ?");
        $stmt->execute(array(
                        $sessionId
                            )
                    );
        $hour_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $uhour = array();

        foreach ($hour_db as $hour) {

            array_push($hours,
                new Hour(
                    $hour['id_hora'],
                    $hour['dia_semana'],
                    $hour['hora_inicio'],
                    $hour['hora_fin'],
                    $hour['id_horario'],
                    $hour['id_sesion']
                )
            );
        }

        return $hours;
    }


    public function view($id_hour)
    {
        $stmt = $this->db->prepare("SELECT * FROM hora WHERE id_hora=?");
        $stmt->execute(array($id_hour));
        $hour = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($hour != null) {
            return  new Hour(
                    $hour['id_hora'],
                    $hour['dia_semana'],
                    $hour['hora_inicio'],
                    $hour['hora_fin'],
                    $hour['id_horario']
                );
		} else {
            return new Hour();
        }
    }

    public function edit(Hour $hour)
    {
        $stmt = $this->db->prepare("UPDATE hora set hora_inicio = ?, hora_fin = ?, dia_semana = ? where id_hora=?");
        $stmt->execute(array($hour->getHourStart(), $hour->getHourEnd(), $hour->getDay(), $hour->getIdHour()));       
    }

    public function delete($id_hora)
    {
        $stmt = $this->db->prepare("DELETE from hora WHERE id_hora= '$id_hora'");
        $stmt->execute();
    }

    public function hourExists(Hour $hour)
    {
        //implement if necessary
    }

    public function isValidHour()
    {
       //implement if necessary
        //may need multiple mini-functions
    }

}
