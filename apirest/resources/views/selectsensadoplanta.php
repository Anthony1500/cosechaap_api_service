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

if (isset($_GET['id'])) {
    $id=$_GET['id'];
} else {
    $id = null;
}
$datosapirest = new datosapirest($db,$id);
// Manejar la solicitud de acuerdo al método


    // Obtener las Datos
$stmt = $datosapirest->selectsensadoplanta();
$num = $stmt->rowCount();

if ($num > 0) {
    $planta_arr = array();
    $planta_arr = array();
    //$fumigacion_arr['records'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $planta_item = array(
            "id" => $id,
            "temperatureamb" => $temperatureamb,
            "humidityamb" => html_entity_decode($humidityamb),
            "humidity" => $humidity,
            "fecha" => $fecha,
            "hora" => $hora
        );
        //array_push($planta_arr['records'],$planta_item);
        array_push($planta_arr,$planta_item);
    }
    http_response_code(200);
    echo json_encode($planta_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Datos no Encontrados.")
    );
}


?>
