<html>
<body>
<?php
/*$connect=mysql_connect("localhost","registro","Dayco2017");
mysql_select_db('daycohost', $connect)*/

if ($connect) {
		echo "conexion exitosa. <br />";
		$NombreDominio= $_POST ["NombreDominio"];
		$username= $_POST ["username"];
		$identificacion= $_POST ["identificacion"];
		$email= $_POST ["email"];
		$email2= $_POST ["email2"];
/*		$tipo= $_POST ['tipo'];
		$banco= $_POST ['banco'];*/
		$refe= $_POST ["refe"];
		$monto= $_POST ["monto"];
		$fechaPago= $_POST ["fechaPago"];
		$telefono1= $_POST ["telefono1"];
		$telefono2= $_POST ["telefono2"];

		$consulta="INSERT INTO $registro_trasacciones (NombreDominio, username, identificacion, email, email2, refe, monto, fechaPago, telefono1, telefono2) 
		VALUES ('$NombreDominio','$username','$identificacion','$email','$email2', '$tipo','$banco','$refe','$monto','$fechaPago','$telefono1','$telefono2')";
		mysql_query($consulta);
		
?>
<br><br>
<a href="https://webhosting.daycohost.com/registro/categRegistro.php">DEVOLVER A EL FORMULARIO </a>
<body/>
<html/>