<?php
//Modelo de Mapper dun Obxeto
//Encárgase de realizar todas as accións posibles sobre a db do obxeto
//Include da conexion
require_once(__DIR__ ."/../core/PDOConnection.php");
//Include do obxeto que mapeas
require_once(__DIR__ ."/../model/RESERVE.php");
//inclues de outros obxetos que se precisen
require_once(__DIR__ ."/../model/SPACE.php");
require_once(__DIR__ ."/../model/SPACE_model.php"); //FALTABA UN PUNTO Y COMA Y LA PRIMERA /
require_once(__DIR__ ."/../model/SERVICE.php");
require_once(__DIR__ ."/../model/SERVICE_model.php"); //FALTABA UN PUTO Y COMA Y LA PRIMERA /
require_once(__DIR__ ."/../model/ALUMN.php");
require_once(__DIR__ ."/../model/ALUMN_model.php"); 

//Por exemplo: 
class ReserveMapper {
    //Obtemos a instancia da conexión
    private $db;
    public function __construct() {
        $this->db = PDOConnection::getInstance();
        $this->spaceMapper = new SpaceMapper();
        $this->serviceMapper = new ServiceMapper();
        $this->alumnMapper = new AlumnMapper();
    }
    //añade unha reserva á táboa reserva
    public function add(Reserve $reserve)
    {
        //insertamos na taboa Reserve
        $stmt = $this->db->prepare("INSERT INTO  reserva (id_espacio, id_servicio, id_alumno, fecha_reserva, hora_inicio, hora_fin, precio_espacio, precio_fisio) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->execute(array(
                $reserve->getSpace()->getCodspace(),
                $reserve->getService()->getId(),
                $reserve->getAlumn()->getCodalumn(),
                $reserve->getDate(),
                $reserve->getStartTime(),
                $reserve->getEndTime(),
                $reserve->getSpacePrice(),
                $reserve->getPhysioPrice()
            )
        );
        return $this->db->lastInsertId();
    }
    //Funcion de listar: devolve un array de todos obxetos Reserve correspondentes á taboa reserva
    public function show()
    {
        $reserv = $this->db->query("SELECT * FROM reserva");
        $reserv_db = $reserv->fetchAll(PDO::FETCH_ASSOC);

        $reserv = array();

        foreach ($reserv_db as $ev) {
            //se o obxeto ten atributos que referencian a outros, aquí deben crearse eses obxetos e introducilos tamén
            //introduce no array o obxeto Controller creado a partir da query
            array_push($reserv, new Reserve($ev["id_reserva"],$ev['id_espacio'], $ev["id_servicio"], $ev["id_alumno"], $ev["fecha_reserva"], $ev["hora_inicio"], $ev["hora_fin"], $ev["precio_espacio"], $ev["precio_fisio"]));
        }

        //devolve o array
        return $reserv;
    }
    //devolve o obxecto Reserve no que o $codReserve coincida co da tupla.
    public function view($codReserve)
    {
        $stmt = $this->db->prepare("SELECT * FROM reserva WHERE id_reserva = ?");
        $stmt->execute(array($codReserve));
        $reserv = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($reserv != null) {
            return new Reserve(
                $reserv['id_reserva'],
                $this->spaceMapper->view($reserv["id_espacio"]),
                $this->serviceMapper->view($reserv["id_servicio"]),
                $this->alumnMapper->view($reserv["id_alumno"]),
                $reserv["fecha_reserva"],
                $reserv["hora_inicio"],
                $reserv["hora_fin"],
                $reserv["precio_espacio"],
                $reserv["precio_fisio"]
            );
        } else {
            return new Reserve();
        }
    }
    //edita a tupla correspondente co id do obxecto Reserve $reserve
    public function edit(Reserve $reserve)
    {
        $stmt = $this->db->prepare("UPDATE reserva SET  id_espacio = ? , id_servicio = ? , id_alumno = ? , 
            fecha_reserva = ? , hora_inicio = ? , hora_fin = ? , precio_espacio = ? , precio_fisio = ? WHERE id_reserva = ?");
        $stmt->execute(array(
                        $reserve->getSpace()->getCodspace(), $reserve->getService()->getId(), 
                        $reserve->getAlumn()->getCodalumn(), $reserve->getDate(), $reserve->getStartTime(), $reserve->getEndTime(), 
                        $reserve->getSpacePrice(), $reserve->getPhysioPrice()
                        )
                );
    }
    //borra sobre a taboa reservae a tupla con id igual a o do obxeto pasado
    public function delete($codReserve)
    {
        $stmt = $this->db->prepare("DELETE from reserva WHERE id_reserva = '$codReserve'");
        $stmt->execute();
    }
    public function search(Reserve $reserve){
        $reserve->getCodReserve();exit;
        $stmt = $this->db->prepare("SELECT * FROM reserva WHERE id_reserva like ? AND id_espacio like ? AND id_servicio like ? AND id_alumno like ? 
            AND fecha_reserva like ? AND hora_inicio like ? AND hora_fin like ? AND precio_espacio like ? AND precio_fisio like ?");
        $stmt->execute(array(
                "%".$reserve->getCodReserve()."%", "%".$reserve->getSpace()->getCodspace()."%", "%".$reserve->getService()->getId()."%",
                 "%".$reserve->getAlumn()->getCodalumn()."%", "%".$reserve->getDate()."%","%".$reserve->getStartTime()."%",
                 "%".$reserve->getEndTime()."%","%".$reserve->getSpacePrice()."%","%".$reserve->getPhysioPrice()."%",)
                );
        $reserves_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $reserves = array();
        foreach ($reserves_db as $a){
            array_push($reserves, $this->view($a["id_reserva"]));
        }
        return $reserves;
    }
        
    public function getCodReserve($codReserve)
    {
        $stmt = $this->db->prepare("SELECT id_reserva FROM reserva WHERE  id_reserva= ?");
        $stmt->execute(array($codReserve));

        return $stmt->fetch(PDO::FETCH_ASSOC)['id_reserva'];
    }
    public function getAlumnname($id){
        $stmt = $this->db->prepare("SELECT * FROM alumno WHERE id_alumno ='$id'");
        $stmt->execute();

        $r = $stmt->fetch();
        $id_sp = $r['nombre'];

        return $id_sp;
    }
    public function getNameSpace($id){
        $stmt = $this->db->prepare("SELECT * FROM espacio WHERE id_espacio ='$id'");
        $stmt->execute();

        $r = $stmt->fetch();
        $id_sp = $r['nombre'];

        return $id_sp;
    }
    public function getNameService($id){
        $stmt = $this->db->prepare("SELECT * FROM servicio WHERE id_servicio ='$id'");
        $stmt->execute();

        $r = $stmt->fetch();
        $id_sp = $r['id_servicio'];

        return $id_sp;
    }
    public function selectSpaceId(){
        $stmt = $this->db->prepare("SELECT * FROM espacio");
        $stmt->execute();

        $id = array();
        $resul = $stmt->fetchAll();
        foreach($resul as $r){
            array_push($id,$r['id_espacio']);
        }

        return $id;
    }
    public function selectServiceId(){
        $stmt = $this->db->prepare("SELECT * FROM servicio");
        $stmt->execute();

        $id = array();
        $resul = $stmt->fetchAll();
        foreach($resul as $r){
            array_push($id,$r['id_servicio']);
        }

        return $id;
    }
    public function selectAlumnId(){
        $stmt = $this->db->prepare("SELECT * FROM alumno");
        $stmt->execute();

        $id = array();
        $resul = $stmt->fetchAll();
        foreach($resul as $r){
            array_push($id,$r['id_alumno']);
        }

        return $id;
    }

}
?>