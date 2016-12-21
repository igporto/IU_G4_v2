<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/ACTION.php");
require_once(__DIR__."/../model/CONTROLLER.php");


class Permission {

	private $codpermission;
	private $action;
    private $controller;


	public function __construct( $codpermission=NULL ,Controller $controller=NULL , Action $action=NULL) {
		$this->codpermission = $codpermission;
        $this->action = $action;
        $this->controller = $controller;
	}

    /**
     * Gets the value of codpermission.
     *
     * @return mixed
     */
    public function getCodpermission()
    {
        return $this->codpermission;
    }

    /**
     * Sets the value of codpermission.
     *
     * @param mixed $codpermission the codpermission
     *
     */
    private function setCodpermission($codpermission)
    {
        $this->codpermission = $codpermission;

    }

    /**
     * Gets the value of action.
     *
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Sets the value of action.
     *
     * @param mixed $action the action
     *
     */
    private function setAction(Action $action)
    {
        $this->action = $action;
    }

    /**
     * Gets the value of controller.
     *
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Sets the value of controller.
     *
     * @param mixed $controller the controller
     *
     */
    private function setController(Controller $controller)
    {
        $this->controller = $controller;
    }

    //to string for array_unique purposes
    //@return: a string with Codpermission
    public function __toString()
    {
        return "" . $this->getCodpermission() . "";
    }
}
