<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/db.php";
include_once "../object/customer.php";



$database = new Database();
$db = $database->getConnection();

$custom = new Customer($db);

$stmt = $custom->read();
$count= $stmt->rowcount();


if($count > 0 ){

    $customer_array = array();
    $customer_array['data'] = array();

    while ($count = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($count);

        $customer_details = array(
            "id" => $id,
            "name" =>$name,
            "email" => $email,
            "phone"=>$phone,
            "bio"=>$bio,
            "job"=>$job, 
        );
        array_push($customer_array['data'],$customer_details);

    }

    http_response_code(200);
    echo json_encode($customer_array);

}else{
    http_response_code(400);
    echo json_encode(
        array("message"=> " it not found")
    );
}

?>

