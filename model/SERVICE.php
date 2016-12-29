<?php

require_once(__DIR__."/../core/ValidationException.php");

class Service {

    private $id;
    private $fecha;
    private $coste;
    private $descripcion;
    private $dni_cliente_externo;

    /**
     * Service constructor.
     * @param $id
     * @param $fecha
     * @param $coste
     * @param $descipcion
     * @param $dni_cliente_externo
     */
    public function __construct($id=NULL, $fecha=NULL, $coste=NULL, $descripcion=NULL, $dni_cliente_externo=NULL)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->coste = $coste;
        $this->descripcion = $descripcion;
        $this->dni_cliente_externo = $dni_cliente_externo;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getCoste()
    {
        return $this->coste;
    }

    /**
     * @param null $coste
     */
    public function setCoste($coste)
    {
        $this->coste = $coste;
    }

    /**
     * @return null
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param null $descipcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return null
     */
    public function getDniClienteExterno()
    {
        return $this->dni_cliente_externo;
    }

    /**
     * @param null $dni_cliente_externo
     */
    public function setDniClienteExterno($dni_cliente_externo)
    {
        $this->dni_cliente_externo = $dni_cliente_externo;
    }



}
