<?php
namespace Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class MailService {

    protected $mailer;
    
    public function __construct(){
        $this->mailer = new PHPMailer(true);
        $this->mailer->SMTPDebug = ($_ENV["SITE_ENVIRONMENT"]=="DEV");
        $this->mailer->isSMTP();
        $this->mailer->Host       = $_ENV["MAILER_HOST"];
        $this->mailer->SMTPAuth   = true;                
        $this->mailer->Username   = $_ENV["MAILER_USERNAME"];
        $this->mailer->Password   = $_ENV["MAILER_PASSWORD"];
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port       = $_ENV["MAILER_PORT"];   
        $this->mailer->setFrom($_ENV["MAILER_USERNAME"], $_ENV["SITE_NAME"]);
        $this->mailer->AddEmbeddedImage($_ENV["STORAGE_IMAGES"].'/email/brand.png', 'brand.png');
        $this->mailer->isHTML(true);   
    }

    public function addAttachment($file){
        $this->mailer->addAttachment($file);
    }

    public function sendMail($to, $subject, $body){
        if(is_array($to)){
            foreach ($to as $value) {
                $this->mailer->addAddress($value);     
            }
        }else{
            $this->mailer->addAddress($to); 
        }
        if($_ENV["SITE_ENVIRONMENT"]=="DEV"){
            $this->mailer->addAddress($_ENV["MAILER_USERNAME"]); 
        }
        $this->mailer->Subject = $subject;
        $this->mailer->Body    = $body;
        $this->mailer->send();
    }

    public function testMail($to = null, $subject, $body, $bcc = []){
        
        //die;
        if(!empty($to)){
            $this->mailer->addAddress($to); 
        }
        if(!empty($bcc)){
            foreach ($bcc as $mailBcc) {
                $this->mailer->addBcc($mailBcc);
            }
        }
        if($_ENV["SITE_ENVIRONMENT"]=="DEV"){
            $this->mailer->addAddress($_ENV["MAILER_USERNAME"]); 
        }
        $this->mailer->Subject = $subject;
        $this->mailer->Body    = $body;
        $this->mailer->send();
    }
}