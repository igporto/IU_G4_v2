<?php

require_once(__DIR__."/../core/ValidationException.php");

class User {

	private $coduser;
	private $username;
	private $passwd;
	private $idperf;



	public function __construct($coduser=NULL, $username=NULL, $passwd=NULL, $idperf=NULL) {
		$this->username = $username;
		$this->passwd = $passwd;
		$this->coduser = $coduser;
		$this->idperf = $idperf;
	}

	

	/**
     * Gets the value of idperf.
     *
     * @return mixed
     */
    public function getIdperf()
    {
        return $this->idperf;
    }

    /**
     * Sets the value of idperf.
     *
     * @param mixed $idperf the idperf
     *
     * @return self
     */
    private function setIdperf($idperf)
    {
        $this->idperf = $idperf;

        return $this;
    }

    /**
     * Gets the value of coduser.
     *
     * @return mixed
     */
    public function getCoduser()
    {
        return $this->coduser;
    }

    /**
     * Sets the value of coduser.
     *
     * @param mixed $coduser the coduser
     *
     * @return self
     */
    private function setCoduser($coduser)
    {
        $this->coduser = $coduser;

        return $this;
    }


    /**
     * Gets the value of username.
     *
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the value of username.
     *
     * @param mixed $username the username
     *
     * @return self
     */
    private function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Gets the value of passwd.
     *
     * @return mixed
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Sets the value of passwd.
     *
     * @param mixed $passwd the passwd
     *
     * @return self
     */
    private function setPasswd($passwd)
    {
        $this->passwd = $passwd;

        return $this;
    }

	
	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen($this->username) < 5) {
			$errors["username"] = "Username must be at least 5 characters length";

		}
		if (strlen($this->passwd) < 5) {
			$errors["passwd"] = "Password must be at least 5 characters length";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}

    

}
