<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/CONTROLLER.php");


class ControllerMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	//return: o id do usuario co nome $controllername
    //return: o id do usuario co nome $username
    public function getIdByName($controllername)
    {
        $stmt = $this->db->prepare("SELECT id_controlador FROM controlador WHERE  nombre= ?");
        $stmt->execute(array($controllername));
       	$result = $stmt->fetch(PDO::FETCH_ASSOC)["id_controlador"];
        return $result;
    }

	
	//devolve true se xa existe un controlador co nome $controllername
	public function controllernameExists($controllername) {
		$stmt = $this->db->prepare("SELECT count(*) FROM controlador where nombre=?");
		$stmt->execute(array($controllername));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	public function add(Controller $controller) {
		$stmt = $this->db->prepare("INSERT INTO controlador(id_controlador, nombre) values (?,?)"); 
		$stmt->execute(array($controller->getCodcontroller(), $controller->getControllername()));

		return $this->db->lastInsertId();
	}
	


	//Funcion de listar: devolve un array de todos obxetos Controller correspondentes á tabla Controller
	public function show() {

		$stmt = $this->db->query("SELECT * FROM controlador ORDER BY nombre");
		$controller_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$controllers = array();

		foreach ($controller_db as $controller) {
			//se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
			//introduce no array o obxeto Controller creado a partir da query
			array_push($controllers, new Controller($controller["id_controlador"], $controller["nombre"]));
		}

		//devolve o array
		return $controllers;
	}

	

	//devolve o obxecto Controller no que o $id_controlador coincida co da tupla.
	public function view($id_controlador){
		$stmt = $this->db->prepare("SELECT * FROM controlador WHERE id_controlador=?");
		$stmt->execute(array($id_controlador));
		$controller = $stmt->fetch(PDO::FETCH_ASSOC);


		if($controller != null) {
			return new Controller(
			$controller["id_controlador"],
			$controller["nombre"]
			);
		} else {
			return new Controller();
		}
	}

	
	//edita a tupla correspondente co id do obxecto Controller $controller
	public function edit(Controller $controller) {
		$stmt = $this->db->prepare("UPDATE controlador set nombre=? where id_controlador=?");
		$stmt->execute(array($controller->getControllername(), $controller->getCodcontroller()));
	}

		
	//borra sobre a taboa controlador a tupla con id igual a o do obxeto pasado	
	public function delete($cod_controller) {
		$stmt = $this->db->prepare("DELETE from controlador WHERE id_controlador=?");
		$stmt->execute(array($cod_controller));
	}

	public function search(Controller $controller){
		$stmt = $this->db->prepare("SELECT * FROM controlador WHERE id_controlador like ? AND nombre like ?");
		$stmt->execute(array("%".$controller->getCodcontroller()."%","%".$controller->getControllername()."%"));
		$controllers_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$controllers = array();
		foreach ($controllers_db as $c){
			array_push($controllers, new Controller(
					$c['id_controlador'],
					$c["nombre"])
			);
		}
		return $controllers;
	}

}
