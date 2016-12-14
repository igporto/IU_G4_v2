<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Permission.php");
require_once(__DIR__."/../model/PermissionMapper.php");
require_once(__DIR__."/../model/Profile.php");
require_once(__DIR__."/../model/ProfileMapper.php");


class UserMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;
	private $permMapper;
	private $profileMapper;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
		$this->permMapper = new PermissionMapper();
		$this->profileMapper = new ProfileMapper();
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
		$stmt = $this->db->prepare("INSERT INTO usuario(passsword, user, id_perfil) values (?,?,?)"); 
		$stmt->execute(array(
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

		//obtemos os datos da taboa usuario
		$stmt = $this->db->query("SELECT * FROM usuario");
		$user_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$users = array();

		//por cada usuario, obtemos os seus permisos e creamos un obxeto no que se insertan
		foreach ($user_db as $user) {
			//obtemos os id's de todos os permisos dun usuario
			$stmt = $this->db->prepare("SELECT id_permiso FROM usuario_tiene_permiso WHERE cod_usuario = ?"); 
			$stmt->execute(array($user->getCoduser()));
			$perm_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

			//insertamos os permisos propios do ususario 
			$permisos = array();
			foreach ($perm_db as $perm) {
				//pusheamos un obxeto permiso en $permisos
				array_push($permisos, $this->permMapper->view($perm['id_permiso']));
			}

			//engadimos o usuario cos seus permisos a $users
			array_push($users,
					new User(
						$user['user'],
						$user['cod_usuario'], 
						$user['password'], 
						$this->profileMapper->view($user['id_perfil']),
						$permisos
						)
				);
			
		}

		//devolve o array
		return $users;
	}

	

	//devolve o obxecto User no que o $id_user coincida co da tupla.
	public function view($id_user){
		$stmt = $this->db->prepare("SELECT u.cod_usuario, u.password, u.user, utp.id_perfil, utp.id_permiso 
			FROM usuario u, usuario_tiene_permiso utp  
			WHERE u.cod_ususario = utp.cod_usuario AND u.cod_usuario=?");
		$stmt->execute(array($id_user));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user != null) {

			//insertamos os permisos propios do ususario 
			$permisos = array();
			foreach ($user as $us) {
				//pusheamos un obxeto permiso en $permisos
				array_push($permisos, $this->permMapper->view($us['id_permiso']));
			}
			return new User(
						$user['user'],
						$user['cod_usuario'], 
						$user['password'], 
						$this->profileMapper->view($user['id_perfil']),
						$permisos
						)
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
		$stmt = $this->db->prepare("DELETE from usuario WHERE cod_usuario=?");
		$stmt->execute(array($user->getCoduser()));
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
