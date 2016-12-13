<?php

require_once(__DIR__."/../core/ValidationException.php");

class Controller {

	private $codcontroller;
	private $controllername;




	public function __construct($codcontroller=NULL, $controllername=NULL) {
		$this->controllername = $controllername;
		$this->codcontroller = $codcontroller;
	}

	

	

    /**
     * Gets the value of codcontroller.
     *
     * @return mixed
     */
    public function getCodcontroller()
    {
        return $this->codcontroller;
    }

    /**
     * Sets the value of codcontroller.
     *
     * @param mixed $codcontroller the codcontroller
     *
     * @return self
     */
    private function setCodcontroller($codcontroller)
    {
        $this->codcontroller = $codcontroller;

        return $this;
    }


    /**
     * Gets the value of controllername.
     *
     * @return mixed
     */
    public function getControllername()
    {
        return $this->controllername;
    }

    /**
     * Sets the value of controllername.
     *
     * @param mixed $controllername the controllername
     *
     * @return self
     */
    private function setControllername($controllername)
    {
        $this->controllername = $controllername;

        return $this;
    }
    

}
