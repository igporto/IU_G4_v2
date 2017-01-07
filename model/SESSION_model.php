<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/SCHEDULE.php");




class SessionMapper
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

    public function getIdByName($name)
    {
        $stmt = $this->db->prepare("SELECT id_sesion FROM sesion WHERE  nombre= ?");
        $stmt->execute(array($name));

        return $stmt->fetch(PDO::FETCH_ASSOC)['id_sesion'];
    }

    public function add(Session $session){
        $stmt = $this->db->prepare("INSERT INTO sesion(id_horario, id_fisio, id_espacio, id_evento, id_actividad, id_empleado, nombre) values (?,?,?,?,?,?,?)");
        $stmt->execute(array(
                $session->getIdSchedule(),
                $session->getIdFisio(),
                $session->getIdSpace(),
                $session->getIdEvent(),
                $session->getIdActivity(),
                $session->getIdEmployee(),
                $session->getName()
            )
        );
    }

    public function show()
    {
        $stmt = $this->db->query("SELECT * FROM sesion");
        $session_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sessions = array();

        foreach ($session_db as $session) {

            array_push($sessions,
                new Session(
                    $session['id_sesion'],
                    $session['id_horario'],
                    $session['id_fisio'],
                    $session['id_espacio'],
                    $session['id_evento'],
                    $session['id_actividad'],
                    $session['id_empleado'],
                    $session['nombre']
                )
            );
        }

        return $sessions;
    }

    public function view($sessionId)
    {
        $stmt = $this->db->prepare("SELECT * FROM sesion where id_sesion = ?");
        $stmt->execute(array(
                        $sessionId
                            )
                    );
        $session_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sessions = array();

        foreach ($session_db as $session) {

            array_push($sessions,
                new Session(
                    $session['id_sesion'],
                    $session['id_horario'],
                    $session['id_fisio'],
                    $session['id_espacio'],
                    $session['id_evento'],
                    $session['id_actividad'],
                    $session['id_empleado'],
                    $session['nombre']
                )
            );
        }

        return $sessions;
    }


    public function edit(Session $hour)
    {
        $stmt = $this->db->prepare("UPDATE sesion  set id_horario = ?, id_fisio = ?, id_espacio = ?, id_evento = ?, id_actividad = ?, id_empleado = ?, nombre = ? WHERE id_sesion = ?");
        $stmt->execute(array(
                $session->getIdSchedule(),
                $session->getIdFisio(),
                $session->getIdSpace(),
                $session->getIdEvent(),
                $session->getIdActivity(),
                $session->getIdEmployee(),
                $session->getName(),
                $session->getIdSession()
            )
        );
    }

    public function delete($is_sesion)
    {
        $stmt = $this->db->prepare("DELETE from sesion WHERE is_sesion= '$is_sesion'");
        $stmt->execute();
    }
}
