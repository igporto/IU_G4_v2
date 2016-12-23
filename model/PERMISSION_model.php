<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/PERMISSION.php");

require_once(__DIR__."/../model/ACTION.php");
require_once(__DIR__."/../model/CONTROLLER_model.php");

require_once(__DIR__."/../model/CONTROLLER.php");
require_once(__DIR__."/../model/ACTION_model.php");



class PermissionMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;
	private $cm;
	private $am;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
		$this->cm = new ControllerMapper();
		$this->am = new ActionMapper();
	}

	public function permissionExists(Permission $permission)
	{
		$stmt = $this->db->prepare("SELECT count(*) FROM permiso where id_controlador=? and id_accion=?");
		$stmt->execute(array($permission->getController()->getCodcontroller(), $permission->getAction()->getCodaction()));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
	
	public function getIdPermission(Permission $permission){
		$stmt = $this->db->prepare("SELECT id_permiso FROM permiso where id_controlador=? and id_accion=?");
		$stmt->execute(array($permission->getController()->getCodcontroller(), $permission->getAction()->getCodaction()));
		$result_db = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result_db["id_permiso"];
	}
	
	
	//Inserta na base de datos unha tupla cos datos do obxeto $permission
	public function add(Permission $permission) {
		$stmt = $this->db->prepare("INSERT INTO permiso(id_controlador, id_accion) values (?,?)"); 
		$stmt->execute(array($permission->getController()->getCodcontroller(), $permission->getAction()->getCodaction()));
		return $this->db->lastInsertId();
	}

	//Funcion de listar: devolve un array de todos obxetos Permission correspondentes á tabla Permission
	public function show() {
		$stmt = $this->db->query("SELECT * FROM permiso");
		$permission_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$permissions = array();

		foreach ($permission_db as $permission) {
			array_push($permissions, $this->view($permission["id_permiso"]));
		}
		//devolve o array
		return $permissions;
	}

	//devolve o obxecto Permission no que o $permission_campo_id coincida co da tupla.
	public function view($id_permiso){
		$stmt = $this->db->prepare("SELECT * FROM permiso WHERE id_permiso=?");
		$stmt->execute(array($id_permiso));
		$permission = $stmt->fetch(PDO::FETCH_ASSOC);

		if($permission != null) {
			return new Permission($permission["id_permiso"], 
						$this->cm->view($permission['id_controlador']), 
						$this->am->view($permission['id_accion']));
		} else {
			return  new Permission();
		}
	}

	//edita a tupla correspondente co id do obxecto Permission $permission
	public function edit(Permission $permission) {
		$stmt = $this->db->prepare("UPDATE permiso set id_controlador=?, id_accion=? where id_permiso=?");
		$stmt->execute(
			array(
					$permission->getController()->getCodcontroller(), 
					$permission->getAction()->getCodaction(), 
					$permission->getCodpermission()
				)
		);
	}

		
	//borra sobre a taboa permiso a tupla con id igual a o do obxeto pasado	
	public function delete($perm_id) {
		$stmt = $this->db->prepare("DELETE from permiso WHERE id_permiso=?");
		$stmt->execute(array($perm_id));
	}
}
