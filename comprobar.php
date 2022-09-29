<?PHP
require_once "conexion.php";
$json=array();
	if(isset($_GET["username"])){
		$usernames=$_GET['username'];
		
		$conexion=mysqli_connect($hostname,$username,$password,$database);
		
		$consulta="SELECT id_usuario,email,password,username  FROM usuarios WHERE username= '{$usernames}'";
		$resultado=mysqli_query($conexion,$consulta);

		if($consulta){
		
			if($reg=mysqli_fetch_array($resultado)){
				$json['probar'][]=$reg;
			}
			mysqli_close($conexion);
			echo json_encode($json);
		}

	else{
			$results["email"]='';
			$results["password"]='';
			$results["username"]='';
			$results["id_usuario"]='';
			$json['probar'][]=$results;
			echo json_encode($json);
		}

		
		
	}
		else{
		   	$results["email"]='';
			$results["password"]='';
			$results["username"]='';
			$results["id_usuario"]='';
			$json['probar'][]=$results;
			echo json_encode($json);
		}
	
?>