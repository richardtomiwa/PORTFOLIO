<?php
header('Content-Typeapplication/x-www-form-urlencoded');

if(isset($_POST["message"])){
    $message=$_POST["message"];
    $name=$_POST["name"];
    $subject=$_POST["subject"];
        setcookie("name",$name,time()+60*365*24*60);
    $response=json_encode(array("success"=>true, "message"=>$message, "name"=>$name, "subject"=>$subject));
    
}else{
        $response=json_encode(array("success"=>false, "message"=>"message not sent"));
}


echo $response;
exit;


?>