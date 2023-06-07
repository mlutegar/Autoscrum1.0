<?php

    use PHPMailer\PHPMailer\PHPMailer;

    require_once('vendor/autoload.php');

    date_default_timezone_set('America/Sao_Paulo');

    define('GUSER', 'caducando1991@gmail.com');
    define('GPWD', 'tjauufnreazpcmxb');

    function send($email, $name, $subject, $message){
        $mail = new PHPMailer;

       $mail->isSMTP();
       $mail->SMTPDebug = 0;
       $mail->Host = 'smtp.gmail.com';
       $mail->SMTPSecure = 'tls';
       $mail->Port = 587;
       $mail->SMTPAuth = true;
       $mail->Username = GUSER;
       $mail->Password = GPWD;

       $mail->setFrom($email, $name);
       $mail->addAddress(GUSER); 
       $mail->Subject = $email->subject; 

       $mail->msgHTML(constroiMensagem($message));
       $mail->AltBody = $message;

       $response = $mail->send();
       if($response)
       {
            $log_file = fopen('log_email.log', 'a');
            $date = date('Y-m-d H:i');
            fwrite($log_file, "Email enviado: {$email} - {$date}\r\n\r\n");
            fclose($log_file);
            redirect('success', 'Foi gerado uma nova senha e enviada para seu email');
       }

       if(!$response)
       {
            $log_file = fopen('log_email.log', 'a');
            $date = date('Y-m-d H:i');
            fwrite($log_file, "{$mail->ErrorInfo}\r\n{$email}\r\n{$date}\r\n\r\n");
            fclose($log_file);
            redirect('danger', 'Ocorreu uma falha ao recuperar a senha');
       }
    }

    function constroiMensagem($senha){
        return   "<!DOCTYPE html>"
               . "<html lang='pt-br'>"
                . "<head>"
                    . "<meta charset='UTF-8'>"
                    . "<meta http-equiv='X-UA-Compatible' content='IE=edge'>"
                    . "<meta name='viewport' content='width=device-width, initial-scale=1.0'>"
                    . "<title>Email fale conosco</title>"
                . "</head>"
                . "<body>"
                    . "<h1>Email enviado do fale conosco</h1>"
                    . "<div align='center'>"
                        . "<p>{$senha}</p>"
                    . "</div>"
                . "</body>"
                . "</html>";
    }

    function redirect($status, $msg){
        setcookie('notify', $msg, time() + 10, "supermanga/message_us.php", 'localhost');
        setcookie('status', $status, time() + 10, "supermanga/message_us.php", 'localhost');
        header("location: message_us.php");
        exit;
    }
?>