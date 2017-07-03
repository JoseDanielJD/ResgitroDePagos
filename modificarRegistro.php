<?php

	include 'conexion.php';

	$result = FALSE;

	if(isset($_POST["estado"]))
	{
  	$result = mysql_query("UPDATE registro_transacciones SET status = '".$_POST['estado']."'  WHERE id = ".$_POST['id'].";");
	}else if(isset($_POST["numticket"])){
	  $result = mysql_query("UPDATE registro_transacciones SET NumTicket = '".$_POST['numticket']."'  WHERE id = ".$_POST['id'].";");
	}

	if($result){
 		echo "OK";
 	}else{
 		echo "No se pudo actualizar el registro.";
	}
?>
