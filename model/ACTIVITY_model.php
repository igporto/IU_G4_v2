<?php

require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/ACTIVITY.php");
require_once(__DIR__ . "/../model/CATEGORY.php");
require_once(__DIR__ . "/../model/CATEGORY_model.php");
require_once(__DIR__ . "/../model/SPACE.php");
require_once(__DIR__ . "/../model/SPACE_model.php");
require_once(__DIR__ . "/../model/EMPLOYEE.php");
require_once(__DIR__ . "/../model/EMPLOYEE_model.php");
require_once(__DIR__ . "/../model/DISCOUNT.php");
require_once(__DIR__ . "/../model/DISCOUNT_model.php");


class ActivityMapper
{

    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;
    private $categoryMapper;
    private $spaceMapper;
    private $employeeMapper;
    private $discountMapper;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
        $this->categoryMapper = new CategoryMapper();
        $this->spaceMapper = new SpaceMapper();
        $this->employeeMapper = new EmployeeMapper();
        $this->discountMapper = new DiscountMapper();
    }

    public function activitynameExists($activityname)
    {
        $stmt = $this->db->prepare("SELECT count(*) FROM actividad WHERE nombre = ?");
        $stmt->execute(array($activityname));

        if ($stmt->fetchColumn() > 0) {
            return true;
        }
    }

    //añade unha actividade á táboa activiade
    public function add(Activity $activity)
    {
        //insertamos na taboa activity

        $stmt = $this->db->prepare("INSERT INTO  actividad (nombre, aforo, id_categoria, id_espacio, descuento, empleado_imparte, precio,  color ) VALUES (?,?,?,?,?,?,?, ?)");
        $stmt->execute(array(
                $activity->getActivityname(),
                $activity->getCapacity(),
                $activity->getCategory()->getCodcategory(),
                $activity->getSpace()->getCodspace(),
                $activity->getDiscount()->getCoddiscount(),
                $activity->getEmployee()->getCodemployee(),
                $activity->getPrice(),
                $activity->getColor()
            )
        );

        return $this->db->lastInsertId();
    }

    //Funcion de listar: devolve un array de todos obxetos Activity correspondentes á taboa actividad
    public function show()
    {
        //obtemos os datos da taboa usuario
        $stmt = $this->db->query("SELECT * FROM actividad");
        $activities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $activities = array();

        //por cada actividade, obtemos os datos e creamos un obxeto no que se insertan
        foreach ($activities_db as $acti) {
            //engadimos o usuario cos seus permisos a $users
            array_push($activities, $this->view($acti["id_actividad"]));
        }
        //devolve o array
        return $activities;
    }


    //devolve o obxecto Activity no que o $codactivity coincida co da tupla.
    public function view($codactivity)
    {
        $stmt = $this->db->prepare("SELECT * FROM actividad WHERE id_actividad = ?");
        $stmt->execute(array($codactivity));
        $acti = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($acti != null) {
            return new Activity(
                $acti['id_actividad'],
                $acti['nombre'],
                $acti['aforo'],
                $this->categoryMapper->view($acti["id_categoria"]),
                $this->spaceMapper->view($acti["id_espacio"]),
                $this->discountMapper->view($acti["descuento"]),
                $this->employeeMapper->view($acti["empleado_imparte"]),
                $acti["precio"],
                $acti['color']
            );
        } else {
            return new Activity();
        }
    }

    //edita a tupla correspondente co id do obxecto Activity $activity
    public function edit(Activity $activity)
    {
        $stmt = $this->db->prepare("UPDATE actividad SET  nombre = ? , aforo = ? , id_categoria = ? , id_espacio = ? , descuento = ? , empleado_imparte = ?, precio = ?, color = ? WHERE id_actividad = ?");
        $stmt->execute(array(
                        $activity->getActivityname(), $activity->getCapacity(), $activity->getCategory()->getCodcategory(), $activity->getSpace()->getCodspace(),
                        $activity->getDiscount()->getCoddiscount(), $activity->getEmployee()->getCodemployee(), $activity->getPrice(),$activity->getColor(),  $activity->getCodactivity()
                        )
                );
    }

    //borra sobre a taboa actividade a tupla con id igual a o do obxeto pasado
    public function delete($codactivity)
    {
        $stmt = $this->db->prepare("DELETE from actividad WHERE id_actividad = '$codactivity'");
        $stmt->execute();
    }

    public function search(Activity $activity){
        $stmt = $this->db->prepare("SELECT * FROM actividad WHERE id_actividad like ? AND nombre like ? AND aforo like ? AND id_categoria like ? AND id_espacio like ? AND descuento like ? AND empleado_imparte like ?");
        $stmt->execute(array(
                "%".$activity->getCodactivity()."%", "%".$activity->getActivityname()."%", "%".$activity->getCapacity()."%", "%".$activity->getCategory()->getCodcategory()."%",
                "%".$activity->getSpace()->getCodspace()."%" , "%".$activity->getDiscount()->getCoddiscount()."%", "%".$activity->getEmployee()->getCodemployee()."%"
                        )
                );
        $activities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $activities = array();
        foreach ($activities_db as $a){
            array_push($activities, $this->view($a["id_actividad"]));
        }
        return $activities;
    }
}
