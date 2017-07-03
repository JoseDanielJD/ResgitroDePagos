<html>   
<head>   
<TITLE>Muestra la ficha completa de un resgistro.</TITLE>   
<!--<META name='robot' content='noindex, nofollow'> -->
</head>   

<body>   
<div align='center'>   
  <table border='1' cellpadding='0' cellspacing='0' width='0' bgcolor='#F6F6F6' bordercolor='#FFFFFF'>  
     <tr>   
      <td style='font-weight: bold'>Nombre Dominio</td>    
      <td style='font-weight: bold'>Nombre Cliente</td>
      <td style='font-weight: bold'>Identificación</td>
      <td style='font-weight: bold'>Numero Dep. o Transferencia</td>
      <td style='font-weight: bold'>Banco</td>
      <td style='font-weight: bold'>Monto</td>
      <td style='font-weight: bold'>Retenciones</td>
      <td style='font-weight: bold'>Fecha de Pago</td>
      <td style='font-weight: bold'>Correo</td>
      <td style='font-weight: bold'>Dirección Fiscal</td>
      <td style='font-weight: bold'>Telefono Principal</td>
      <td style='font-weight: bold'>Telefono Secundario</td>
      <td style='font-weight: bold'>Tipo de Servicio a renovar</td>
      <td style='font-weight: bold'>Status</td>
      <td style='font-weight: bold'>Fecha de conciliacion</td>
      <td style='font-weight: bold'>Num. Ticket</td>
    </tr>   

<?php  

$id = $_GET['ref'];

include('conexion.php');   

    $query = "select * from registro_transacciones where Id = '$id'"; 
    $result = mysql_query($query); 

while ($registro = mysql_fetch_array($result)){ 

echo " 
      <td width='150'>$id</td>;   
      <td width='150'>".$registro['NombreDominio']."</td>;
      <td width='150'>".$registro['NombreCliente']."</td>;   
      <td width='150'>".$registro['Identificacion']."</td>;"; 
} 
//include('cierra_conexion.php');   
?>   
   </table>   
</div>   
</body>   

</html>  