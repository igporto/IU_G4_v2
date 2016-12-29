<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/SERVICE.php");

class ServiceMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }



    public function add(Service $service) {
        $stmt = $this->db->prepare("INSERT INTO servicio (fecha, coste, descripcion, dni_cliente_externo) values (?,?,?,?)");
        $stmt->execute(array($service->getFecha(), $service->getCoste(),$service->getDescripcion(), $service->getDniClienteExterno()));

        return $this->db->lastInsertId();
    }


    public function show() {

        $stmt = $this->db->query("SELECT * FROM servicio");
        $service_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $services = array();

        foreach ($service_db as $service) {
            array_push($services, new Service($service["id_servicio"], $service["fecha"], $service["coste"], $service["descripcion"], $service["dni_cliente_externo"]));
        }

        return $services;
    }


    public function view($id_servicio){
        $stmt = $this->db->prepare("SELECT * FROM servicio WHERE id_servicio=?");
        $stmt->execute(array($id_servicio));
        $service = $stmt->fetch(PDO::FETCH_ASSOC);

        if($service != null) {
            return new Service(
                $service["id_servicio"],
                $service["fecha"],
                $service["coste"],
                $service["descripcion"],
                $service["dni_cliente_externo"]
            );
        } else {
            return new Service();
        }
    }

    public function edit(Service $service) {
        $stmt = $this->db->prepare("UPDATE servicio SET fecha=?, coste=?, descripcion=?, dni_cliente_externo=? WHERE id_servicio=?");
        $stmt->execute(array($service->getFecha(),$service->getCoste(),$service->getDescripcion(),$service->getDniClienteExterno(), $service->getId()));
    }


    public function delete($id_servicio) {
        $stmt = $this->db->prepare("DELETE from servicio WHERE id_servicio=?");
        $stmt->execute(array($id_servicio));
    }

    /*public function search(Service $service){
        $stmt = $this->db->prepare("SELECT * FROM servicio WHERE id_servicio like ? AND fecha like ?");
        $stmt->execute(array("%".$service->getId()."%","%".$service->getFecha()."%"));
        $services_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $services = array();
        foreach ($services_db as $c){
            array_push($services, new Service(
                    $c['id_servicio'],
                    $c['fecha']
                )
            );
        }
        return $services;
    }*/

    public function search(Service $service){
        $services = array();

        //obtemos o código e o nome do perfil con ese nome
        if ($service->getId()!= NULL or $service->getFecha() != NULL) {
            $stmt = $this->db->prepare("SELECT * FROM servicio WHERE id_servicio like ? AND fecha like ? ");
            $stmt->execute(array("%".$service->getId()."%","%".$service->getFecha()."%"));
            $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result1 as $p) {
                array_push($services, $this->view($p['id_servicio']));
            }

        }

        return $services;
    }


}
