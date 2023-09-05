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

if (isset($_GET['id_usuario'])) {
    $id=$_GET['id_usuario'];
} else {
    $id = null;
}
echo $id;
$datosapirest = new datosapirest($db,$id);
// Manejar la solicitud de acuerdo al método

// Obtener los usuarios
$stmt = $datosapirest->selectusuarios();
$num = $stmt->rowCount();

if ($num > 0) {
    $selectusuarios_arr = array();
    $selectusuarios_arr = array();
    //$selectusuarios_arr['records'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $selectusuarios_item = array(
            "id_usuario" => $id_usuario,
            "username" => $username,
            "password" => html_entity_decode($password),
            "privilegio" => $privilegio,
            "activo" => $activo,
            "apellido" => $apellido,
            "email" => $email,
            "fecha" => $fecha,
            "imagenusuario" => $imagenusuario,
            "dispositivo" => $dispositivo
         );
        //array_push($selectusuarios_arr['records'],$selectusuarios_item);
     
        array_push($selectusuarios_arr,$selectusuarios_item);
    }
    http_response_code(200);
    echo json_encode($selectusuarios_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Usuario  no Encontrado.")
    );
}
?>
