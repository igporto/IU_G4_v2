<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Permission.php");

require_once(__DIR__."/../model/Action.php");
require_once(__DIR__."/../model/ControllerMapper.php");

require_once(__DIR__."/../model/Controller.php");
require_once(__DIR__."/../model/ActionMapper.php");



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


	//Inserta na base de datos unha tupla cos datos do obxeto $permission
	public function add(Permission $permission) {
		$stmt = $this->db->prepare("INSERT INTO permiso(id_controlador, id_accion) values (?,?)"); 
		$stmt->execute(array($permission->getController()->getCodcontroller(), $permission->getAction()->getCodaction()));
		return $this->db->lastInsertId();
	}

	//Funcion de listar: devolve un array de todos obxetos Permission correspondentes á tabla Permission
	public function show() {

		$stmt = $this->db->query("SELECT id_permiso, id_accion, id_controlador FROM permiso");
		$permission_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$permissions = array();

		foreach ($permission_db as $permission) {
			array_push($permissions, 
				new Permission($permission["id_permiso"]),
					$this->cm->view($permission['id_controlador']), 
					$this->am->view($permission['id_accion'])
				);
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
			return NULL;
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
	public function delete(Permission $permission) {
		$stmt = $this->db->prepare("DELETE from permiso WHERE id_permiso=?");
		$stmt->execute(array($permission->getCodpermission()));
	}
}
