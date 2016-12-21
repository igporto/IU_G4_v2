<?php

require_once(__DIR__."/../core/ValidationException.php");

class Action {

	private $codaction;
	private $actionname;




	public function __construct($codaction=NULL, $actionname=NULL) {
		$this->actionname = $actionname;
		$this->codaction = $codaction;
	}

	

	

    /**
     * Gets the value of codaction.
     *
     * @return mixed
     */
    public function getCodaction()
    {
        return $this->codaction;
    }

    /**
     * Gets the value of actionname.
     *
     * @return mixed
     */
    public function getActionname()
    {
        return $this->actionname;
    }

    /**
     * Sets the value of actionname.
     *
     * @param mixed $actionname the actionname
     *
     * @return self
     */
    public function setActionname($actionname)
    {
        $this->actionname = $actionname;

        return $this;
    }

    /**
     * Sets the value of codaction.
     *
     * @param mixed $codaction the codaction
     *
     * @return self
     */
    public function setCodaction($codaction)
    {
        $this->codaction = $codaction;

        return $this;
    }
    

}
