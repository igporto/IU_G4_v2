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
            array_push($reserv, $this->view($ev["id_reserva"]));
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

        if ($reserv != NULL) {
            $reserve = new Reserve(
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
            $reserve = new Reserve();
        }

        return $reserve;
    }
    //edita a tupla correspondente co id do obxecto Reserve $reserve
    public function edit(Reserve $reserve)
    {
        $stmt = $this->db->prepare("UPDATE reserva SET  id_espacio = ? , id_servicio = ? , id_alumno = ? , 
            fecha_reserva = ? , hora_inicio = ? , hora_fin = ? , precio_espacio = ? , precio_fisio = ? WHERE id_reserva = ?");
        $stmt->execute(array(
                        $reserve->getSpace()->getCodspace(), $reserve->getService()->getId(), 
                        $reserve->getAlumn()->getCodalumn(), $reserve->getDate(), $reserve->getStartTime(), $reserve->getEndTime(), 
                        $reserve->getSpacePrice(), $reserve->getPhysioPrice(), $reserve->getCodReserve()
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
        if($reserve->getSpace() != NULL){
            if($reserve->getService() != NULL){
                $stmt = $this->db->prepare("SELECT * FROM reserva WHERE id_espacio like ? AND id_servicio like ? AND id_alumno like ? AND precio_espacio like ? AND precio_fisio like ?");
                $stmt->execute(array("%".$reserve->getSpace()->getCodspace()."%", "%".$reserve->getService()->getId()."%", "%".$reserve->getAlumn()->getCodalumn()."%",
                        "%".$reserve->getSpacePrice()."%","%".$reserve->getPhysioPrice()."%",)
                );
            }else{
                $stmt = $this->db->prepare("SELECT * FROM reserva WHERE id_espacio like ? AND id_alumno like ? AND precio_espacio like ? AND precio_fisio like ?");
                $stmt->execute(array("%".$reserve->getSpace()->getCodspace()."%",  "%".$reserve->getAlumn()->getCodalumn()."%",
                        "%".$reserve->getSpacePrice()."%","%".$reserve->getPhysioPrice()."%",)
                );
            }
        }else{
            if($reserve->getService() != NULL){
                $stmt = $this->db->prepare("SELECT * FROM reserva WHERE id_servicio like ? AND id_alumno like ? AND precio_espacio like ? AND precio_fisio like ?");
                $stmt->execute(array( "%".$reserve->getService()->getId()."%", "%".$reserve->getAlumn()->getCodalumn()."%",
                        "%".$reserve->getSpacePrice()."%","%".$reserve->getPhysioPrice()."%",)
                );
            }else{
                $stmt = $this->db->prepare("SELECT * FROM reserva WHERE id_alumno like ? AND precio_espacio like ? AND precio_fisio like ?");
                $stmt->execute(array("%".$reserve->getAlumn()->getCodalumn()."%",
                        "%".$reserve->getSpacePrice()."%","%".$reserve->getPhysioPrice()."%",)
                );
            }
        }


        $reserves_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $reserves = array();


        foreach ($reserves_db as $a) {
            array_push($reserves, $this->view($a['id_reserva']));
        }
      return $reserves;
    }

    public function validDate($date)
    {

        $stmt = $this->db->query("SELECT CURDATE()");
        $db = $stmt->fetchAll(PDO::FETCH_ASSOC);


        if ($db != NULL) {
            $actual = $db[0];
            if ($date > $actual['CURDATE()']) {
                return true;
            } else {
                return false;
            }
        }
    }
}
?>