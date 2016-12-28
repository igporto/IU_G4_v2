<?php

//Modelo de exemple dun obxeto da app

//Icludes xerais
require_once(__DIR__."/../core/ValidationException.php");


//clase que representa unha tupla de 'Example'
class Example {

    //cada un dos campos da tupla é un atributo
	private $codexample;
    private $campo1;




    //constructor da clase, inicializamos cada un dos campos
    //no caso de ser un campo 'autoincrement' debe inicializarse a null sempre que se queira insertar 
	public function __construct($codexample=NULL, $campo1=NULL) {
		$this->codexample = $codexample;
        $this->campo1 = $campo1;

	}

    //GETTERS E SETTERS DO OBXETO
    /**
     * Gets the value of codexample.
     *
     * @return mixed
     */
    public function getCodexample()
    {
        return $this->codexample;
    }

    /**
     * Sets the value of codexample.
     *
     * @param mixed $codexample the codexample
     *
     * @return self
     */
    private function setCodexample($codexample)
    {
        $this->codexample = $codexample;

    }

    //poden necesitarse métodos autocomprobantes como 'readyForInsert'

    /**
     * Gets the value of campo1.
     *
     * @return mixed
     */
    public function getCampo1()
    {
        return $this->campo1;
    }

    /**
     * Sets the value of campo1.
     *
     * @param mixed $campo1 the campo1
     *
     * @return self
     */
    private function setCampo1($campo1)
    {
        $this->campo1 = $campo1;
    }
}
