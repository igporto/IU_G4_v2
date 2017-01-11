<?php
require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/REGISTRATION.php");
require_once(__DIR__ . "/../model/RESERVE.php");
require_once(__DIR__ . "/../model/RESERVE_model.php");
require_once(__DIR__ . "/../model/PAYMENT.php");
require_once(__DIR__ . "/../model/PAYMENT_model.php");

class RegistrationMapper
{
    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;
    private $reserveMapper;
    private $paymentMapper;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
        $this->reserveMapper = new ReserveMapper();
        $this->paymentMapper = new PaymentMapper();
    }
    //añade unha inscripcion á táboa inscripcion
    public function add(Registration $registration)
    {
        //insertamos na taboa Registration
        $stmt = $this->db->prepare("INSERT INTO  inscripcion (id_reserva, fecha_inscripcion, id_pago) VALUES (?,?,?)");
        $stmt->execute(array(
                $registration->getReserve()->getCodReserve(),
                $registration->getDate(),
                $registration->getPayment()->getIdPago()
            )
        );
        return $this->db->lastInsertId();
    }
    public function getCodRegistration($codRegistration)
    {
        $stmt = $this->db->prepare("SELECT id_inscripcion FROM inscripcion WHERE  id_inscripcion= ?");
        $stmt->execute(array($codRegistration));

        return $stmt->fetch(PDO::FETCH_ASSOC)['id_inscripcion'];
    }
    public function getCodReserve($id){
        $stmt = $this->db->prepare("SELECT * FROM reserva WHERE id_reserva ='$id'");
        $stmt->execute();

        $r = $stmt->fetch();
        $id_sp = $r['id_reserva'];

        return $id_sp;
    }
    public function getIdPago($id){
        $stmt = $this->db->prepare("SELECT * FROM pago WHERE id_pago ='$id'");
        $stmt->execute();

        $r = $stmt->fetch();
        $id_sp = $r['id_pago'];

        return $id_sp;
    }
    public function selectReserveId(){
        $stmt = $this->db->prepare("SELECT * FROM reserva");
        $stmt->execute();

        $id = array();
        $resul = $stmt->fetchAll();
        foreach($resul as $r){
            array_push($id,$r['id_reserva']);
        }

        return $id;
    }
    public function selectPaymentId(){
        $stmt = $this->db->prepare("SELECT * FROM pago");
        $stmt->execute();

        $id = array();
        $resul = $stmt->fetchAll();
        foreach($resul as $r){
            array_push($id,$r['id_pago']);
        }

        return $id;
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
                $this->reserveMapper->view($regist["id_reserva"]),
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
        $stmt = $this->db->prepare("UPDATE inscripcion SET id_reserva = ? , fecha_inscripcion = ? , id_pago = ? WHERE id_inscripcion = ?");
        $stmt->execute(array(
                        $registration->getReserve()->getCodReserve(), $registration->getDate(), $registration->getPayment()->getIdPago()
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
        $registration->getCodRegistration();exit;
        $stmt = $this->db->prepare("SELECT * FROM inscripcion WHERE id_inscripcion like ? AND id_reserva like ? AND fecha_inscripcion like ? AND id_pago like ? ");
        $stmt->execute(array(
                "%".$registration->getCodRegistration()."%", "%".$registration->getReserve()->getCodReserve()."%", "%".$registration->getDate()."%", "%".$registration->getPayment()->getIdPago()."%")
                );
        $registrations_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $registrations = array();
        foreach ($registrations_db as $a){
            array_push($registrations, $this->view($a["id_inscripcion"]));
        }
        return $registrations;
    }
}