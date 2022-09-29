<?php
$response = array( 
    'status' => 0, 
    'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
); 
require_once "conexion.php";
$con =mysqli_connect($hostname,$username,$password,$database);

                $id=$_GET['id'];
           
                
                $sql = "DELETE FROM fumigacion WHERE id='{$id}'"; 
                
                $delete = $con->query($sql); 
                
                if($delete){ 
                    $response['status'] = 1; 
                    $response['msg'] = '¡Los datos de la fumigación se han eliminado con éxito!'; 
                 
            }else{ 
                $response['msg'] = 'Por favor complete todos los campos obligatorios.'; 
            } 
            
            echo json_encode($response); 
            ?>