<?php
require_once "conexion.php";
$conexion =mysqli_connect($hostname,$username,$password,$database);


$consulta="SELECT * FROM fumigacion";
$resultado=$conexion ->query($consulta);

while($fila=$resultado->fetch_array()){
    $fumigacion[]=array_map('utf8_encode',$fila);

}
echo json_encode($fumigacion);
$resultado->close();