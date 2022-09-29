<?PHP
require_once "conexion.php";
$json=array();
	if(isset($_GET["email"]) && isset($_GET["password"])){
		$email=$_GET['email'];
		$pasword=$_GET['password'];
		
		$conexion=mysqli_connect($hostname,$username,$password,$database);
		
		$consulta="SELECT id_usuario,email,password,username FROM usuarios WHERE email= '{$email}' AND password = '{$pasword}'";
		$resultado=mysqli_query($conexion,$consulta);

		if($consulta){
		
			if($reg=mysqli_fetch_array($resultado)){
				$json['datos'][]=$reg;
			}
			mysqli_close($conexion);
			echo json_encode($json);
		}



		else{
			$results["email"]='';
			$results["password"]='';
			$results["username"]='';
			$results["id_usuario"]='';
			$json['datos'][]=$results;
			echo json_encode($json);
		}
		
	}
	else{
		   	$results["email"]='';
			$results["password"]='';
			$results["username"]='';
			$results["id_usuario"]='';
			$json['datos'][]=$results;
			echo json_encode($json);
		}
?>