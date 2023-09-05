<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'conexionapi.php';
include_once 'datosapirest.php';


$database = new Database();
$db = $database->getConnection();


$datosapirest = new datosapirest($db,$id);
// Manejar la solicitud de acuerdo al método

$id = $_GET['id'];
if (!empty($id)) {
    if ($datosapirest->eliminarfumigacion()) {
        http_response_code(200);
        echo json_encode(array("message" => "Fumigación eliminada."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "No se puede eliminar la fumigación."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "No se puede eliminar la fumigación. ID incompleto."));
}


?>
