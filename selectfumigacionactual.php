<?php
date_default_timezone_set("America/Guayaquil");
require_once "conexion.php";
$conexion =mysqli_connect($hostname,$username,$password,$database);
$Date = date('Y-m-d', time());  
$consulta="SELECT * FROM fumigacion where fecha='{$Date}'";
$resultado=$conexion ->query($consulta);

while($fila=$resultado->fetch_array()){
    $fumigacion[]=array_map('utf8_encode',$fila);

}
echo json_encode($fumigacion);
$resultado->close();
?>