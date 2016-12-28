<?php

//Modelo de exemple dun obxeto da app

//Icludes xerais
require_once(__DIR__ . "/../core/ValidationException.php");

//clase que representa unha tupla de 'Payment'
class Payment
{

    //cada un dos campos da tupla é un atributo
    private $id_pago;
    private $fecha;
    private $cantidad;
    private $metodo_pago;
    private $descuento;
    private $id_inscripcion;
    private $id_servicio;
    private $id_reserva;

    //constructor da clase, inicializamos cada un dos campos
    //no caso de ser un campo 'autoincrement' debe inicializarse a null sempre que se queira insertar 
    public function __construct($id_pago = NULL, $fecha = NULL, $cantidad = NULL, $metodo_pago = NULL, $descuento = NULL,
                                $id_inscripcion = NULL, $id_servicio = NULL, $id_reserva = NULL)
    {
        $this->id_pago = $id_pago;
        $this->fecha = $fecha;
        $this->cantidad = $cantidad;
        $this->metodo_pago = $metodo_pago;
        $this->descuento = $descuento;
        $this->id_inscripcion = $id_inscripcion;
        $this->id_servicio = $id_servicio;
        $this->id_reserva = $id_reserva;
    }

    /**
     * @return null
     */
    public function getIdPago()
    {
        return $this->id_pago;
    }

    /**
     * @param null $id_pago
     */
    public function setIdPago($id_pago)
    {
        $this->id_pago = $id_pago;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
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
    public function getMetodoPago()
    {
        return $this->metodo_pago;
    }

    /**
     * @param mixed $metodo_pago
     */
    public function setMetodoPago($metodo_pago)
    {
        $this->metodo_pago = $metodo_pago;
    }

    /**
     * @return mixed
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * @param mixed $descuento
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }

    /**
     * @return mixed
     */
    public function getIdInscripcion()
    {
        return $this->id_inscripcion;
    }

    /**
     * @param mixed $id_inscripcion
     */
    public function setIdInscripcion($id_inscripcion)
    {
        $this->id_inscripcion = $id_inscripcion;
    }

    /**
     * @return mixed
     */
    public function getIdServicio()
    {
        return $this->id_servicio;
    }

    /**
     * @param mixed $id_servicio
     */
    public function setIdServicio($id_servicio)
    {
        $this->id_servicio = $id_servicio;
    }

    /**
     * @return mixed
     */
    public function getIdReserva()
    {
        return $this->id_reserva;
    }

    /**
     * @param mixed $id_reserva
     */
    public function setIdReserva($id_reserva)
    {
        $this->id_reserva = $id_reserva;
    }


    //poden necesitarse métodos autocomprobantes como 'readyForInsert'
}
