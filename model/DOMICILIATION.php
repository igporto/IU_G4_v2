<?php

//Modelo de exemple dun obxeto da app

//Icludes xerais
require_once(__DIR__ . "/../core/ValidationException.php");

//clase que representa unha tupla de 'Domiciliation'
class Domiciliation
{

    //cada un dos campos da tupla é un atributo
    private $id_domiciliacion;
    private $periodo;
    private $total;
    private $id_cliente;
    private $iban;
    private $documento;

    //constructor da clase, inicializamos cada un dos campos
    //no caso de ser un campo 'autoincrement' debe inicializarse a null sempre que se queira insertar 
    public function __construct($id_domiciliacion = NULL, $periodo = NULL, $total = NULL, $id_cliente = NULL, $iban = NULL, $documento = NULL)
    {
        $this->id_domiciliacion = $id_domiciliacion;
        $this->periodo = $periodo;
        $this->total = $total;
        $this->id_cliente = $id_cliente;
        $this->iban = $iban;
        $this->documento = $documento;
    }

    /**
     * @return null
     */
    public function getIdDomiciliacion()
    {
        return $this->id_domiciliacion;
    }

    /**
     * @param null $id_domiciliacion
     */
    public function setIdDomiciliacion($id_domiciliacion)
    {
        $this->id_domiciliacion = $id_domiciliacion;
    }

    /**
     * @return mixed
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * @param mixed $periodo
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getIdCliente()
    {
        return $this->id_cliente;
    }

    /**
     * @param mixed $id_cliente
     */
    public function setIdCliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }

    /**
     * @return mixed
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param mixed $iban
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * @param null $documento
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    }
}
