<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
$link = mysql_connect("localhost", "registro", "Dayco2017");
		mysql_select_db("daycohost");

echo 'Conectado satisfactoriamente';

$sql = mysql_query("INSERT INTO registro_transacciones NombreDominio, username, identificacion, email, email2, refe, monto, fechaPago, telefono1, telefono2) 
	VALUES ('$NombreDominio', '$username', '$identificacion', '$email', '$email2', '$refe', '$monto', '$fechaPago', '$telefono1', '$telefono2')", $link);

		$result = mysql_query($sql);
		
?>

</body>
</html>

