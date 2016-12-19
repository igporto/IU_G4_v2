<?php

require_once(__DIR__."/../core/PDOConnection.php");


class ActionMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	

	//devolve true se xa existe unha acción co nome $actionname
	public function actionnameExists($actionname) {
		$stmt = $this->db->prepare("SELECT count(action) FROM accion where nombre=?");
		$stmt->execute(array($actionname));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
	


	//Inserta na base de datos unha tupla cos datos do obxeto $action
	public function add(Action $action) {
		$stmt = $this->db->prepare("INSERT INTO accion(id_accion, nombre) values (?,?)"); 
		$stmt->execute(array($action->getCodaction(), $action->getActionname()));

		return $this->db->lastInsertId();
	}


	//Funcion de listar: devolve un array de todos obxetos Action correspondentes á tabla Accion
	public function show() {

		$stmt = $this->db->query("SELECT * FROM accion");
		$action_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$actions = array();

		foreach ($action_db as $action) {
			array_push($actions, new Action($action["id_accion"], $action["nombre"]));
		}

		return $actions;
	}

	

	//devolve o obxecto Action no que o $action_campo_id coincida co da tupla.
	public function view($id_accion){
		$stmt = $this->db->prepare("SELECT * FROM accion WHERE id_accion=?");
		$stmt->execute(array($id_accion));
		$action = $stmt->fetch(PDO::FETCH_ASSOC);

		if($action != null) {
			return new Action(
			$action["id_accion"],
			$action["nombre"]
			);
		} else {
			return new Action();
		}
	}

	
		

	//edita a tupla correspondente co id do obxecto Action $action
	public function edit(Action $action) {
		$stmt = $this->db->prepare("UPDATE accion set nombre=? where id_accion=?");
		$stmt->execute(array($action->getActionname(),$action->getCodaction()));
	}

		
	//borra sobre a taboa accion a tupla con id igual a o do obxeto pasado	
	public function delete(Action $action) {
		$stmt = $this->db->prepare("DELETE from accion WHERE id_accion=?");
		$stmt->execute(array($action->getCodaction()));
	}

}
