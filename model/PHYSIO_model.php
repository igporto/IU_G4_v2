<?php
require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/../model/PHYSIO.php");
require_once(__DIR__ . "/../model/RESERVE.php");
require_once(__DIR__ . "/../model/RESERVE_model.php");

class PhysioMapper
{
    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;
    private $reserveMapper;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
        $this->reserveMapper = new ReserveMapper();
    }
    //añade unha consulta_fisio á táboa consulta_fisio
    public function add(Physio $physio)
    {
        //insertamos na taboa physio
        $stmt = $this->db->prepare("INSERT INTO  consulta_fisio (id_reserva, dia, hora_inicio, hora_fin) VALUES (?,?,?,?)");
        $stmt->execute(array(
                $physio->getReserve()->getCodReserve(),
                $physio->getDate(),
                $physio->getStartTime(),
                $physio->getEndTime()
            )
        );
        return $this->db->lastInsertId();
    }
    //Funcion de listar: devolve un array de todos obxetos physio correspondentes á taboa consulta_fisio
    public function show()
    {
        //obtemos os datos da taboa usuario
        $stmt = $this->db->query("SELECT * FROM consulta_fisio");
        $physios_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $physios = array();
        //por cada consulta_fisioe, obtemos os datos e creamos un obxeto no que se insertan
        foreach ($physios_db as $phys) {
            //engadimos o usuario cos seus permisos a $users
            array_push($physios, $this->view($phys["id_consulta"]));
        }
        //devolve o array
        return $physios;
    }
    //devolve o obxecto physio no que o $codPhysio coincida co da tupla.
    public function view($codPhysio)
    {
        $stmt = $this->db->prepare("SELECT * FROM consulta_fisio WHERE id_consulta = ?");
        $stmt->execute(array($codPhysio));
        $phys = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($phys != null) {
            return new physio(
                $phys['id_consulta'],
                $this->reserveMapper->view($phys["id_reserva"]),
                $phys["dia"],
                $phys["hora_inicio"],
                $phys["hora_fin"]
            );
        } else {
            return new Physio();
        }
    }
    //edita a tupla correspondente co id do obxecto physio $physio
    public function edit(Physio $physio)
    {
        $stmt = $this->db->prepare("UPDATE consulta_fisio SET id_reserva = ? , dia = ? , hora_inicio = ? , hora_fin = ? WHERE id_consulta = ?");
        $stmt->execute(array(
                        $physio->getReserve()->getCodReserve(), $physio->getDate(), $physio->getStartTime(), $physio->getEndTime(), $physio->getCodPhysio()
                        )
                );
    }
    //borra sobre a taboa consulta_fisioe a tupla con id igual a o do obxeto pasado
    public function delete($codPhysio)
    {
        $stmt = $this->db->prepare("DELETE from consulta_fisio WHERE id_consulta = '$codPhysio'");
        $stmt->execute();
    }
    public function search(Physio $physio){
        $physio->getCodPhysio();exit;
        $stmt = $this->db->prepare("SELECT * FROM consulta_fisio WHERE id_consulta like ? AND id_reserva like ? AND dia like ? AND hora_inicio like ? AND hora_fin LIKE ? ");
        $stmt->execute(array(
                "%".$physio->getCodPhysio()."%", "%".$physio->getReserve()->getCodReserve()."%", "%".$physio->getDate()."%", "%".$physio->getStartTime()."%", "%".$physio->getEndTime()."%")
                );
        $physios_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $physios = array();
        foreach ($physios_db as $a){
            array_push($physios, $this->view($a["id_consulta"]));
        }
        return $physios;
    }
    public function getCodPhysio($codPhysio)
    {
        $stmt = $this->db->prepare("SELECT id_consulta FROM consulta_fisio WHERE  id_consulta= ?");
        $stmt->execute(array($codPhysio));

        return $stmt->fetch(PDO::FETCH_ASSOC)['id_consulta'];
    }
        public function getCodReserve($codReserve)
    {
        $stmt = $this->db->prepare("SELECT * FROM reserva WHERE  id_reserva= ?");
        $stmt->execute();

        $r = $stmt->fetch();
        $id_sp = $r['id_reserva'];

        return $id_sp;

    }
    public function selectReserveId(){
        $stmt = $this->db->prepare("SELECT * FROM reserva");
        $stmt->execute();

        $id = array();
        $resul = $stmt->fetchAll();
        foreach($resul as $r){
            array_push($id,$r['id_reserva']);
        }

        return $id;
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