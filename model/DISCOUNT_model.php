<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/DISCOUNT.php");


class DiscountMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    //funcion que comproba se hai un desconto con esa porcentaxe de desconto
    public function discountExists($type){
        $stmt = $this->db->prepare("SELECT * FROM descuento WHERE tipo = ?");
        $stmt->execute(array($type));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }
    //Inserta na base de datos unha tupla cos datos do obxeto $discount
    public function add(Discount $discount) {

        $stmt = $this->db->prepare("INSERT INTO descuento (tipo, porcentaje, descripcion) VALUES (? , ?, ?) ");
        $stmt->execute(array($discount->getType(), $discount->getPercent(), $discount->getDescription()));

        return $this->db->lastInsertId();
    }


    //Funcion de listar: devolve un array de todos obxetos Discount correspondentes á tabla descuento
    public function show() {

        $stmt = $this->db->query("SELECT * FROM descuento");
        $discount_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $discounts = array();

        foreach ($discount_db as $discount) {
            array_push($discounts, $this->view($discount["id_descuento"]));
        }

        return $discounts;
    }



    //devolve o obxecto Discount no que o $action_campo_id coincida co da tupla.
    public function view($coddiscount){
        $stmt = $this->db->prepare("SELECT * FROM descuento WHERE id_descuento = ?");
        $stmt->execute(array($coddiscount));
        $discount = $stmt->fetch(PDO::FETCH_ASSOC);

        if($discount != null) {
            return new Discount(
                $discount["id_descuento"],
                $discount["tipo"],
                $discount["porcentaje"],
                $discount["descripcion"]
            );
        } else {
            return new Discount();
        }
    }

    //edita a tupla correspondente co id do obxecto Discount $discount
    public function edit(Discount $discount) {
        $stmt = $this->db->prepare("UPDATE descuento SET tipo = ?, porcentaje = ?, descripcion = ? WHERE id_descuento = ?");
        $stmt->execute(array($discount->getType(), $discount->getPercent(), $discount->getDescription(), $discount->getCoddiscount()));
    }


    //borra sobre a taboa descuento a tupla con id igual a o codigo que se lle pasa
    public function delete($coddiscount) {
        $stmt = $this->db->prepare("DELETE from descuento WHERE id_descuento = ?");
        $stmt->execute(array($coddiscount));
    }

    public function search(Discount $discount){
        if($discount->getCoddiscount()==NULL){
            $stmt = $this->db->prepare("SELECT * FROM descuento WHERE tipo like ? AND porcentaje like ? AND descripcion like ? ");
            $stmt->execute(array("%".$discount->getType()."%", "%".$discount->getPercent()."%", "%".$discount->getDescription()."%"));
        }else{
            $stmt = $this->db->prepare("SELECT * FROM descuento WHERE id_descuento = ? AND tipo like ? AND porcentaje like ? AND descripcion like ? ");
            $stmt->execute(array($discount->getCoddiscount(),"%".$discount->getType()."%", "%".$discount->getPercent()."%", "%".$discount->getDescription()."%"));
        }

        $discounts_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $discounts = array();
        foreach ($discounts_db as $d){
            array_push($discounts, $this->view($d['id_descuento']));
        }
        return $discounts;
    }

}
