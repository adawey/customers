<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



include_once "../config/db.php";
include_once "../object/customer.php";



$database = new Database();
$db = $database->getConnection();


$newCustomer = new Customer($db);

$data = json_decode(file_get_contents("php://input"));

$newCustomer->name=  $data->name;
$newCustomer->email= $data->email;
$newCustomer->phone= $data->phone;
$newCustomer->bio=   $data->bio;
$newCustomer->job=   $data->job;

if( !empty($data->name) && !empty($data->phone) ){
    if($newCustomer->create()){

        http_response_code(201);

        echo json_encode(array( " message " => " new customer add  "));

    }else{

        http_response_code(503);

        echo json_encode(array( "message " => " sorry but isn\'t add "));

    }
}else{

    http_response_code(404);

    echo json_encode(array("message " => "kosomk y hashem  feen eldata"));

}

?>