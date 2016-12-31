<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/USER.php");
require_once(__DIR__ . "/../model/PERMISSION.php");
require_once(__DIR__ . "/../model/PERMISSION_model.php");
require_once(__DIR__ . "/../model/PROFILE.php");
require_once(__DIR__ . "/../model/PROFILE_model.php");
require_once(__DIR__ . "/../model/USERPERMISSION_model.php");
require_once(__DIR__ . "/../model/USERPERMISSION.php");


class UserMapper
{

    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;
    private $permMapper;
    private $profileMapper;
    private $upm;
    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
        $this->permMapper = new PermissionMapper();
        $this->profileMapper = new ProfileMapper();
        $this->upm = new UserPermissionMapper();
    }

    //return: o id do usuario co nome $username
    public function getIdByName($username)
    {
        $stmt = $this->db->prepare("SELECT cod_usuario FROM usuario WHERE  user= ?");
        $stmt->execute(array($username));

        return $stmt->fetch(PDO::FETCH_ASSOC)['cod_usuario'];
    }

    //añade un usuario á táboa usuario, e os seus permisos en usuario_tiene_permisos
    public function add(User $user)
    {
        //insertamos na taboa usuario
        $stmt = $this->db->prepare("INSERT INTO usuario(password, user, id_perfil) values (?,?,?)");
        $stmt->execute(array(
                $user->getPasswd(),
                $user->getUsername(),
                $user->getProfile()->getCodprofile()
            )
        );


        //insertamos os permisos propios do ususario 
        $perms = $user->getPermissions()->getUserPermissions();

        $coduser = $this->getIdByName($user->getUsername());



        foreach ($perms as $userperm) {
            $codperm = $userperm->getCodpermission();
            //insertamos os permisos do user
            $stm = $this->db->prepare("INSERT INTO usuario_tiene_permiso(cod_usuario,id_permiso) values (?,?)");
            $stm->execute(array(
                    $coduser, $codperm    
                )
            );

        }

        return $this->db->lastInsertId();
    }

    //Funcion de listar: devolve un array de todos obxetos User correspondentes á tabla User
    public function show()
    {
        //obtemos os datos da taboa usuario
        $stmt = $this->db->query("SELECT * FROM usuario");
        $user_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = array();

        //por cada usuario, obtemos os seus permisos e creamos un obxeto no que se insertan
        foreach ($user_db as $user) {

            //engadimos o usuario cos seus permisos a $users
            array_push($users,
                new User(
                    $user['user'],
                    $user['cod_usuario'],
                    $user['password'],
                    $this->profileMapper->view($user['id_perfil']),
                    $this->upm->view($user['cod_usuario'])
                )
            );
        }

        //devolve o array
        return $users;
    }


    //devolve o obxecto User no que o $id_user coincida co da tupla.
    public function view($id_user)
    {
        $stmt = $this->db->prepare("SELECT cod_usuario, password, user, id_perfil FROM usuario WHERE cod_usuario=?");
        $stmt->execute(array($id_user));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user != null) {
            return new User(
                $user['user'],
                $user['cod_usuario'],
                $user['password'],
                $this->profileMapper->view($user['id_perfil']),
                $this->upm->view($user['cod_usuario'])
            );
		} else {
            return new User();
        }
    }

    //edita a tupla correspondente co id do obxecto User $user
    public function edit(User $user)
    {
        $stmt = $this->db->prepare("UPDATE usuario set user = ?, password = ?, id_perfil = ? where cod_usuario=?");
        $stmt->execute(array($user->getUsername(), $user->getPasswd(), $user->getProfile()->getCodprofile(), $user->getCoduser()));
        $this->upm->edit($user->getPermissions());
        
    }

    //borra sobre a taboa usuario a tupla con id igual a o do obxeto pasado	
    public function delete($cod_User)
    {
        $stmt = $this->db->prepare("DELETE from usuario WHERE cod_usuario= '$cod_User'");
        $stmt->execute();
    }

    /**
     * Checks if a given username is already in the database
     *
     * @param string $username the username to check
     * @return boolean true if the username exists, false otherwise
     */
    public function usernameExists($username)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM usuario where user=?");
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
    public function isValidUser($username, $password)
    {
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

    public function search(User $user){


        if ($user->getprofile()->getCodprofile() == "") {
            $stmt = $this->db->prepare("SELECT * FROM usuario WHERE cod_usuario like ? AND user like ?");
            $stmt->execute(array("%".$user->getCoduser()."%", "%".$user->getUsername()."%"));
        }else{
            $stmt = $this->db->prepare("SELECT * FROM usuario WHERE cod_usuario like ? AND user like ? AND id_perfil like ?");
            $stmt->execute(array("%".$user->getCoduser()."%", "%".$user->getUsername()."%", "%".$user->getProfile()->getCodprofile()."%"));
        }

        
        $users_db = $stmt->fetchAll(PDO::FETCH_ASSOC);


        
        $users = array();
        foreach ($users_db as $u){
            array_push($users, new User(
                $u['user'],
                $u["cod_usuario"],
                NULL,
                $this->profileMapper->view($u["id_perfil"]),
                $this->upm->view($u["cod_usuario"]))
            );
        }

        return $users;
    }
}
