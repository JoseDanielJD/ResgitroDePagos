<?php 
// Extraemos el nombre y el email del registro con id = 3 

$id = 3; 

include('conexion.php'); 

$query_tb = "SELECT id, NombreDominio, NombreCliente, Identificacion, Refe, Banco, Monto, FechaPago, Correo, Tele1, Tele2, Tipo, Status, FechaConciliacion FROM registro_transacciones where id ='$id'"; 


$recupero1 = mysql_query($query_tb, $conexion_db) or die(mysql_error()); 
$recupero2 = mysql_query($query_tb, $conexion_db) or die(mysql_error()); 

// ------------------------------------------------------------------------ 
$rec_id="";  
while ($row_tb=mysql_fetch_assoc($recupero1)) 
{  
$rec_id = ($row_tb['Id']."");  
} 
echo "$rec_id <br>"; 


// ------------------------------------------------------------------------ 
$rec_NombreDominio="";  
while ($row_tb=mysql_fetch_assoc($recupero2)) 
{  
$rec_NombreDominio = ($row_tb['NombreDominio']."");  
} 
echo "$rec_NombreDominio <br>"; 
// ------------------------------------------------------------------------ 
// Cerramos las conexión a la base de datos 

?>