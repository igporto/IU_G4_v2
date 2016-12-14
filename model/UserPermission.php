<?php
require_once(__DIR__."/../core/ValidationException.php");


class UserPermission {

    private $coduser;
    private $permissions;

	public function __construct($coduser=NULL, array $permissions=NULL) {
		$this->coduser = $coduser;
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
    private function setCoduser($coduser)
    {
        $this->coduser = $coduser;

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
    private function setPermissions(array $permissions)
    {
        $this->permissions = $permissions;

    }
}
