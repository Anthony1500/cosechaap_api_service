<?php
require_once "conexion.php";
$conexion =mysqli_connect($hostname,$username,$password,$database);


$consulta="SELECT * FROM usuarios ";
$resultado=$conexion ->query($consulta);

while($fila=$resultado->fetch_array()){
    $usuario[]=array_map('utf8_encode',$fila);

}
echo json_encode($usuario);
$resultado->close();



