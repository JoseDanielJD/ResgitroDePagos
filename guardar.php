<?php
include ('conexion.php');


		if($_POST){ // si se ha presionado
			
			$nd = $_POST['nom'];
			$nc = $_POST['nomcli'];
			$ri = $_POST['identificacion'];
			$refe = $_POST['refe'];
			$bn = $_POST['banco'];
			$mo = $_POST['monto'];
			$fe = $_POST['fechaPago'];
			$co = $_POST['correo'];
			$tel = $_POST['tele1'];
			$tel2 = $_POST['tele2'];
			$tip = $_POST['tipo'];
			$cf = $_POST['ConfReferencia'];
			$st = $_POST['Status'];
			$fc = $_POST['FechaConciliacion'];

mysql_query("INSERT into conciliacion_registro (Status,FechaConciliacion,ConfReferencia)values('$nom','$nomcli','$identificacion','$refe','$banco','$monto','$fechaPago', +
	'$correo','$tele1','$tele2','$tipo',$st', '$fc','$cf')") or die (mysql_error());
			
			}
			else
			{
				echo "Debes llenar los campos.";
			}



		//	mysql_query("INSERT into conciliacion_registro(Status, FechaConciliacion)values('$st','$fc')", ) or die(mysql_error());
			//echo "<h2>Datos Almacenados</h2>";

?>

