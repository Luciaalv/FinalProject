<?php
/*************Función para enviar correos electrónicos ******/

function sendMail($password, $email){

    require("PHPMailer-master/src/PHPMailer.php");
    require("PHPMailer-master/src/SMTP.php");
    require("PHPMailer-master/src/Exception.php");
    
      $mail = new PHPMailer\PHPMailer\PHPMailer();
      $mail->IsSMTP(); 
    
      $mail->SMTPDebug = 1; 
      $mail->SMTPAuth = true; 
      $mail->SMTPSecure = 'ssl'; 
      $mail->Host = "smtp.gmail.com";
      $mail->Port = 465; 
      $mail->IsHTML(true);
      $mail->Username = "correo@gmail.com";
      $mail->Password = "xxxxxxxxxxx";
      $mail->SetFrom("correo@gmail.com");
      $mail->Subject = "Datos de acceso";
      $mail->Body = "Tu contraseña para acceder a http://gestrad.000webhostapp.com es:\n $password";
      $mail->AddAddress($email);
    
       if(!$mail->Send()) {
          return false;
       } else {
          return true;
       }
    


    
}
?>
