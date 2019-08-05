<?php

namespace Lib\Classes;

/**
 * Description of mail
 *
 * @author Thalisson
 */
class Mail
{
    /*
     * SMTP username
     */
    private $username = 'suporte@cabralgama.com';
    
    /*
     * SMTP password
     */
    private $password = '007thasakura';
    
    
    /*
     * Envia email
     * @var string $para -> email da pessoa
     * @var string $assunto -> assunto do email
     * @var string $corpo -> corpo do email
     */
    public function sendEmail($para, $assunto, $corpo)
    {
        $mail = new \PHPMailer();

        // Debug
        //$mail->SMTPDebug  = 3;
        
        $mail->isSMTP();                 // Set mailer to use SMTP
        $mail->Host = 'mail.cabralgama.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;          //Enable SMTP authentication
        $mail->Username = $this->username;         // SMTP username
        $mail->Password = $this->password;          // SMTP password
        $mail->SMTPSecure = 'ssl';       // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;               // TCP port to connect to
        
        $mail->setFrom("suporte@cabralgama.com", "Suporte SPICG");
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);             // Set email format to HTML

        $mail->addAddress($para);       // Add a recipient
        $mail->Subject = $assunto;
        $mail->Body = $corpo;

        if (!$mail->send()) {

            $error = 'Desculpe, não foi possível enviar o email. Por favor, contate o suporte.';
            $error .= "<br />";
            $error .= "Error: $mail->ErrorInfo";
            
            Messages::setMsg($error, 'error');
            Messages::getMsg();
        }
    }
}
