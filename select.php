<?php
 date_default_timezone_set("America/Guayaquil");
require_once "conexion.php";
$connect =mysqli_connect($hostname,$username,$password,$database);


if ($connect){
    echo "Conectado: ";
    
}else if (!$connect) {
    echo "Error: " ;
    exit();

}


$query ="SELECT id FROM prueba  ";
$result = mysqli_query($connect,$query);

while($fila=$result->fetch_array()){
    $sensado[]=array_map('utf8_encode',$fila);
    $field1name = $fila["id"];
    
}
echo $field1name;
$result->close();

?>
