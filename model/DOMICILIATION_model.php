<?php
//Modelo de Mapper dun Obxeto
//Encárgase de realizar todas as accións posibles sobre a db do obxeto

//Include da conexion
require_once(__DIR__ . "/../core/PDOConnection.php");

//Include do obxeto que mapeas
require_once(__DIR__ . "/../model/DOMICILIATION.php");

//inclues de outros obxetos que se precisen

class DomiciliationMapper
{

    //Obtemos a instancia da conexión
    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    //Inserta na base de datos unha tupla cos datos do obxeto $domiciliation
    public function add(Domiciliation $domiciliation)
    {
        //cambiar a sentencia acorde á taboa que referencia
        //IMPORTANTE: se a PK da táboa é autoincremental, non se inserta manualmente (non se pon nos 'campo' nin nos '?')
        $stmt = $this->db->prepare("INSERT INTO domiciliacion(id_domiciliacion, periodo,total,id_cliente,iban) values (?,?,?,?,?)"); //1 ? por campo a insertar

        //cada elemento do array será insertado no correspondente ? da query
        $stmt->execute(array($domiciliation->getIdDomiciliacion(), $domiciliation->getPeriodo(), $domiciliation->getTotal(), $domiciliation->getIdCliente(),
            $domiciliation->getIban()));

        //devolve o ID do último elemento insertado
        return $this->db->lastInsertId();
    }

    //Funcion de listar: devolve un array de todos obxetos Domiciliation correspondentes á tabla Domiciliation
    public function show()
    {

        $stmt = $this->db->query("SELECT * FROM domiciliacion");
        $domiciliation_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $domiciliations = array();

        foreach ($domiciliation_db as $domiciliation) {
            //se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
            //introduce no array o obxeto Domiciliation creado a partir da query
            array_push($domiciliations, new Domiciliation($domiciliation["id_domiciliacion"], $domiciliation["periodo"], $domiciliation["total"],
                $domiciliation["id_cliente"], $domiciliation["iban"]));
        }

        //devolve o array
        return $domiciliations;
    }


    //devolve o obxecto Domiciliation no que o $domiciliation_campo_id coincida co da tupla.
    public function view($domiciliation_campo_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM domiciliacion WHERE id_domiciliacion=?");
        $stmt->execute(array($domiciliation_campo_id));
        $domiciliation = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($domiciliation != null) {
            return new Domiciliation($domiciliation["id_domiciliacion"], $domiciliation["periodo"], $domiciliation["total"],
                $domiciliation["id_cliente"], $domiciliation["iban"]);
        } else {
            return NULL;
        }
    }


    //edita a tupla correspondente co id do obxecto Domiciliation $domiciliation
    public function edit(Domiciliation $domiciliation)
    {
        $stmt = $this->db->prepare("UPDATE domiciliacion set periodo=?, total=?, id_cliente=?, iban=? where id_domiciliacion=?");

        $stmt->execute(array($domiciliation->getPeriodo(), $domiciliation->getTotal(), $domiciliation->getIdCliente(),
            $domiciliation->getIban()));
    }


    //borra sobre a taboa domiciliacion a tupla con id igual a o do obxeto pasado
    public function delete(Domiciliation $domiciliation)
    {
        $stmt = $this->db->prepare("DELETE from domiciliacion WHERE id_domiciliacion=?");
        $stmt->execute(array($domiciliation->getIdDomiciliacion()));
    }

    //Comproba se existe un perfil con ese nome
    public function domiciliationIdExists($domiciliationId)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM domiciliacion where id_domiciliacion=?");
        $stmt->execute(array($domiciliationId));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    public function search(Domiciliation $domiciliation){
        $stmt = $this->db->prepare("SELECT * FROM domiciliacion WHERE id_domiciliacion like ?");
        $stmt->execute(array("%".$domiciliation->getIdDomiciliacion()."%"));
        $domiciliations_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $domiciliations = array();
        foreach ($domiciliations_db as $p){
            array_push($domiciliations, new Domiciliation(
                    $p['id_domiciliacion'])
            );
        }
        return $domiciliations;
    }
}
