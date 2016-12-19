<?php
//Modelo de Mapper dun Obxeto
//Encárgase de realizar todas as accións posibles sobre a db do obxeto

//Include da conexion
require_once(__DIR__."/../core/PDOConnection.php");

//Include do obxeto que mapeas
require_once(__DIR__."/../model/Profile.php");
require_once(__DIR__."/../model/Permission.php");
require_once(__DIR__."/../model/PermissionMapper.php");



//inclues de outros obxetos que se precisen
//Por exemplo: 


class ProfileMapper {

	//Obtemos a instancia da conexión
	private $db;
	private $pm;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
		$this->pm = new PermissionMapper();
	}

	//Inserta na base de datos unha tupla cos datos do obxeto $profile
	public function add(Profile $profile) {	
		//insertamos un novo perfil	
		$stmt = $this->db->prepare("INSERT INTO perfil(id_perfil, nombre) values (?,?)"); 
		$stmt->execute(array($profile->getCodprofile(), $profile->getProfilename()));

		//insertamos os permisos do perfil
		foreach ($profile->getPermissions() as $permiso) {
			$this->addPermission($profile, $permiso);	
		}

		return $this->db->lastInsertId();
	}

	//ACABADO
	//Funcion de listar: devolve un array de todos obxetos Profile correspondentes á tabla Profile
	public function show() {

		$stmt = $this->db->query("SELECT  pf.id_perfil, pf.nombre as p_nombre, pp.id_permiso
			FROM  perfil pf, permisos_perfil pp 
			WHERE pf.id_perfil = pp.id_perfil");

		$result_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$results = array();
		$permissions = array();
		$profiles = array();
		//setteamos o perfil actual ao primeiro perfil
		$currentProfile = $result_db[0];

		//recorremos o resultado da query
		foreach ($result_db as $result) {	
			if($result['id_perfil'] != $currentProfile['id_perfil']){
				//cando se cambia de perfil, creamos o perfil anterior
				array_push($profiles, new Profile($currentProfile["id_perfil"], $currentProfile["p_nombre"], $permissions));
				//setteamos o perfil actual ó novo perfil
				$currentProfile = $result;
				//baleiramos o array de permisos do novo perfil
				$permissions = array();
			}
				
			//mentres sexa o mesmo perfil, almacenamos os permisos do perfil actual en $permissions
			array_push($permissions, $this->pm->view($result['id_permiso']));
		
		}
		//engadimos o ultimo perfil
		array_push($profiles, new Profile($currentProfile["id_perfil"], $currentProfile["p_nombre"], $permissions));

		//devolve o array
		return $profiles;
	}


	//devolve o obxecto Profile no que o $id_perfil coincida co da tupla.
	public function view($id_perfil){
		$stmt = $this->db->prepare("SELECT  pf.id_perfil, pf.nombre as p_nombre, pp.id_permiso
			FROM perfil pf, permisos_perfil pp 
			WHERE pf.id_perfil = pp.id_perfil AND pf.id_perfil = ?");
		$stmt->execute(array($id_perfil));
		$result_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if($result_db != null) {
			$permissions = array();

			//insertamos os permisos do perfil no obxeto
			foreach ($result_db as $permiso) {
				array_push($permissions,$this->pm->view($permiso['id_permiso']));	

			}

			$profile = new Profile(
				$result_db[0]["id_perfil"],
				$result_db[0]["p_nombre"],
				$permissions
				);

			return $profile;
		} else {
			return new Profile();
		}
	}

	//edita a tupla correspondente co id do obxecto Profile $profile
	public function edit(Profile $profile) {
		//actualizar datos de perfil
		$stmt = $this->db->prepare("UPDATE perfil set nombre = ? where id_perfil=?");
		$stmt->execute(array(
					$profile->getProfilename(), 
					$profile->getCodprofile()
				)
		);

		//eliminar permisos vellos do perfil
		$stmt = $this->db->prepare("DELETE FROM permisos_perfil where id_perfil=?");
		$stmt->execute(array( 
				$profile->getCodprofile()
				)
		);

		//insetar novos permisos
		foreach ($profile->getPermissions() as $permiso) {
			$stmt = $this->db->prepare("INSERT INTO permisos_perfil(id_perfil,id_permiso) values (?, ?)");
			$stmt->execute(array(
					$profile->getCodprofile(), 
					$permiso->getCodpermission()
				)
		);
		}
	}

	//borra sobre a taboa perfil a tupla con id igual a o do obxeto pasado	
	public function delete(Profile $profile) {
		$stmt = $this->db->prepare("DELETE from perfil WHERE id_perfil = ?");
		$stmt->execute(array($profile->getCodprofile()));
	}

	//engade un permiso $permission ao perfil $profile
	private function addPermission(Profile $profile, Permission $permission)
	{
		$stmt = $this->db->prepare("INSERT INTO permisos_perfil(id_perfil, id_permiso) values (?,?)"); 
		$stmt->execute(array($profile->getCodprofile(), $permission->getCodpermission()));

		return $this->db->lastInsertId();
	}

	//quita un permiso $permission ao perfil $profile
	private function removePermission(Profile $profile, Permission $permission)
	{
		$stmt = $this->db->prepare("DELETE FROM permisos_perfil WHERE id_perfil = ? AND id_permiso = ?"); 
		$stmt->execute(array($profile->getCodprofile(), $permission->getCodpermission()));

		return $this->db->lastInsertId();
	}
}
