<?php
date_default_timezone_set("America/Guayaquil");
require_once "conexion.php";
$conexion =mysqli_connect($hostname,$username,$password,$database);
$consulta="SELECT * FROM Datos_planta";
$resultado=$conexion ->query($consulta);
while($fila=$resultado->fetch_array()){
    $sensado[]=array_map('utf8_encode',$fila);
}
echo json_encode($sensado);
$resultado->close();