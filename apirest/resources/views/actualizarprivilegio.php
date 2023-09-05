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
 if (!empty($_GET["id"])
    && !empty($_GET["privilegio"])) {
        $datosapirest->id = $_GET["id"];
        $datosapirest->privilegio = $_GET["privilegio"];

       /* $datosapirest = [
            'username' => $_GET["username"],
            'password' => $_GET["password"],
            'privilegio' => $_GET["privilegio"]?? null,// Se agregó un operador ternario para asignar un valor por defecto si no existe el parámetro.
            'activo' => $_GET["activo"]?? null,// Se agregó un operador ternario para asignar un valor por defecto si no existe el parámetro.
            'apellido' => $_GET['apellido'],
            'fecha' => $_GET['fecha'],
            'imagenusuario' => $_GET['imagenusuario'] ?? null, // Se agregó un operador ternario para asignar un valor por defecto si no existe el parámetro.
            'dispositivo' => $_GET['dispositivo'] ?? null // Se agregó un operador ternario para asignar un valor por defecto si no existe el parámetro.
        ];
*/


 if ($datosapirest->actualizarprivilegio()) {
 http_response_code(201);
 echo json_encode(array("message" => "Se actualizo el privilegio."));
 } else {
 http_response_code(503);
 echo json_encode(array("message" => "No se puede actualizar el privilegio."));
 }
 } else {
 http_response_code(400);
 echo json_encode(array("message" => "No se puede actualizar el privilegio. Datos incompletos."));
 }
?>
