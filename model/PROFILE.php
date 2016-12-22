<?php
require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/PERMISSION.php");


class Profile {

    private $codprofile;
    private $profilename;
    private $permissions;

	public function __construct($codprofile=NULL, $profilename=NULL,array $permissions=NULL) {
		$this->codprofile = $codprofile;
        $this->profilename = $profilename;
        $this->permissions = $permissions;
	}

   

    /**
     * Gets the value of codprofile.
     *
     * @return mixed
     */
    public function getCodprofile()
    {
        return $this->codprofile;
    }

    /**
     * Sets the value of codprofile.
     *
     * @param mixed $codprofile the codprofile
     *
     */
    public function setCodprofile($codprofile)
    {
        $this->codprofile = $codprofile;

    }

    /**
     * Gets the value of profilename.
     *
     * @return mixed
     */
    public function getProfilename()
    {
        return $this->profilename;
    }

    /**
     * Sets the value of profilename.
     *
     * @param mixed $profilename the profilename
     *
     */
    public function setProfilename($profilename)
    {
        $this->profilename = $profilename;

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
     *
     */
    public function setPermissions(array $permissions)
    {
        $this->permissions = $permissions;

    }
}
