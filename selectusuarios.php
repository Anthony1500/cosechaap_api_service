<?php
require_once "conexion.php";
$conexion =mysqli_connect($hostname,$username,$password,$database);

$id_usuario=$_GET['id_usuario'];
$consulta="SELECT * FROM usuarios  WHERE id_usuario= '{$id_usuario}'";
$resultado=$conexion ->query($consulta);

while($fila=$resultado->fetch_array()){
    $usuario[]=array_map('utf8_encode',$fila);

}
echo json_encode($usuario);
$resultado->close();



