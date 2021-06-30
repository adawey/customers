<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/db.php";
include_once "../object/customer.php";



$database = new Database();
$db = $database->getConnection();

$custom = new Customer($db);

$custom->id = isset($_GET['id']) ? $_GET['id'] : die();

$custom->readOne();

if($custom->name != null ){

    $customer_array = array(
        "id" => $custom->id,
        "name" => $custom->name,
        "email" => $custom->email,
        "phone" =>  $custom->phone,
        "bio"=>$custom->bio,
        "job"=>$custom->job,


    );
    http_response_code(200);

    echo json_encode($customer_array);

}else{

    http_response_code(400);

    echo json_encode( array("message" => "not found"));
    
}

