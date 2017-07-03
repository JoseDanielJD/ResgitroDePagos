  <html>   
<head>   
<TITLE>Muestra los resultados de una consulta MySQL que presenta un enlace para ver la información ampliada.</TITLE>   
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
include('conexion.php');   

// Dado que esto es solo una demo he limitado los resultados que se mostraran a 20 

    $query = "select * from registro_transacciones rt";
    $result = mysql_query($query);

    while ($registro = mysql_fetch_assoc($result)){   

    <td><?php echo $registro['Id']; ?></td>
    <td><?php echo $registro['NombreDominio']; ?></td>
    <td><?php echo $registro['NombreCliente']; ?></td>
    <td><?php echo $registro['Identificacion']; ?></td>
    <td><?php echo $registro['Refe']; ?></td>
    <td><?php echo $registro['Banco']; ?></td>
    <td><?php echo $registro['Monto']; ?></td>
    <td><?php echo $registro['FechaPago']; ?></td>
  <!--<td><?php echo $registro['Correo']; ?></td>
    <td><?php echo $registro['Tele1']; ?></td>
    <td><?php echo $registro['Tele2']; ?></td>-->
}   

?>   
   </table>   
</div>   
</body>   

</html> 