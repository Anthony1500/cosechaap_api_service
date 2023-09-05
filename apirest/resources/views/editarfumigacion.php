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

 // Actualizar una fumigación
 $data = json_decode(file_get_contents("php://input"));
 if (!empty($_GET["id"])&&!empty($_GET["fecha"])&&!empty($_GET["hora"])&&!empty($_GET["invernadero"])&&!empty($_GET["tratamiento"])&&!empty($_GET["encargado"]))  {

 $datosapirest->id = $_GET["id"];
 $datosapirest->fecha = $_GET["fecha"];
 $datosapirest->hora = $_GET["hora"];
 $datosapirest->invernadero = $_GET["invernadero"];
 $datosapirest->tratamiento = $_GET["tratamiento"];
 $datosapirest->encargado = $_GET["encargado"];
 if ($datosapirest->editarfumigacion()) {
 http_response_code(201);
 echo json_encode(array("message" => "Se actualizo la fumigación."));
 } else {
 http_response_code(503);
 echo json_encode(array("message" => "No se puede actualizar la fumigación."));
 }
 } else {
 http_response_code(400);
 echo json_encode(array("message" => "No se puede actualizar la fumigación. Datos incompletos."));
 }
?>
