<?php
//Modelo de Mapper dun Obxeto
//Encárgase de realizar todas as accións posibles sobre a db do obxeto

//Include da conexion
require_once(__DIR__."/../core/PDOConnection.php");

//Include do obxeto que mapeas
require_once(__DIR__."/../model/UserPermission.php");
require_once(__DIR__."/../model/Permission.php");
require_once(__DIR__."/../model/PermissionMapper.php");



//inclues de outros obxetos que se precisen
//Por exemplo: 


class UserPermissionMapper {

	//Obtemos a instancia da conexión
	private $db;
	private $pm;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
		$this->pm = new PermissionMapper();
	}

	//Inserta na base de datos unha tupla cos datos do obxeto $userpermission
	public function add(UserPermission $userpermission) {
		//insertamos os permisos do usuario_tiene_permiso
		foreach ($userpermission->getPermissions() as $permiso) {
			$this->addPermission($userpermission, $permiso);	
		}

		return $this->db->lastInsertId();
	}

	//ACABADO
	//Funcion de listar: devolve un array de todos obxetos UserPermission correspondentes á tabla UserPermission
	public function show() {

		$stmt = $this->db->query("SELECT cod_usuario, id_permiso FROM usuario_tiene_permiso");

		$result_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$results = array();
		$permissions = array();
		$userpermissions = array();
		//setteamos o usuario_tiene_permiso actual ao primeiro usuario_tiene_permiso
		$currentUserPermission = $result_db[0];

		//recorremos o resultado da query
		foreach ($result_db as $result) {	
			if($result['cod_usuario'] != $currentUserPermission['cod_usuario']){
				//cando se cambia de usuario_tiene_permiso, creamos o usuario_tiene_permiso anterior
				array_push($userpermissions, new UserPermission($currentUserPermission["cod_usuario"], $permissions));
				//setteamos o usuario_tiene_permiso actual ó novo usuario_tiene_permiso
				$currentUserPermission = $result;
				//baleiramos o array de permisos do novo usuario_tiene_permiso
				$permissions = array();
			}
				
			//mentres sexa o mesmo usuario_tiene_permiso, almacenamos os permisos do usuario_tiene_permiso actual en $permissions
			array_push($permissions, $this->pm->view($result['id_permiso']));
		
		}
		//engadimos o ultimo usuario_tiene_permiso
		array_push($userpermissions, new UserPermission($currentUserPermission["cod_usuario"], $permissions));

		//devolve o array
		return $userpermissions;
	}


	//devolve o obxecto UserPermission no que o $id_usuario_tiene_permiso coincida co da tupla.
	public function view($cod_usuario){
		$stmt = $this->db->prepare("SELECT cod_usuario, id_permiso
			FROM usuario_tiene_permiso
			WHERE cod_usuario = ?");
		$stmt->execute(array($cod_usuario));
		$result_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if($result_db != null) {
			$permissions = array();

			//insertamos os permisos do usuario_tiene_permiso no obxeto
			foreach ($result_db as $permiso) {
				array_push($permissions, $this->pm->view($permiso['id_permiso']));	

			}

			$userpermission = new UserPermission(
				$result_db[0]["cod_usuario"],
				$permissions
			);

			return $userpermission;
		} else {
			return  new UserPermission();
		}
	}

	//edita a tupla correspondente co id do obxecto UserPermission $userpermission
	public function edit(UserPermission $userpermission) {
		//eliminar permisos vellos do usuario_tiene_permiso
		$stmt = $this->db->prepare("DELETE FROM usuario_tiene_permiso where cod_usuario=?");
		$stmt->execute(array($userpermission->getCoduser()));

		//insetar novos permisos
		foreach ($userpermission->getPermissions() as $permiso) {
			$stmt = $this->db->prepare("INSERT INTO usuario_tiene_permiso(cod_usuario,id_permiso) values (?, ?)");
			$stmt->execute(array(
					$userpermission->getCoduser(), 
					$permiso->getCodpermission()
					)
			);
		}
	}

	//borra sobre a taboa usuario_tiene_permiso a tupla con id igual a o do obxeto pasado	
	public function delete(UserPermission $userpermission) {
		foreach ($userpermission->getPermissions() as $permiso){
			$this->removePermission($userpermission,$permiso );
		}
		
	}

	//engade un permiso $permission ao usuario_tiene_permiso $userpermission
	private function addPermission(UserPermission $userpermission, Permission $permission)
	{
		$stmt = $this->db->prepare("INSERT INTO usuario_tiene_permiso(cod_usuario, id_permiso) values (?,?)"); 
		$stmt->execute(array($userpermission->getCoduser(), $permission->getCodpermission()));

		return $this->db->lastInsertId();
	}

	//quita un permiso $permission ao usuario_tiene_permiso $userpermission
	private function removePermission(UserPermission $userpermission, Permission $permission)
	{
		$stmt = $this->db->prepare("DELETE FROM usuario_tiene_permiso WHERE cod_usuario = ? AND id_permiso = ?"); 
		$stmt->execute(array($userpermission->getCoduser(), $permission->getCodpermission()));

		return $this->db->lastInsertId();
	}
}
