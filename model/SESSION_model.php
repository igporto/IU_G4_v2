<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__."/SESSION.php");
require_once(__DIR__."/SPACE_model.php");
require_once(__DIR__."/EMPLOYEE_model.php");
require_once(__DIR__."/ACTIVITY_model.php");

class SessionMapper
{

    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;
    private $spaceMapper;
    private $employeeMapper;
    private $activityMapper;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
        $this->spaceMapper = new SpaceMapper();
        $this->employeeMapper = new EmployeeMapper();
        $this->activityMapper = new ActivityMapper();
    }


    public function add(Session $session){
        $codactivity = NULL;
        $codactivity = $session->getActivity()->getCodactivity();


        $stmt = $this->db->prepare("INSERT INTO sesion(id_espacio, id_actividad, id_empleado, hora_inicio, hora_fin, fecha) values (?,?,?,?,?,?)");
        $stmt->execute(array(
                $session->getSpace()->getCodspace(),
                $codactivity,
                $session->getEmployee()->getCodemployee(),
                $session->getHourStart(),
                $session->getHourEnd(),
                $session->getDate()
            )
        );
    }

    public function show()
    {
        $stmt = $this->db->query("SELECT * FROM sesion");
        $session_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sessions = array();

        foreach ($session_db as $session) {
            array_push($sessions, $this->view($session['id_sesion']));
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
        $session = $stmt->fetch(PDO::FETCH_ASSOC);
        


        return new Session(
                    $session['id_sesion'],
                    $session['fecha'],
                    $session['hora_inicio'],
                    $session['hora_fin'],
                    $this->spaceMapper->view($session['id_espacio']),
                    $this->activityMapper->view($session['id_actividad']),
                    $this->employeeMapper->view($session['id_empleado'])
                );
    }


    public function edit(Session $session)
    {
        $stmt = $this->db->prepare("UPDATE sesion  set id_espacio = ?, id_actividad = ?, id_empleado = ?, hora_inicio = ?, hora_fin = ?, fecha WHERE id_sesion = ?");
        $stmt->execute(array(
                $session->getSpace()->getCodspace(),
                $session->getActivity()->getCodactivity(),
                $session->getEmployee()->getCodemployee(),
                $session->getHourStart(),
                $session->getHourEnd(),
                $session->getDate(),
                $session->getIdSession()
            )
        );
    }

    public function delete($id_sesion)
    {
        $stmt = $this->db->prepare("DELETE from sesion WHERE id_sesion= '$id_sesion'");
        $stmt->execute();
    }
}
