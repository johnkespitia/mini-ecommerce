<?php
namespace Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class MailService {

    protected $mailer;
    
    public function __construct(){
        $this->mailer = new PHPMailer(true);
        $this->mailer->SMTPDebug = false;//($_ENV["SITE_ENVIRONMENT"]=="DEV");
        $this->mailer->isSMTP();
        $this->mailer->Host       = $_ENV["MAILER_HOST"];
        $this->mailer->SMTPAuth   = true;                
        $this->mailer->Username   = $_ENV["MAILER_USERNAME"];
        $this->mailer->Password   = $_ENV["MAILER_PASSWORD"];
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port       = $_ENV["MAILER_PORT"];   
        $this->mailer->setFrom($_ENV["MAILER_USERNAME"], $_ENV["SITE_NAME"]);
        $this->mailer->isHTML(true);   
    }

    public function sendMail($to, $subject, $body){
        $this->mailer->addAddress($to); 
        if($_ENV["SITE_ENVIRONMENT"]=="DEV"){
            $this->mailer->addAddress($_ENV["MAILER_USERNAME"]); 
        }
        $this->mailer->Subject = $subject;
        $this->mailer->Body    = $body;
        $this->mailer->send();
    }

    public function testMail($to, $subject, $body){
        
        //die;
        $this->mailer->addAddress($to); 
        if($_ENV["SITE_ENVIRONMENT"]=="DEV"){
            $this->mailer->addAddress($_ENV["MAILER_USERNAME"]); 
        }
        $this->mailer->Subject = $subject;
        $this->mailer->Body    = $body;
        $this->mailer->send();
    }
}