<?php

require_once(__DIR__."/../core/PDOConnection.php");


class CategoryMapper {

    private $db;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
    }

    //devolve true se xa existe unha categoria co nome $categoryname
    public function categorynameExists($categoryname) {
        $stmt = $this->db->prepare("SELECT count(*) FROM categoria where nombre=?");
        $stmt->execute(array($categoryname));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    //Inserta na base de datos unha tupla cos datos do obxeto $category
    public function add(Category $category) {
        $stmt = $this->db->prepare("INSERT INTO categoria(nombre) values (?)");
        $stmt->execute(array($category->getCategoryname()));

        return $this->db->lastInsertId();
    }


    //Funcion de listar: devolve un array de todos obxetos Category correspondentes á tabla Categoria
    public function show() {

        $stmt = $this->db->query("SELECT * FROM categoria");
        $category_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categories = array();

        foreach ($category_db as $category) {
            array_push($categories, $this->view($category["id_categoria"]));
        }

        return $categories;
    }



    //devolve o obxecto Action no que o $action_campo_id coincida co da tupla.
    public function view($id_categoria){
        $stmt = $this->db->prepare("SELECT * FROM categoria WHERE id_categoria=?");
        $stmt->execute(array($id_categoria));
        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

        if($categoria != null) {
            return new Category(
                $categoria["id_categoria"],
                $categoria["nombre"]
            );
        } else {
            return new Category();
        }
    }

    //edita a tupla correspondente co id do obxecto Category $category
    public function edit(Category $category) {
        $stmt = $this->db->prepare("UPDATE categoria SET nombre=? where id_categoria=?");
        $stmt->execute(array($category->getCategoryname(),$category->getCodcategory()));
    }


    //borra sobre a taboa categoria a tupla con id igual a o codigo que se lle pasa
    public function delete($codcategory) {
        $stmt = $this->db->prepare("DELETE from categoria WHERE id_categoria=?");
        $stmt->execute(array($codcategory));
    }

    public function search(Category $category){
        $stmt = $this->db->prepare("SELECT * FROM categoria WHERE id_categoria like ? AND nombre like ?");
        $stmt->execute(array("%".$category->getCodcategory()."%","%".$category->getCategoryname()."%"));
        $categories_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = array();
        foreach ($categories_db as $c){
            array_push($categories, $this->view($c['id_categoria']));
        }
        return $categories;
    }

}
