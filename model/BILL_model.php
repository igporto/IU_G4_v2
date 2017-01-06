<?php
//Modelo de Mapper dun Obxeto
//Encárgase de realizar todas as accións posibles sobre a db do obxeto

//Include da conexion
require_once(__DIR__ . "/../core/PDOConnection.php");

//Include do obxeto que mapeas
require_once(__DIR__ . "/../model/BILL.php");

//inclues de outros obxetos que se precisen
require_once(__DIR__ . "/../model/BILL-LINE.php");

class BillMapper
{

    //Obtemos a instancia da conexión
    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    //Inserta na base de datos unha tupla cos datos do obxeto $bill
    public function add(Bill $bill)
    {
        //cambiar a sentencia acorde á taboa que referencia
        //IMPORTANTE: se a PK da táboa é autoincremental, non se inserta manualmente (non se pon nos 'campo' nin nos '?')
        $stmt = $this->db->prepare("INSERT INTO factura(id_factura, nombre,numero,fecha) values (?,?,?,?)"); //1 ? por campo a insertar

        //cada elemento do array será insertado no correspondente ? da query
        $stmt->execute(array($bill->getIdFactura(), $bill->getNombre(), $bill->getNumero(), $bill->getFecha()));

        //devolve o ID do último elemento insertado
        return $this->db->lastInsertId();
    }

    //Funcion de listar: devolve un array de todos obxetos Bill correspondentes á tabla Bill
    public function show()
    {

        $stmt = $this->db->query("SELECT * FROM factura");
        $bill_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $bills = array();

        foreach ($bill_db as $bill) {
            //se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
            //introduce no array o obxeto Bill creado a partir da query
            array_push($bills, new Bill($bill["id_factura"], $bill["nombre"], $bill["numero"],
                $bill["fecha"]));
        }

        //devolve o array
        return $bills;
    }


    //devolve o obxecto Bill no que o $bill_campo_id coincida co da tupla.
    public function view($bill_campo_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM factura WHERE id_factura =?");
        $stmt->execute(array($bill_campo_id));
        $bill = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($bill != null) {
            return new Bill($bill["id_factura"], $bill["nombre"], $bill["numero"],
                $bill["fecha"]);
        } else {
            return NULL;
        }
    }


    //edita a tupla correspondente co id do obxecto Bill $bill
    public function edit(Bill $bill)
    {
        $stmt = $this->db->prepare("UPDATE factura set nombre =?, numero =?, fecha =? where id_factura =?");

        $stmt->execute(array($bill->getNombre(), $bill->getNumero(), $bill->getFecha(), $bill->getIdFactura()));

    }


    //borra sobre a taboa factura a tupla con id igual a o do obxeto pasado
    public function delete(Bill $bill)
    {
        $stmt = $this->db->prepare("DELETE from factura WHERE id_factura =?");
        $stmt->execute(array($bill->getIdFactura()));
    }

    //Comproba se existe un perfil con ese nome
    public function billIdExists($billId)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM factura where id_factura =?");
        $stmt->execute(array($billId));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    public function search(Bill $bill)
    {
        $stmt = $this->db->prepare("SELECT * FROM factura WHERE id_factura like ? ");
        $stmt->execute(array(" % " . $bill->getIdFactura() . " % "));
        $bills_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $bills = array();
        foreach ($bills_db as $p) {
            array_push($bills, new Bill(
                    $p['id_factura'])
            );
        }
        return $bills;
    }

    public function tillspend(Till $till)
    {
        $stmt = $this->db->prepare("INSERT INTO caja(numero,id_factura,nombre,concepto) values (?,?,?,?)");
        $stmt->execute(array($till->getCantidad(), 0, $till->getFecha(), $till->getConcepto()));
    }

    public function tillwithdrawal(Till $till)
    {
        $stmt = $this->db->prepare("INSERT INTO caja(numero,id_factura,nombre,concepto) values (?,?,?,?)");
        $stmt->execute(array($till->getCantidad(), 0, $till->getFecha(), "WITHDRAWAL"));
    }

    public function tillconsult()
    {

        $stmt = $this->db->query("SELECT * FROM caja");
        $till_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tills = array();

        foreach ($till_db as $till) {
            //se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
            //introduce no array o obxeto Bill creado a partir da query
            array_push($tills, new Till($till["id_caja"], $till["numero"], $till["id_factura"], $till["nombre"], $till["concepto"]));
        }

        //devolve o array
        return $tills;
    }

    public function showlines()
    {

        $stmt = $this->db->query("SELECT * FROM linea_factura");
        $bill_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $bills = array();

        foreach ($bill_db as $bill) {
            //se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
            //introduce no array o obxeto Bill creado a partir da query
            array_push($bills, new BillLine($bill["id_factura"], $bill["id_linea"], $bill["concepto"],
                $bill["precio"], $bill["iva"], $bill["unidades"], $bill["total"]));
        }

        //devolve o array
        return $bills;
    }
}
