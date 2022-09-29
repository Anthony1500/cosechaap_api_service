<?PHP
require_once "conexion.php";

$json=array();
	if(isset($_GET["fecha"]) && isset($_GET["hora"])&& isset($_GET["invernadero"])&& isset($_GET["tratamiento"])&& isset($_GET["encargado"])){
		$fecha=$_GET['fecha'];
		$hora=$_GET['hora'];
        $invernadero=$_GET['invernadero'];
        $tratamiento=$_GET['tratamiento'];
        $encargado=$_GET['encargado'];
		
		$conexion=mysqli_connect($hostname,$username,$password,$database);
		$consulta="INSERT INTO fumigacion (fecha,hora,invernadero,tratamiento,encargado) values ('$fecha','$hora','$invernadero','$tratamiento','$encargado')";
		$resultado=mysqli_query($conexion,$consulta);

		if($consulta){
				
			mysqli_close($conexion);
			echo "ingreso exitoso";
		}

	}
	
?>

