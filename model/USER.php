<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/PROFILE.php");
require_once(__DIR__."/../model/PERMISSION.php");
require_once(__DIR__."/../model/USERPERMISSION.php");

class User {

	public $coduser;
	public $username;
	public $passwd;
	public $profile;
    public $permissions;



	public function __construct($username=NULL, $coduser=NULL, $passwd=NULL, Profile $profile=NULL, UserPermission $permissions=NULL) {
		$this->username = $username;
		$this->passwd = $passwd;
		$this->coduser = $coduser;
		$this->profile = $profile;
        $this->permissions = $permissions;
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
    public function setCoduser($coduser)
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
    public function setUsername($username)
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
    public function setPasswd($passwd)
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
    public function setProfile(Profile $profile)
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
     * @return mixed    
     */

    public function setPermissions(UserPermission $permissions)
    {
        $this->permissions = $permissions;

        return $this;
    }
}
