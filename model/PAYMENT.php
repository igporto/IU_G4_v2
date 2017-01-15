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
    private $pagado;
    private $tipo_cliente;
    private $dni_alum;
    private $dni_cliente_externo;

    //constructor da clase, inicializamos cada un dos campos
    //no caso de ser un campo 'autoincrement' debe inicializarse a null sempre que se queira insertar 
    public function __construct($id_pago = NULL, $fecha = NULL, $cantidad = NULL, $metodo_pago = NULL, $pagado = NULL,
                                $tipo_cliente = NULL, $dni_alum = NULL, $dni_cliente_externo = NULL)
    {
        $this->id_pago = $id_pago;
        $this->fecha = $fecha;
        $this->cantidad = $cantidad;
        $this->metodo_pago = $metodo_pago;
        $this->pagado = $pagado;
        $this->tipo_cliente = $tipo_cliente;
        $this->dni_alum = $dni_alum;
        $this->dni_cliente_externo = $dni_cliente_externo;
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
    public function getPagado()
    {
        return $this->pagado;
    }

    /**
     * @param mixed $pagado
     */
    public function setPagado($pagado)
    {
        $this->pagado = $pagado;
    }

    /**
     * @return mixed
     */
    public function getTipoCliente()
    {
        return $this->tipo_cliente;
    }

    /**
     * @param mixed $tipo_cliente
     */
    public function setTipoCliente($tipo_cliente)
    {
        $this->tipo_cliente = $tipo_cliente;
    }

    /**
     * @return mixed
     */
    public function getDniAlum()
    {
        return $this->dni_alum;
    }

    /**
     * @param mixed $dni_alum
     */
    public function setDniAlum($dni_alum)
    {
        $this->dni_alum = $dni_alum;
    }

    /**
     * @return mixed
     */
    public function getDniClienteExterno()
    {
        return $this->dni_cliente_externo;
    }

    /**
     * @param mixed $dni_cliente_externo
     */
    public function setDniClienteExterno($dni_cliente_externo)
    {
        $this->dni_cliente_externo = $dni_cliente_externo;
    }


    //poden necesitarse métodos autocomprobantes como 'readyForInsert'
}
