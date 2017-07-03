<!--FORMULARIO DE CONSULTA PARA FINANZAS-->
<?php
include ('conexion.php');
$query = "select * from registro_transacciones rt";
$result = mysql_query($query);
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.dataTables.min.css"/>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	
	<title></title>

	<script type="text/javascript">
	$(document).ready(function() {
	    $('#Table').dataTable();
	    });
	</script>
	<script language="Javascript">
		function guardarTicket(id, numticket){
			$.ajax({
				url: "modificarRegistro.php",
				data: {
					id: id,
					numticket: numticket
				},
				type: "POST"
			})
			.done(function (respuesta){
				if (respuesta == "OK"){
					alert("El registro fue actualizado (numticket)");	
				}else{
					alert("Error SQL: " + respuesta);	
				}
				
			})
			.fail(function (respuesta){
				alert("Error HTTP: " + respuesta);
			})
			return false;
		}
		function cambiarEstado(id, checked){
			var estado = 0;
			if (checked) estado = 'Procesado'; // Procesado
			$.ajax({
				url: "modificarRegistro.php",
				data: {
					id: id,
					estado: estado
				},
				type: "POST"
			})
			.done(function (respuesta){
				if (respuesta == "OK"){
					alert("El registro ha sido modificado");	
				}else{
					alert("Error SQL: " + respuesta);	
				}
				
			})
			.fail(function (respuesta){
				alert("Error HTTP: " + respuesta);
			})
			return false;
		}
	</script>
</head>
<body>
<br><font face="calibri"><h1 align="Center"><img align="left" src="http://www.cwv.com.ve/wp-content/uploads/2012/06/logo-Dayco-Host.jpg" width="120"> Registros hasta la fecha </h1></font></br>
<p>
<hr  size="5px" color="green"/>
</p>

	<?php
	if ($result) {   ?>
	<!-- <form action="" method="POST"> -->
	<table border="1px" id="Table" align="Center">
 	<tr>
		<!--<th>Id</th>-->
	  <th>Nombre del Dominio</th>
	  <!--<th>Nombre del Cliente</th>-->
	  <th>prueba</th>
	  <!--<th>Rif / C.I</th>-->
	  <th>Referencia de Operación</th>
	  <th>Banco</th>
	  <th>Monto</th>
	  <th>Fecha de Pago</th>
	  <th>Forma de Pago</th>
	  <th>Correo</th>
	  <th>Telefono Principal</th>
	  <!--<th>Telefono Secundario</th>-->
	  <th>Tipo</th>
	  <th>Status</th>
	  <th>Numero de Ticket</th>
	  <!--<th>Fecha de Conciliación</th>
	  <th>Acción</th>-->
 	</tr>

 	<?php  
 	while ($registro=mysql_fetch_assoc($result)) {?>
 	<tr>
 	  <!--<td><?php echo $registro['Id']; ?></td>-->
	  <td><?php echo $registro['NombreDominio']; ?></td>
	  <!--<td><?php echo $registro['NombreCliente']; ?></td>-->
	  <td><?php echo $registro['ComboIdentificacion'] . $registro['Identificacion']; ?></td>
	  <td><?php echo $registro['Refe']; ?></td>
	  <td><?php echo $registro['Banco']; ?></td>
	  <td><?php echo $registro['Monto']; ?></td>
	  <td><?php echo $registro['FechaPago']; ?></td>
	  <td><?php echo $registro['Forma_Pago']; ?></td>
	  <td><?php echo $registro['Correo']; ?></td>
  	  <td><?php echo $registro['Tele1']; ?></td>
  	  <!--<td><?php echo $registro['Tele2']; ?></td>-->
	  <td><?php echo $registro['Tipo']; ?></td>
	  <td><?php echo $registro['Status']; ?>
	  <input type="checkbox" name="condicion" value="Procesado" onchange="cambiarEstado(<?php echo $registro['Id'];?>, this.checked);"></input>	  
	  <!--<input type="checkbox" name="condicion" value="Anulado" onchange="cambiarEstado(<?php echo $registro['Id'];?>, this.checked);"></input>-->
	</td>
	
	<td>
		<input id="numticket<?php echo $registro['Id'];?>" value="<?php echo $registro['NumTicket']; ?>"><br/>
		<script language="Javascript">
	        var id="<?php echo $registro['Id'];?>";
	        $("#numticket"+id).keyup(function(e){
            	if (e.keyCode==13){ //ENTER
                	guardarTicket(<?php echo $registro['Id'];?>, this.value);
            	}
            });
		</script>
	</td>
	<!--<td><?php echo $registro['FechaConciliacion']; ?>
		<input type="timeStamp" name="FechaConciliacion" hidden="true"> <br/>
	</td>-->

	<!--<td><a href=Ficha.php?ref=".$registro['id']." title='Ver la ficha completa'>Más información</a></td>-->
  	</tr>
 
 	<?php }?>
	</table>

	<?php   } 
	
	else{?>
   	<p>No hay contactos en la agenda</p>
	<?php } ?>

	   <p>
	   <hr  size="5px" color="green"/>
	   </p>
	   <!--
	<div align="Center">
	<input type="submit" value="Grabar" name="enviar">
	<input type="reset" value="Borrar información">
	</div> 
	-->
	</form>
	
	</body>
	</html>


	
