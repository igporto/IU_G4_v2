<?php
require_once(__DIR__."/../core/ValidationException.php");


class UserPermission {

    private $coduser;
    private $userPermissions;

	public function __construct($coduser=NULL, array $userPermissions=NULL) {
		$this->coduser = $coduser;
        $this->userPermissions = $userPermissions;
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
     * Gets the value of userPermissions.
     *
     * @return mixed
     */
    public function getUserPermissions()
    {
        return $this->userPermissions;
    }

    /**
     * Sets the value of userPermissions.
     *
     * @param mixed $userPermissions the user permissions
     *
     */
    private function setUserPermissions(array $userPermissions)
    {
        $this->userPermissions = $userPermissions;

    }
}
