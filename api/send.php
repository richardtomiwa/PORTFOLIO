<?php

require '../resources/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Typeapplication/x-www-form-urlencoded');

if(isset($_POST["name"]) && isset($_POST["message"]) && isset($_POST["subject"]) && $_POST["message"]!="" && $_POST["subject"]!="" && $_POST["name"]!="" ){
    $message=$_POST["message"];
    $name=$_POST["name"];
    $subject=$_POST["subject"];
    $email="richardtomiwa5@gmail.com";
        setcookie("name",$name,time()+60*365*24*60);

        
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'richardfiverr5@gmail.com'; //host email 
    $mail->Password = 'xqim aqui edmf blgd'; // app password of your host email
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom('richardtomiwa5@gmail.com', "$name"); //Sender's Email & Name
    $mail->addAddress("$email", "$name"); //Receiver's Email and Name
    $mail->Subject = ("$subject");
    $mail->Body = $message;
    $mail->send();
    $response=json_encode(array("success"=>true, "message"=>$message, "name"=>$name, "subject"=>$subject));
    
}else{
        $response=json_encode(array("success"=>false, "message"=>"message not sent"));
}


echo $response;
exit;


?>