<?php
//Modelo de Mapper dun Obxeto
//Encárgase de realizar todas as accións posibles sobre a db do obxeto

//Include da conexion
require_once(__DIR__."/../core/PDOConnection.php");

//Include do obxeto que mapeas
require_once(__DIR__."/../model/PROFILE.php");
require_once(__DIR__."/../model/PERMISSION.php");
require_once(__DIR__."/../model/PERMISSION_model.php");



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
		$stmt = $this->db->prepare("INSERT INTO perfil(nombre) values (?)");
		$stmt->execute(array($profile->getProfilename()));

		//Unha vez insertado o nome do Perfil insertamos no obxecto $profile o id do perfil(Autoxenérase)
		$stmt = $this->db->prepare("SELECT id_perfil FROM perfil WHERE nombre = (?)");
		$stmt->execute(array($profile->getProfilename()));
		$result_db = $stmt->fetch(PDO::FETCH_ASSOC);
		//E asignamosllo ao perfil
		$profile->setCodprofile($result_db["id_perfil"]);
		//insertamos os permisos do perfil
		foreach ($profile->getPermissions() as $permiso) {
			$this->addPermission($profile, $permiso);
		}

		return $this->db->lastInsertId();
	}
	
	//Funcion de listar: devolve un array de todos obxetos Profile correspondentes á tabla Profile
	public function show() {

		//Obtemos todos os perfiles da BD
		$stmt1 = $this->db->query("SELECT  id_perfil, nombre as p_nombre FROM  perfil");
		$stmt1->execute();
		$profiles1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

		//Array de obxectos Profile que se vai a devolver
		$profiles = array();

		//engadimos os obxectos Profile empregando a query que devolve todos os perfiles da BD
		foreach ($profiles1 as $profile) {
			array_push($profiles, $this->view($profile["id_perfil"]));
		}

		//devolve o array
		return $profiles;
	}

	//devolve o obxecto Profile no que o $id_perfil coincida co da tupla.
	public function view($id_perfil){
		//Consultamos se o perfil ten permisos asociados
		$stmt = $this->db->prepare("SELECT  pf.id_perfil, pf.nombre, pp.id_permiso
			FROM perfil pf, permisos_perfil pp
			WHERE pf.id_perfil = pp.id_perfil AND pp.id_perfil = ?");
		$stmt->execute(array($id_perfil));
		$result_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		//Creamos o array de permisos baleiro
		$permissions = array();

		if($result_db != null) {
			//Se ten permisos recorremolos e engadimolos ao array de permisos
			foreach ($result_db as $permiso) {
				array_push($permissions,$this->pm->view($permiso['id_permiso']));
			}
		} else {
			//Se non ten permisos recuperamos o nome para crear o obxecto Profile
			$stmt = $this->db->prepare("SELECT  id_perfil, nombre
			FROM perfil 
			WHERE id_perfil = ?");
			$stmt->execute(array($id_perfil));
			$result_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		return new Profile($result_db[0]["id_perfil"], $result_db[0]["nombre"], $permissions);;
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
	public function delete($profile_id) {
		$stmt = $this->db->prepare("DELETE from perfil WHERE id_perfil = ?");
		$stmt->execute(array($profile_id));
	}

	//Comproba se existe un perfil con ese nome
	public function profilenameExists($profilename)
	{
		$stmt = $this->db->prepare("SELECT count(*) FROM perfil where nombre=?");
		$stmt->execute(array($profilename));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
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
