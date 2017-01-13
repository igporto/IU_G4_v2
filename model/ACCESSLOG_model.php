<?php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/INJURY_model.php");
require_once(__DIR__."/../model/USER_model.php");
require_once(__DIR__."/../model/ALUMN_model.php");
require_once(__DIR__."/../model/EMPLOYEE_model.php");
require_once(__DIR__."/../model/ACCESSLOG.php");


class AccesslogMapper {

    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;
    private $injuryMapper;
    private $alumnMapper;
    private $userMapper;
    private $employeeMapper;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
        $this->injuryMapper = new InjuryMapper();
        $this->alumnMapper = new AlumnMapper();
        $this->userMapper = new UserMapper();
        $this->employeeMapper = new EmployeeMapper();
    }

    public function getToday(){
        $stmt = $this->db->prepare("SELECT CURRENT_TIMESTAMP");
        $stmt->execute();
        $now = $stmt->fetch(PDO::FETCH_ASSOC);
        return $now['CURRENT_TIMESTAMP'];
    }
    public function add(Accesslog $accesslog) {



        if($accesslog->getEmployee() != NULL){
            $stmt = $this->db->prepare("INSERT INTO log_acceso_lesion(id_lesion,  id_empleado, cod_usuario, fecha) VALUES (?, ?, ?, ? )");
            $stmt->execute(array($accesslog->getInjury()->getCodInjury() , $accesslog->getEmployee()->getCodemployee(), $accesslog->getUser()->getCoduser(), $accesslog->getDate()));
        }

        if($accesslog->getAlumn() != NULL){
            $stmt = $this->db->prepare("INSERT INTO log_acceso_lesion(id_lesion, id_alumno, cod_usuario, fecha) VALUES (?, ?, ?, ?)");
            $stmt->execute(array($accesslog->getInjury()->getCodInjury() , $accesslog->getAlumn()->getCodalumn(), $accesslog->getUser()->getCoduser(), $accesslog->getDate()));
        }

        return $this->db->lastInsertId();
    }

    public function show() {

        $stmt = $this->db->query("SELECT * FROM log_acceso_lesion");
        $logs_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $logs = array();

        foreach ($logs_db as $log) {
            array_push($logs, $this->view($log['id_log']));
        }

        return $logs;
    }

    public function view($codlog){
        $stmt = $this->db->prepare("SELECT * FROM log_acceso_lesion WHERE id_log = ?");
        $stmt->execute(array($codlog));
        $log = $stmt->fetch(PDO::FETCH_ASSOC);

        if($log != null) {
            return new Accesslog(
                $log["id_log"],
                $this->injuryMapper->view($log['id_lesion']),
                $this->alumnMapper->view($log['id_alumno']),
                $this->employeeMapper->view($log['id_empleado']),
                $this->userMapper->view($log['cod_usuario']),
                $log['fecha']
            );
        } else {
            return new Accesslog();
        }
    }


    public function search(Accesslog $accesslog){
        $stmt = $this->db->prepare("SELECT * FROM log_acceso_lesion WHERE id_lesion like ? AND id_usuario like ? AND id_empleado like ? AND id_alumno like ?");
        $stmt->execute(array("%".$accesslog->getInjury()->getCodInjury()."%","%".$accesslog->getUser()->getCoduser()."%", "%".$accesslog->getEmployee()->getCodemployee()."%" , "%".$accesslog->getAlumn()->getCodalumn()."%"));
        $logs_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $logs = array();
        foreach ($logs_db as $log){
            array_push($logs, $this->view($log['id_log']));
        }
        return $logs;
    }

}
