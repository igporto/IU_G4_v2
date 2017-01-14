<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/USER_model.php");


class NotificationMapper {

    /**
     * Reference to the PDO connection
     * @var PDO
     */
    private $db;
    private $userMapper;

    public function __construct() {
        $this->db = PDOConnection::getInstance();
        $this->userMapper = new UserMapper();
    }



    //Inserta na base de datos unha tupla cos datos do obxeto $notification
    public function add(Notification $notification) {
        $stmt = $this->db->prepare("INSERT INTO notificacion( descripcion, cod_usuario) VALUES (?, ?)");
        $stmt->execute(array($notification->getDescription(), $notification->getUser()->getCoduser()));

        return $this->db->lastInsertId();
    }


    //Funcion de listar: devolve un array de todos obxetos Notification() correspondentes á tabla Accion
    public function show() {

        $stmt = $this->db->query("SELECT * FROM notificacion");
        $notification_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $notifications = array();

        foreach ($notification_db as $notification) {
            array_push($notifications, $this->view($notification['id_notificacion']));
        }

        return $notifications;
    }


    //devolve o obxecto Notification() no que o $notification_campo_id coincida co da tupla.
    public function view($codnotification){
        $stmt = $this->db->prepare("SELECT * FROM notificacion WHERE id_notificacion=?");
        $stmt->execute(array($codnotification));
        $notification = $stmt->fetch(PDO::FETCH_ASSOC);

        if($notification != null) {
            return new Notification(
                $notification["id_notificacion"],
                $notification["descripcion"],
                $this->userMapper->view($notification['cod_usuario'])
            );
        } else {
            return new Notification();
        }
    }

    //edita a tupla correspondente co id do obxecto Notification() $notification
    public function edit(Notification $notification) {
        $stmt = $this->db->prepare("UPDATE notificacion SET descripcion = ?,cod_usuario = ? WHERE id_notificacion = ?");
        $stmt->execute(array($notification->getDescription(),$notification->getUser()->getCoduser(), $notification->getCodnotification()));
    }


    //borra sobre a taboa accion a tupla con id igual a o do obxeto pasado
    public function delete($codnotification) {
        $stmt = $this->db->prepare("DELETE from notificacion WHERE id_notificacion=?");
        $stmt->execute(array($codnotification));
    }

    public function search(Notification $notification){
        $stmt = $this->db->prepare("SELECT * FROM notificacion WHERE descripcion LIKE ? AND cod_usuario LIKE ?");
        $stmt->execute(array("%".$notification->getDescription()."%","%".$notification->getUser()->getCoduser()."%"));
        $notifications_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $notifications = array();
        foreach ($notifications_db as $a){
            array_push($notifications, $this->view($a['id_notificacion']));
        }
        return $notifications;
    }

}
