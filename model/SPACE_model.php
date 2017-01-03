<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/SPACE.php");


class SpaceMapper
{

    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }

    //Funcion de listar: devolve un array de todos obxetos Space correspondentes á tabla Espacio
    public function show()
    {
        $stmt = $this->db->query("SELECT * FROM espacio");
        $spaces_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $spaces = array();

        foreach ($spaces_db as $sp) {
            //se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
            //introduce no array o obxeto Controller creado a partir da query
            array_push($spaces, $this->view($sp["id_espacio"]));
        }

        //devolve o array
        return $spaces;
    }

    public function getIdByName($spacename)
    {
        $stmt = $this->db->prepare("SELECT id_espacio FROM espacio WHERE  id_espacio= ?");
        $stmt->execute(array($spacename));

        return $stmt->fetch(PDO::FETCH_ASSOC)['id_espacio'];
    }

    //devolve o obxecto Space no que o $id_espacio coincida co da tupla.
    public function view($id_space)
    {
        $stmt = $this->db->prepare("SELECT id_espacio, nombre, descripcion,aforo FROM espacio WHERE id_espacio=?");
        $stmt->execute(array($id_space));
        $sp = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($sp != null) {
            return new Space(
                $sp['id_espacio'],
                $sp['nombre'],
                $sp['aforo'],
                $sp['descripcion']
            );
        } else {
            return new Space();
        }
    }

    //Comproba se existe un espazo con ese id
    public function spaceNameExists($spacename)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM espacio where nombre=?");
        $stmt->execute(array($spacename));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    //engade un espazo á táboa usuario
    public function add(Space $space)
    {
        //insertamos na taboa espazos
        $stmt = $this->db->prepare("INSERT INTO espacio(id_espacio,nombre, aforo, descripcion) values (?,?,?,?)");
        $stmt->execute(array(
                $space->getCodspace(),
                $space->getSpacename(),
                $space->getCapacity(),
                $space->getDescription()
            )
        );
        return $this->db->lastInsertId();
    }

    //edita a tupla correspondente co id do obxecto Space
    public function edit(Space $space)
    {
        $stmt = $this->db->prepare("UPDATE espacio SET nombre = ?, aforo = ?, descripcion = ? where id_espacio=?");
        $stmt->execute(array($space->getSpacename(), $space->getCapacity(), $space->getDescription(), $space->getCodspace()));
    }


    //borra sobre a taboa espacio a tupla con id igual a o do obxeto pasado
    public function delete($codspace)
    {
        $stmt = $this->db->prepare("DELETE from espacio WHERE id_espacio = '$codspace'");
        $stmt->execute();
    }

    public function search(Space $space){
        $stmt = $this->db->prepare("SELECT * FROM espacio WHERE id_espacio like ? AND nombre like ? AND `descripcion` like ? AND aforo like ?");
        $stmt->execute(array("%".$space->getCodspace()."%", "%".$space->getSpacename()."%", "%".$space->getDescription()."%", "%".$space->getCapacity()."%"));
        $sp_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $spaces = array();
        foreach ($sp_db as $space){
            array_push($spaces, $this->view($space['id_espacio']));
        }
        return $spaces;
    }
}
