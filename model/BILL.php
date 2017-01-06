<?php

//Modelo de exemple dun obxeto da app

//Icludes xerais
require_once(__DIR__ . "/../core/ValidationException.php");


//clase que representa unha tupla de 'Bill'
class Bill
{

    //cada un dos campos da tupla é un atributo
    private $id_factura;
    private $nombre;
    private $numero;
    private $fecha;

    //constructor da clase, inicializamos cada un dos campos
    //no caso de ser un campo 'autoincrement' debe inicializarse a null sempre que se queira insertar 
    public function __construct($id_factura = NULL, $nombre = NULL, $numero = NULL, $fecha = NULL)
    {
        $this->id_factura = $id_factura;
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->fecha = $fecha;
    }

    //GETTERS E SETTERS DO OBXETO
    /**
     * @return null
     */
    public function getIdFactura()
    {
        return $this->id_factura;
    }

    /**
     * @param null $id_factura
     */
    public function setIdFactura($id_factura)
    {
        $this->id_factura = $id_factura;
    }

    /**
     * @return null
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param null $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return null
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param null $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
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


}
