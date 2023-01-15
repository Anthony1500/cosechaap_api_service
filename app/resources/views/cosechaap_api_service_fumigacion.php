<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'conexionapi.php';
include_once 'fumigacionapirest.php';


$database = new Database();
$db = $database->getConnection();



if (isset($_GET['id'])) {
    $id=$_GET['id'];
} else {
    $id = null;
}
$fumigacionapirest = new fumigacionapirest($db,$id);


if( isset($_GET['op'])){
    $op=  $_GET['op'] ;
} else {
    $op = null;
    //echo  json_encode( "No se definió  la variable op");
  }

// Obtener el método de la solicitud
$method = $_SERVER['REQUEST_METHOD'];

// Manejar la solicitud de acuerdo al método
function selectfumigacion() {
include_once 'fumigacionapirest.php';
    // Obtener las fumigaciones
$stmt = $fumigacionapirest->selectfumigacion();
$num = $stmt->rowCount();

if ($num > 0) {
    $fumigacion_arr = array();
    $fumigacion_arr = array();
    //$fumigacion_arr['records'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $fumigacion_item = array(
            "id" => $id,
            "fecha" => $fecha,
            "hora" => html_entity_decode($hora),
            "invernadero" => $invernadero,
            "tratamiento" => $tratamiento,
            "encargado" => $encargado
        );
        //array_push($fumigacion_arr['records'],$fumigacion_item);
        array_push($fumigacion_arr,$fumigacion_item);
    }
    http_response_code(200);
    echo json_encode($fumigacion_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Fumigaciones no Encontradas.")
    );
}
}
function selectfumigacionactual(){
include_once 'fumigacionapirest.php';
// Obtener las fumigaciones
$stmt = $fumigacionapirest->selectfumigacionactual();
$num = $stmt->rowCount();

if ($num > 0) {
    $fumigacionactual_arr = array();
    $fumigacionactual_arr = array();
    //$fumigacion_arr['records'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $fumigacionactual_item = array(
            "id" => $id,
            "fecha" => $fecha,
            "hora" => html_entity_decode($hora),
            "invernadero" => $invernadero,
            "tratamiento" => $tratamiento,
            "encargado" => $encargado
         );
        //array_push($fumigacion_arr['records'],$fumigacion_item);
        array_push($fumigacionactual_arr,$fumigacionactual_item);
    }
    http_response_code(200);
    echo json_encode($fumigacionactual_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Fumigaciones actuales no Encontradas.")
    );
}
}
function selectfumigacioneditar() {
include_once 'conexionapi.php';
include_once 'fumigacionapirest.php';
    if (isset($_GET['id'])) {
        $id=$_GET['id'];
    } else {
        $id = null;
    }
$fumigacionapirest = new fumigacionapirest($db,$id);

// Obtener las fumigaciones
$stmt = $fumigacionapirest->selectfumigacioneditar();
$num = $stmt->rowCount();

if ($num > 0) {
    $selectfumigacioneditar_arr = array();
    $selectfumigacioneditar_arr = array();
    //$fumigacion_arr['records'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $selectfumigacioneditar_item = array(
            "id" => $id,
            "fecha" => $fecha,
            "hora" => html_entity_decode($hora),
            "invernadero" => $invernadero,
            "tratamiento" => $tratamiento,
            "encargado" => $encargado
         );
        //array_push($fumigacion_arr['records'],$fumigacion_item);
        array_push($selectfumigacioneditar_arr,$selectfumigacioneditar_item);
    }
    http_response_code(200);
    echo json_encode($selectfumigacioneditar_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Fumigaciones actuales no Encontradas.")
    );
}
}

switch ($method) {
    case 'GET':

        switch ($op){
        case 'selectfumigacion':
        break;
        case 'selectfumigacionactual':
        break;
        case 'selectfumigacioneditar':

        break;
        }

       break;
    case 'POST':
        // Crear una fumigación
        $data = json_decode(file_get_contents("php://input"));
        if (!empty($_GET["fecha"])&&!empty($_GET["hora"])&&!empty($_GET["invernadero"])&&!empty($_GET["tratamiento"])&&!empty($_GET["encargado"]))  {
            $fumigacionapirest->fecha = $_GET["fecha"];
            $fumigacionapirest->hora = $_GET["hora"];
            $fumigacionapirest->invernadero = $_GET["invernadero"];
            $fumigacionapirest->tratamiento = $_GET["tratamiento"];
            $fumigacionapirest->encargado = $_GET["encargado"];
            if ($fumigacionapirest->agregarfumigacion()) {
                http_response_code(201);
                echo json_encode(array("message" => "Se agrego una nueva fumigación."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "No se puede crear la fumigación."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "No se puede crear la fumigación. Datos incompletos."));
        }
        break;

    case 'PUT':
        // Actualizar una fumigación
        $data = json_decode(file_get_contents("php://input"));
        if (!empty($_GET["id"])&&!empty($_GET["fecha"])&&!empty($_GET["hora"])&&!empty($_GET["invernadero"])&&!empty($_GET["tratamiento"])&&!empty($_GET["encargado"]))  {

        $fumigacionapirest->id = $_GET["id"];
        $fumigacionapirest->fecha = $_GET["fecha"];
        $fumigacionapirest->hora = $_GET["hora"];
        $fumigacionapirest->invernadero = $_GET["invernadero"];
        $fumigacionapirest->tratamiento = $_GET["tratamiento"];
        $fumigacionapirest->encargado = $_GET["encargado"];
        if ($fumigacionapirest->editarfumigacion()) {
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
        break;

        case 'DELETE':

            $id = $_GET['id'];
            if (!empty($id)) {
                if ($fumigacionapirest->eliminarfumigacion()) {
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

        break;




        }
?>
