<?php

require_once(__DIR__ . "/../core/ViewManager.php");

require_once(__DIR__ . "/../model/NOTIFICATION.php");
require_once(__DIR__ . "/../model/NOTIFICATION_model.php");
require_once(__DIR__ . "/../model/USER.php");
require_once(__DIR__ . "/../model/USER_model.php");
require_once(__DIR__."/../mail/PHPMailerAutoload.php");
require_once(__DIR__ . "/../controller/BaseController.php");



class NotificationController extends BaseController
{

    private $userMapper;
    private $notificationMapper;

    public function __construct()
    {
        parent::__construct();


        $this->userMapper = new UserMapper();
        $this->notificationMapper = new NotificationMapper();

        // Notifications controller operates in a "welcome" layout
        // different to the "default" layout where the internal
        // menu is displayed
        $this->view->setLayout("navbar");
    }

    public function add()
    {
        if (isset($_POST["submit"])) {
            //Creamos un obxecto Notification baleiro
            $notification = new Notification();

            $notification->setDescription(htmlentities(addslashes($_POST["description"])));
            $notification->setUser($this->userMapper->view(htmlentities(addslashes($_POST['user']))));

            try {
                $this->notificationMapper->add($notification);
                $this->view->setFlash('succ_notification_add');
                $this->view->redirect("notification", "show");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
        }

        $this->view->render("notification", "add");
    }

    public function delete()
    {
        try {
            if (isset($_GET['codnotification'])) {
                $this->notificationMapper->delete($_GET['codnotification']);
                $this->view->setFlash('succ_notification_delete');
                $this->view->redirect("notification", "show");
            }
        } catch (Exception $e) {
            $this->view->setFlash('erro_general');
        }
        $this->view->render("notification", "show");
    }

    public function show()
    {
        $notifications = $this->notificationMapper->show();
        $this->view->setVariable("notificationstoshow", $notifications);
        $this->view->render("notification", "show");
    }

    public function view()
    {
        $notification = $this->notificationMapper->view($_GET['codnotification']);
        $this->view->setVariable("notification", $notification);
        $this->view->render("notification", "view");
    }

    public function edit()
    {

        if (isset($_POST["submit"])) {
            //Creamos un obxecto Notification baleiro
            $notification = $this->notificationMapper->view($_GET['codnotification']);

            if(isset($_POST['description']) && $_POST['description'] != ""){
                $notification->setDescription(htmlentities(addslashes($_POST["description"])));
            }

            $notification->setUser($this->userMapper->view(htmlentities(addslashes($_POST['user']))));

            try {

                $this->notificationMapper->edit($notification);
                $this->view->setFlash("succ_notification_edit");
            } catch (ValidationException $ex) {
                $this->view->setFlash("erro_general");
            }
            $this->view->redirect("notification", "show");
        }

        $this->view->render("notification", "edit");
    }

    public function search(){
        if(isset($_POST["submit"])){
            $notification = new Notification();
            if(isset($_POST['description'])){
                $notification->setDescription((htmlentities(addslashes($_POST["description"]))));
            }
            if(isset($_POST["user"])){
                $notification->setUser($this->userMapper->view(htmlentities(addslashes($_POST['user']))));
            }
            try {
                $this->view->setVariable("notificationstoshow", $this->notificationMapper->search($notification));

            } catch (Exception $e) {
                $this->view->setFlash("erro_general");
                $this->view->redirect("notification", "show");
            }

            $this->show();
        }else{
            $this->view->render("notification", "search");
        }

    }

    public function send(){

        if(isset($_POST["destiny"])){
            if (isset($_POST["subject"]) && !empty($_POST["subject"]) && isset($_POST["message"]) && !empty($_POST["message"])){

                $subject=$_POST["subject"];
                $message=$_POST["message"];
                $destinies = $_POST['destiny'];

                $mail = new PHPMailer;
                //Tell PHPMailer to use SMTP
                $mail->isSMTP();
                //Enable SMTP debugging
                // 0 = off (for production use)
                // 1 = client messages
                // 2 = client and server messages
                //$mail->SMTPDebug = 2;
                //Ask for HTML-friendly debug output
                $mail->Debugoutput = 'html';
                //Set the hostname of the mail server
                //$mail->Host = 'smtp.gmail.com';
                // use
                $mail->Host = gethostbyname('smtp.gmail.com');
                // if your network does not support SMTP over IPv6
                //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
                $mail->Port =587;
                //Set the encryption system to use - ssl (deprecated) or tls
                $mail->SMTPSecure = 'tls';
                //Whether to use SMTP authentication
                $mail->SMTPAuth = true;
                //Username to use for SMTP authentication - use full email address for gmail
                $mail->Username = "moovettG4@gmail.com";
                //Password to use for SMTP authentication
                $mail->Password = "moovettG4admin";
                //Set who the message is to be sent from
                $mail->setFrom("moovettG4@gmail.com", 'Ximnasio Moovett Ourense');
                //Set an alternative reply-to address
                $mail->addReplyTo("moovettG4@gmail.com", 'Ximnasio Moovett Ourense');
                //Set who the message is to be sent to
                //$mail->addAddress($email, $email);
                //Set the subject line
                $mail->Subject = $subject;
                //convert HTML into a basic plain-text alternative body
                $mail->Body = $message;
                //Replace the plain text body with one created manually
                $mail->AltBody = $message;
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    ));

                foreach($destinies as $email){
                    $mail->addAddress($email, $email);
                }
                if (!$mail->Send()) {
                    $this->view->setFlash("fail_mail_error");
                    $this->view->render("notification", "send");
                } else {
                    $this->view->setFlash("succ_mail_sent");
                }
            }else{
                $this->view->setFlash("fail_mail_error");
            }
            $this->view->redirect("notification", "show");
        }
        else{
            $this->view->render("notification", "send");
        }

    }
}
