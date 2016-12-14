<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/User.php");


class UserMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	//return: o id do usuario co nome $username
	public function getIdByName($username)
	{
		$stmt = $this->db->prepare("SELECT cod_usuario FROM usuario WHERE  user= ?"); 
		$stmt->execute(array($username));

		return $stmt->fetch(PDO::FETCH_ASSOC)['cod_usuario'];
	}

	//añade un usuario á táboa usuario, e os seus permisos en usuario_tiene_permisos
	public function add(User $user) {

		//insertamos na taboa usuario
		$stmt = $this->db->prepare("INSERT INTO usuario(cod_usuario, passsword, user, id_perfil) values (?,?,?,?)"); 
		$stmt->execute(array(
								$user->getCoduser(),
								$user->getPasswd(),
								$user->getUsername(),
								$user->getProfile()->getCodprofile()
							)
					);

		//insertamos os permisos propios do ususario 
		$perms = $user->getPermissions();
		
		foreach ($perms as $perm) {
			$this->addPermission($user, $perm);
		}
		
		return $this->db->lastInsertId();
	}

	//Funcion de listar: devolve un array de todos obxetos User correspondentes á tabla User
	public function show() {

		$stmt = $this->db->query("SELECT * FROM usuario");
		$user_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$users = array();

		foreach ($user_db as $user) {
			//se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
			//introduce no array o obxeto User creado a partir da query
			array_push($users, new User($user["campo1"], $user["campo2"], $user["campoX"]));
		}

		//devolve o array
		return $users;
	}

	

	//devolve o obxecto User no que o $user_campo_id coincida co da tupla.
	public function view($user_campo_id){
		$stmt = $this->db->prepare("SELECT * FROM usuario WHERE campo_id=?");
		$stmt->execute(array($user_campo_id));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user != null) {
			return new User(
			$user["campo1"],
			$user["campo2"],
			$user["campoX"]
			);
		} else {
			return NULL;
		}
	}

	
		

	//edita a tupla correspondente co id do obxecto User $user
	public function edit(User $user) {
		$stmt = $this->db->prepare("UPDATE usuario set campo1=?, campo2=? where user_id=?");
		$stmt->execute(array($user->getCampo1(), $user->getCampo2(), $user->getId()));
	}

		
	//borra sobre a taboa usuario a tupla con id igual a o do obxeto pasado	
	public function delete(User $user) {
		$stmt = $this->db->prepare("DELETE from usuario WHERE user_id=?");
		$stmt->execute(array($user->getId()));
	}







	/**
	* Saves a User into the database
	*
	* @param User $user The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($user) {
		$stmt = $this->db->prepare("INSERT INTO usuario values (?,?,?,?)");
		$stmt->execute(array($user->getCoduser(), $user->getUsername(), $user->getPasswd(), $user->getIdperf()));
	}

	/**
	* Checks if a given username is already in the database
	*
	* @param string $username the username to check
	* @return boolean true if the username exists, false otherwise
	*/
	public function usernameExists($username) {
		$stmt = $this->db->prepare("SELECT count(user) FROM usuario where user=?");
		$stmt->execute(array($username));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	/**
	* Checks if a given pair of username/password exists in the database
	*
	* @param string $username the username
	* @param string $passwd the password
	* @return boolean true the username/passwrod exists, false otherwise.
	*/
	public function isValidUser($username, $password) {
		$stmt = $this->db->prepare("SELECT count(user) FROM usuario where user=? and password=?");
		$stmt->execute(array($username, $password));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}


	//engade un permiso $permission ao perfil $user
	private function addPermission(User $user, Permission $permission)
	{
		$stmt = $this->db->prepare("INSERT INTO usuario_tiene_permiso(cod_usuario, id_permiso) values (?,?)"); 
		$stmt->execute(array($user->getCoduser(), $permission->getCodpermission()));

		return $this->db->lastInsertId();
	}

	//quita un permiso $permission ao perfil $user
	private function removePermission(User $user, Permission $permission)
	{
		$stmt = $this->db->prepare("DELETE FROM usuario_tiene_permiso WHERE cod_usuario = ? AND id_permiso = ?"); 
		$stmt->execute(array($user->getCoduser(), $permission->getCodpermission()));

		return $this->db->lastInsertId();
	}
}
