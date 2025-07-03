<?php
header('Content-Typeapplication/x-www-form-urlencoded');

if(isset($_COOKIE["name"])){

    $response=json_encode(array("success"=>true, "name"=>$_COOKIE["name"]));
    
}else{
        $response=json_encode(array("success"=>false, "name"=>"Guest"));
}


echo $response;
exit;

?>