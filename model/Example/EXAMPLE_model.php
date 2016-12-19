<?php
//Modelo de Mapper dun Obxeto
//Encárgase de realizar todas as accións posibles sobre a db do obxeto

//Include da conexion
require_once(__DIR__."/../core/PDOConnection.php");

//Include do obxeto que mapeas
require_once(__DIR__."/../model/Example.php");


//inclues de outros obxetos que se precisen
//Por exemplo: 


class ExampleMapper {

	//Obtemos a instancia da conexión
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	//Inserta na base de datos unha tupla cos datos do obxeto $example
	public function add(Example $example) {
		//cambiar a sentencia acorde á taboa que referencia
		//IMPORTANTE: se a PK da táboa é autoincremental, non se inserta manualmente (non se pon nos 'campo' nin nos '?')
		$stmt = $this->db->prepare("INSERT INTO nome_taboa_example(campo1, campo2, campoX) values (?,?,?)"); //1 ? por campo a insertar
		//cada elemento do array será insertado no correspondente ? da query
		$stmt->execute(array($example->getCampo1(), $example->getCampo2(), $example->getCampoX()));
		//devolve o ID do último elemento insertado
		return $this->db->lastInsertId();
	}

	//Funcion de listar: devolve un array de todos obxetos Example correspondentes á tabla Example
	public function show() {

		$stmt = $this->db->query("SELECT * FROM nome_taboa_example");
		$example_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$examples = array();

		foreach ($example_db as $example) {
			//se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
			//introduce no array o obxeto Example creado a partir da query
			array_push($examples, new Example($example["campo1"], $example["campo2"], $example["campoX"]));
		}

		//devolve o array
		return $examples;
	}

	

	//devolve o obxecto Example no que o $example_campo_id coincida co da tupla.
	public function view($example_campo_id){
		$stmt = $this->db->prepare("SELECT * FROM nome_taboa_example WHERE campo_id=?");
		$stmt->execute(array($example_campo_id));
		$example = $stmt->fetch(PDO::FETCH_ASSOC);

		if($example != null) {
			return new Example(
			$example["campo1"],
			$example["campo2"],
			$example["campoX"]
			);
		} else {
			return NULL;
		}
	}

	
		

	//edita a tupla correspondente co id do obxecto Example $example
	public function edit(Example $example) {
		$stmt = $this->db->prepare("UPDATE nome_taboa_example set campo1=?, campo2=? where example_id=?");
		$stmt->execute(array($example->getCampo1(), $example->getCampo2(), $example->getId()));
	}

		
	//borra sobre a taboa nome_taboa_example a tupla con id igual a o do obxeto pasado	
	public function delete(Example $example) {
		$stmt = $this->db->prepare("DELETE from nome_taboa_example WHERE example_id=?");
		$stmt->execute(array($example->getId()));
	}

}
