<?php

//Modelo de exemple dun obxeto da app

//Icludes xerais
require_once(__DIR__ . "/../core/ValidationException.php");

//clase que representa unha tupla de 'Payment'
class Till
{

    //cada un dos campos da tupla é un atributo
    private $id_caja;
    private $cantidad;
    private $id_pago;


    //constructor da clase, inicializamos cada un dos campos
    //no caso de ser un campo 'autoincrement' debe inicializarse a null sempre que se queira insertar 
    public function __construct($id_caja = NULL, $cantidad = NULL, $id_pago = NULL)
    {
        $this->id_caja = $id_caja;
        $this->cantidad = $cantidad;
        $this->id_pago = $id_pago;
    }

    /**
     * @return null
     */
    public function getIdCaja()
    {
        return $this->id_caja;
    }

    /**
     * @param null $id_caja
     */
    public function setIdCaja($id_caja)
    {
        $this->id_caja = $id_caja;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    /**
     * @return mixed
     */
    public function getIdPago()
    {
        return $this->id_pago;
    }

    /**
     * @param mixed $id_pago
     */
    public function setIdPago($id_pago)
    {
        $this->id_pago = $id_pago;
    }
}
