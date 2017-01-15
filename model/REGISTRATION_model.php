<?php
require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/REGISTRATION.php");
require_once(__DIR__ . "/../model/ACTIVITY.php");
require_once(__DIR__ . "/../model/ALUMN_model.php");
require_once(__DIR__ . "/../model/ALUMN.php");
require_once(__DIR__ . "/../model/ALUMN_model.php");
require_once(__DIR__ . "/../model/EVENT.php");
require_once(__DIR__ . "/../model/EVENT_model.php");
require_once(__DIR__ . "/../model/PAYMENT.php");
require_once(__DIR__ . "/../model/PAYMENT_model.php");

class RegistrationMapper
{
    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;
    private $activityMapper;
    private $eventMapper;
    private $alumnMapper;
    private $paymentMapper;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
        $this->activityMapper = new ActivityMapper();
        $this->eventMapper = new EventMapper();
        $this->alumnMapper = new AlumnMapper();
        $this->paymentMapper = new PaymentMapper();
    }

    public function getToday(){
        $stmt = $this->db->prepare("SELECT CURENT()");
        $stmt->execute();
        $now = $stmt->fetch(PDO::FETCH_ASSOC);
        return $now['CURDATE()'];
    }

    public function getNow(){
        $stmt = $this->db->prepare("SELECT CURRENT_TIMESTAMP");
        $stmt->execute();
        $now = $stmt->fetch(PDO::FETCH_ASSOC);
        return $now['CURRENT_TIMESTAMP'];
    }

    //añade unha inscripcion á táboa inscripcion
    public function add(Registration $registration)
    {
        //insertamos na taboa Registration
        $stmt = $this->db->prepare("INSERT INTO inscripcion( id_actividad, id_evento, id_alumno, fecha_inscripcion, id_pago) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array(
                $registration->getActivity()->getCodactivity(),
                $registration->getEvent()->getCodevent(),
                $registration->getAlumn()->getCodalumn(),
                $registration->getDate(),
                $registration->getPayment()->getIdPago()
            )
        );

        return $this->db->lastInsertId();
    }

    //Funcion de listar: devolve un array de todos obxetos Registration correspondentes á taboa inscripcion
    public function show()
    {
        //obtemos os datos da taboa usuario
        $stmt = $this->db->query("SELECT * FROM inscripcion");
        $registrations_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $registrations = array();
        //por cada inscripcione, obtemos os datos e creamos un obxeto no que se insertan
        foreach ($registrations_db as $regist) {
            //engadimos o usuario cos seus permisos a $users
            array_push($registrations, $this->view($regist["id_inscripcion"]));
        }
        //devolve o array
        return $registrations;
    }
    //devolve o obxecto Registration no que o $codRegistration coincida co da tupla.
    public function view($codRegistration)
    {
        $stmt = $this->db->prepare("SELECT * FROM inscripcion WHERE id_inscripcion = ?");
        $stmt->execute(array($codRegistration));
        $regist = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($regist != null) {
            return new Registration(
                $regist['id_inscripcion'],
                $this->activityMapper->view($regist['id_actividad']),
                $this->alumnMapper->view($regist['id_alumno']),
                $this->eventMapper->view($regist['id_evento']),
                $regist["fecha_inscripcion"],
                $this->paymentMapper->view($regist["id_pago"])
            );
        } else {
            return new Registration();
        }

    }
    //edita a tupla correspondente co id do obxecto Registration $registration
    public function edit(Registration $registration)
    {
        $stmt = $this->db->prepare("UPDATE inscripcion SET id_actividad = ? , id_evento = ?, id_alumno = ?, fecha_inscripcion = ? , id_pago = ? WHERE id_inscripcion = ?");
        $stmt->execute(array(
                        $registration->getActivity()->getCodactivity(), $registration->getEvent()->getCodevent(),
                $registration->getAlumn()->getCodalumn(), $registration->getDate(), $registration->getPayment()->getIdPago(), $registration->getCodRegistration()
                        )
                );
    }

    //borra sobre a taboa inscripcione a tupla con id igual a o do obxeto pasado
    public function delete($codRegistration)
    {
        $stmt = $this->db->prepare("DELETE from inscripcion WHERE id_inscripcion = '$codRegistration'");
        $stmt->execute();
    }


    public function search(Registration $registration){
        if($registration->getActivity()->getCodactivity() != NULL){
            if($registration->getEvent()->getCodevent() !=NULL){
                $stmt = $this->db->prepare("SELECT * FROM inscripcion WHERE id_actividad like ? AND id_event like ? AND id_alumno like ?");
                $stmt->execute(array(
                        "%".$registration->getActivity()->getCodactivity()."%", "%".$registration->getEvent()->getCodevent()."%", "%".$registration->getAlumn()->getCodalumn()."%")
                );
            }else{
                $stmt = $this->db->prepare("SELECT * FROM inscripcion WHERE id_actividad like ? AND id_alumno like ?");
                $stmt->execute(array(
                        "%".$registration->getActivity()->getCodactivity()."%", "%".$registration->getAlumn()->getCodalumn()."%")
                );
            }
        }else{
            if($registration->getEvent()->getCodevent() !=NULL){
                $stmt = $this->db->prepare("SELECT * FROM inscripcion WHERE id_event like ? AND id_alumno like ?");
                $stmt->execute(array(
                         "%".$registration->getEvent()->getCodevent()."%", "%".$registration->getAlumn()->getCodalumn()."%")
                );
            }else{
                $stmt = $this->db->prepare("SELECT * FROM inscripcion WHERE id_alumno like ?");
                $stmt->execute(array(
                        "%".$registration->getAlumn()->getCodalumn()."%")
                );
            }
        }

        $registrations_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $registrations = array();
        foreach ($registrations_db as $a){
            array_push($registrations, $this->view($a["id_inscripcion"]));
        }
        return $registrations;
    }
}