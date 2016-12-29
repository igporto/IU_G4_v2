<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/CLIENT.php");

class ClientMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    public function dniExists($dni) {
        $stmt = $this->db->prepare("SELECT count(*) FROM cliente_externo where dni_cliente_externo=?");
        $stmt->execute(array($dni));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }


    public function add(Client $client) {
        $stmt = $this->db->prepare("INSERT INTO cliente_externo(dni_cliente_externo, nombre, apellido, telefono, email) values (?,?,?,?,?)");
        $stmt->execute(array($client->getDni(), $client->getName(),$client->getSurname(), $client->getPhone(), $client->getEmail()));

        return $this->db->lastInsertId();
    }


    public function show() {

        $stmt = $this->db->query("SELECT * FROM cliente_externo");
        $client_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $clients = array();

        foreach ($client_db as $client) {
            array_push($clients, new Client($client["dni_cliente_externo"], $client["nombre"], $client["apellido"], $client["telefono"], $client["email"]));
        }

        return $clients;
    }


    public function view($dni_cliente_externo){
        $stmt = $this->db->prepare("SELECT * FROM cliente_externo WHERE dni_cliente_externo=?");
        $stmt->execute(array($dni_cliente_externo));
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        if($client != null) {
            return new Client(
                $client["dni_cliente_externo"],
                $client["nombre"],
                $client["apellido"],
                $client["telefono"],
                $client["email"]
            );
        } else {
            return new Client();
        }
    }

    public function edit(Client $client) {
        $stmt = $this->db->prepare("UPDATE cliente_externo SET nombre=?, apellido=?, telefono=?, email=? WHERE dni_cliente_externo=?");
        $stmt->execute(array($client->getName(),$client->getSurname(),$client->getPhone(),$client->getEmail(),$client->getDni()));
    }


    public function delete($clientdni) {
        $stmt = $this->db->prepare("DELETE from cliente_externo WHERE dni_cliente_externo=?");
        $stmt->execute(array($clientdni));
    }

    public function search(Client $client){
        $stmt = $this->db->prepare("SELECT * FROM cliente_externo WHERE dni_cliente_externo like ? AND nombre like ?");
        $stmt->execute(array("%".$client->getDni()."%","%".$client->getName()."%"));
        $clients_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clients = array();
        foreach ($clients_db as $c){
            array_push($clients, new Client(
                    $c['dni_cliente_externo'],
                    $c["nombre"]
                )
            );
        }
        return $clients;
    }

}
