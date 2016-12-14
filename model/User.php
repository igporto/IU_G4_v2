<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/Profile.php");
require_once(__DIR__."/../model/Permission.php");

class User {

	private $coduser;
	private $username;
	private $passwd;
	private $profile;
    private $permissions;



	public function __construct($username=NULL, $coduser=NULL, $passwd=NULL, Profile $profile=NULL, array $permissions=NULL) {
		$this->username = $username;
		$this->passwd = $passwd;
		$this->coduser = $coduser;
		$this->profile = $profile;
        $this->permissions = $permissions;
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
     */
    private function setCoduser($coduser)
    {
        $this->coduser = $coduser;
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
     */
    private function setUsername($username)
    {
        $this->username = $username;
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
     */
    private function setPasswd($passwd)
    {
        $this->passwd = $passwd;
    }

    /**
     * Gets the value of profile.
     *
     * @return mixed
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Sets the value of profile.
     *
     * @param mixed $profile the profile
     */
    private function setProfile(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * Gets the value of permissions.
     *
     * @return mixed
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * Sets the value of permissions.
     *
     * @param mixed $permissions the permissions
     */
    private function setPermissions(array $permissions)
    {
        $this->permissions = $permissions;

        return $this;
    }
}
