<?php 
require 'conexionreporte.php';
function getpropietario ()
{
  $mysqli = getConnexion();
  $query = 'SELECT * FROM  fumigaciones ';
  return $mysqli->query($query);
}
?>