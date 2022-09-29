<?php
$response = array( 
    'status' => 0, 
    'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
);          
require_once "conexion.php";
$conexion =mysqli_connect($hostname,$username,$password,$database);
$id=$_GET['id'];
$fecha=$_GET['fecha'];
$hora=$_GET['hora'];
$encargado=$_GET['encargado'];
$invernadero=$_GET['invernadero'];
$tratamiento=$_GET['tratamiento'];
$consulta="UPDATE fumigacion set fecha='{$fecha}',hora='{$hora}',invernadero='{$invernadero}',tratamiento='{$tratamiento}',encargado='{$encargado}' WHERE id='{$id}'";
$resultado=$conexion ->query($consulta);

if($resultado){ 
    $response['status'] = 1; 
    $response['msg'] = '¡Los datos del cobro se han actualizado con éxito!'; 

}else{ 
$response['msg'] = 'Por favor complete todos los campos obligatorios.'; 
} 

echo json_encode($response); 
?>