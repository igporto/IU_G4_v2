<?php
//Modelo de Mapper dun Obxeto
//Encárgase de realizar todas as accións posibles sobre a db do obxeto

//Include da conexion
require_once(__DIR__ . "/../core/PDOConnection.php");

//Include do obxeto que mapeas
require_once(__DIR__ . "/../model/PAYMENT.php");

//inclues de outros obxetos que se precisen

class PaymentMapper
{

    //Obtemos a instancia da conexión
    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    //Inserta na base de datos unha tupla cos datos do obxeto $payment
    public function add(Payment $payment)
    {
        //cambiar a sentencia acorde á taboa que referencia
        //IMPORTANTE: se a PK da táboa é autoincremental, non se inserta manualmente (non se pon nos 'campo' nin nos '?')
        $stmt = $this->db->prepare("INSERT INTO pago(id_pago, fecha,cantidad,metodo_pago,descuento,id_inscripcion,
                id_servicio,id_reserva) values (?,?,?,?,?,?,?,?)"); //1 ? por campo a insertar

        //cada elemento do array será insertado no correspondente ? da query
        $stmt->execute(array($payment->getCampo1(), $payment->getCampo2(), $payment->getCampoX()));

        //devolve o ID do último elemento insertado
        return $this->db->lastInsertId();
    }

    //Funcion de listar: devolve un array de todos obxetos Payment correspondentes á tabla Payment
    public function show()
    {

        $stmt = $this->db->query("SELECT * FROM pago");
        $payment_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $payments = array();

        foreach ($payment_db as $payment) {
            //se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
            //introduce no array o obxeto Payment creado a partir da query
            array_push($payments, new Payment($payment["id_pago"], $payment["fecha"], $payment["cantidad"],
                $payment["metodo_pago"], $payment["descuento"], $payment["id_inscripcion"], $payment["id_servicio"],
                $payment["id_reserva"]));
        }

        //devolve o array
        return $payments;
    }


    //devolve o obxecto Payment no que o $payment_campo_id coincida co da tupla.
    public function view($payment_campo_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM pago WHERE id_pago=?");
        $stmt->execute(array($payment_campo_id));
        $payment = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($payment != null) {
            return new Payment($payment["id_pago"], $payment["fecha"], $payment["cantidad"], $payment["metodo_pago"],
                $payment["descuento"], $payment["id_inscripcion"], $payment["id_servicio"], $payment["id_reserva"]);
        } else {
            return NULL;
        }
    }


    //edita a tupla correspondente co id do obxecto Payment $payment
    public function edit(Payment $payment)
    {
        $stmt = $this->db->prepare("UPDATE pago set campo1=?, campo2=? where payment_id=?");
        $stmt->execute(array($payment->getCampo1(), $payment->getCampo2(), $payment->getId()));
    }


    //borra sobre a taboa pago a tupla con id igual a o do obxeto pasado
    public function delete(Payment $payment)
    {
        $stmt = $this->db->prepare("DELETE from pago WHERE payment_id=?");
        $stmt->execute(array($payment->getId()));
    }

}
