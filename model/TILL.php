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
    private $fecha;
    private $concepto;


    //constructor da clase, inicializamos cada un dos campos
    //no caso de ser un campo 'autoincrement' debe inicializarse a null sempre que se queira insertar 
    public function __construct($id_caja = NULL, $cantidad = NULL, $id_pago = NULL,$fecha = NULL,$concepto = NULL)
    {
        $this->id_caja = $id_caja;
        $this->cantidad = $cantidad;
        $this->id_pago = $id_pago;
        $this->fecha = $fecha;
        $this->concepto = $concepto;
    }

    /**
     * @return null
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param null $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return null
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * @param null $concepto
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;
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
