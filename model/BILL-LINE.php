<?php

//Modelo de exemple dun obxeto da app

//Icludes xerais
require_once(__DIR__ . "/../core/ValidationException.php");


//clase que representa unha tupla de 'Bill'
class BillLine
{

    //cada un dos campos da tupla é un atributo
    private $id_factura;
    private $id_linea;
    private $concepto;
    private $precio;
    private $iva;
    private $unidades;
    private $total;

    //constructor da clase, inicializamos cada un dos campos
    //no caso de ser un campo 'autoincrement' debe inicializarse a null sempre que se queira insertar 
    public function __construct($id_factura = NULL, $id_linea = NULL, $concepto = NULL, $precio = NULL, $iva = NULL,
                                $unidades = NULL, $total = NULL)
    {
        $this->id_factura = $id_factura;
        $this->id_linea = $id_linea;
        $this->concepto = $concepto;
        $this->precio = $precio;
        $this->iva = $iva;
        $this->unidades = $unidades;
        $this->total = $total;
    }

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
    public function getIdLinea()
    {
        return $this->id_linea;
    }

    /**
     * @param null $id_linea
     */
    public function setIdLinea($id_linea)
    {
        $this->id_linea = $id_linea;
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
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param null $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * @return null
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * @param null $iva
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    }

    /**
     * @return null
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * @param null $unidades
     */
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;
    }

    /**
     * @return null
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param null $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

}
