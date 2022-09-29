<?PHP
$response = array( 
	'status' => 0, 
	'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
);      
require_once "conexion.php";


	if(isset($_GET["privilegio"]) && isset($_GET["id_usuario"])){
		$privilegio=$_GET['privilegio'];
		$id_usuario=$_GET['id_usuario'];
		
		$conexion=mysqli_connect($hostname,$username,$password,$database);
		
		$consulta="UPDATE usuarios set privilegio='{$privilegio}' WHERE id_usuario='{$id_usuario}'";
		$resultado=mysqli_query($conexion,$consulta);

		if($resultado){ 
			$response['status'] = 1; 
			$response['msg'] = '¡Los datos del usuario se han actualizado con éxito!'; 
		} 
	}else{ 
		$response['msg'] = 'Por favor complete todos los campos obligatorios.'; 
	} 
	 
	echo json_encode($response); 
	
?>