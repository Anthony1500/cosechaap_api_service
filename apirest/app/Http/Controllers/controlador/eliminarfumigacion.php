<?php

$response = array( 
                'status' => 0, 
                'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
            );   
            
            if(isset($_POST['id'])){ 
                $id=$_GET['id'];
           
                
                $sql = "DELETE FROM fumigacion WHERE id='{$id}'"; 
                $con =mysqli_connect("remotemysql.com","k7jTW1fAmX","nZwp5aoAz8","k7jTW1fAmX");
                $delete = $con->query($sql); 
                
                if($delete){ 
                    $response['status'] = 1; 
                    $response['msg'] = '¡Los datos de la fumigación se han eliminado con éxito!'; 
                 
            }else{ 
                $response['msg'] = 'Por favor complete todos los campos obligatorios.'; 
            } 
            }
            echo json_encode($response); 
            ?>