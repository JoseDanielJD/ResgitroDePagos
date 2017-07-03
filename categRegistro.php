
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>REGISTRE SU PAGO</title>

	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>

	<link rel="stylesheet" href="js/jquery-ui-themes-1.12.1/themes/south-street/jquery-ui.min.css"> 
	<script type="text/javascript" src="js/jquery-ui-1.12.1/jquery-ui.min.js"></script>

	<link rel="stylesheet" type="text/css" href="js/DataTables-1.10.12/media/css/dataTables.jqueryui.min.css"/>
	<script type="text/javascript" src="js/DataTables-1.10.12/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/DataTables-1.10.12/media/js/dataTables.jqueryui.min.js"></script>

	<link rel="stylesheet" type="text/css" href="js/chosen/chosen.min.css"/>
	<script src="js/chosen/chosen.jquery.min.js" type="text/javascript"></script>

	<link rel="stylesheet" type="text/css" href="telefono/build/css/intlTelInput.css">
	<script src="telefono/build/js/intlTelInput.min.js" type="text/javascript"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.9/jquery.mask.js"></script>

	<Script src = "https://www.google.com/recaptcha/api.js"></script>

	<script src="formato/jquery.formatCurrency-1.4.0.min.js" type="text/javascript"></script>
	<script src="formato/i18n/jquery.formatCurrency.es-CL.js" type="text/javascript"></script>

	<script type="text/javascript">

		function applyFormatCurrency(sender) {
 		   $(sender).formatCurrency({
        	region: 'es-CL'
        	,roundToDecimalPlace: -1
    		});	
		}

		function validarEmail(valor){
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(valor))
			{
				alert("La dirección de email " + valor + " es correcta."); 
				return (true);
	 		}
	 		else
	 		{
	  			alert("La dirección de email es incorrecta.");
	  			return (false);
	 		}
		}
		function habilitarCombo(value)
		{
			if(value=="Transferencia")
			{
				// habilitamos
				document.getElementById("segundo").disabled=false;
			}else if(value=="Deposito"){
				// deshabilitamos
				document.getElementById("segundo").disabled=true;
			}
		}

		function valida(e){
		    tecla = (document.all) ? e.keyCode : e.which;
		    //Tecla de retroceso para borrar, siempre la permite
		    if (tecla==8) return true;
		    // Patron de entrada, en este caso solo acepta numeros
		    patron =/[0-9]/;
		    tecla_final = String.fromCharCode(tecla);
		    return patron.test(tecla_final);
		}

		function pregunta(){ 
		    if (confirm('Favor validar los Datos registrados, para que su pago procesado de manera exitosa...!!!!!')){ 
		       document.registro.submit() 
		    }
	    } 

		function load_select(id, url){
			$.ajax({
				type: "GET",
				url: url,
				dataType: "json"
			}).done(function (data){
				$.each(data, function( index,  option ) {
				  html = "<option value=\"" + option["val"] + "\">" + option["txt"] + "</option>";
					$("#" + id).append(html);		
				});
				$("#" + id).trigger("chosen:updated");
			}).fail(function (data){
				alert("Error loading " + id);
			});
		}

		function change_select(id_change, id_chain, url){
			id = $('#'+id_change).val();
			$('#'+id_chain).find('option').remove();
			load_select(id_chain, url + "&fil=" + id);
		}

 		function format(input)
		{
			var num = input.value.replace(/\./g,'');
			if(!isNaN(num)){
				num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
				num = num.split('').reverse().join('').replace(/^[\.]/,'');
				input.value = num;
			}else{ 
				alert('Solo se permiten numeros');
				input.value = input.value.replace(/[^\d\.]*/g,'');
			}
		}

		function enviar(){

			var fields = $(".ss-item-required")
			.find("select, textarea, input").serializeArray();

			$.each(fields, function(i, field){
				if (!field.value)
					alert(field.name + ' is required');
			});
			console.log(fields);

			if (grecaptcha.getResponse() != ""){
		    	document.registro.submit();
			}else{
    			alert("Favor hacer click en no soy un robort");
			}
		}

		</script>
	</head>
<body>

<?php
	require 'PHPMailer/PHPMailerAutoload.php';
	require "conexion.php";
	require "envio.php";

	if($_POST){ // si se ha presionado
		
			$nd = $_POST['nom'];
			$nc = $_POST['nomcli'];
			$ci = $_POST['comboident'];
			$ri = $_POST['identificacion'];
			$refe = $_POST['refe'];
			$tip = $_POST['tipo'];
			$form = $_POST['forma'];
			$bn = $_POST['segundo'];
			$mo = $_POST['monto'];
			$rete = $_POST['rete'];
			$fe = $_POST['fechaPago'];
			$co = $_POST['correo'];
			$est = $_POST['estado'];
			$mun = $_POST['municipio'];
			$par = $_POST['parroquia'];
			$dir = $_POST['direccion'];
			$tel = $_POST['tele1'];
			$tel2 = $_POST['tele2'];
	
   	$resultado = mysql_query("insert into registro_transacciones(NombreDominio, NombreCliente, ComboIdentificacion, Identificacion, Refe,Forma_Pago,Tipo, Banco, Monto, Retenciones, FechaPago, Correo, Estado, Municipio, Parroquia,Direccion_Fiscal,Tele1, Tele2)values('$nd','$nc','$ci','$ri','$refe','$form','$tip','$bn','$mo','$rete','$fe','$co','$est','$mun','$par','$dir','$tel','$tel2')") or die(mysql_error());

			if(isset($_POST['g-recaptcha-response'])){
          		$captcha=$_POST['g-recaptcha-response'];
          	}if(!$captcha){
          		echo '<h2>Por favor, compruebe el formulario de captcha.</h2>';
        	}
        	$secretKey = "6Lc6-xQUAAAAAKbGJ0ZaEp71Mv65WG7zDVkm4pKh";
        	$ip = $_SERVER['REMOTE_ADDR'];
        	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        	$responseKeys = json_decode($response,true);
        	if(intval($responseKeys["success"]) !== 1) {
          		echo '<h2>Gracias por registrar su pago en breve recibira un correo con su registro...</h2>';
        	}else{
          	echo '<h2>Error...</h2>';
        	}

        	if ($resultado){
			    $to = $_POST['correo'];
				$body = "<b><br>El registro de su informacion es la siguiente:</b><br>".
								"Nombre del Dominio: <strong>$nd</strong><br>".
								"Tipo de Servicio a renovar: <strong>$tip</strong><br>".
								"Nombre del Cliente: <strong>$nc</strong><br>".
								"Documento fiscal: <strong>$ri</strong><br>".
								"Referencia de transaccion: <strong>$refe</strong><br>".
								"Forma de Pago: <strong>$form</strong><br>".
								"Entidad Bancaria: <strong>$bn</strong><br>".
								"Monto: <strong>$mo</strong><br>".
								"Fecha de Pago: <strong>$fe</strong><br>".
								"Retenciones Aplicadas: <strong>$rete</strong><br>".
								"Direccion: <strong>$dir</strong><br>".
								"Telefono Principal: <strong>$tel</strong><br>".
								"Telefono Secundario: <strong>$tel2</strong><br>".
				
				$to = $_POST['correo'];
				$subject = "Notificacion de Pago - SharedHosting - Dominio: $nd";
				$enviado = doMail($to, $subject, $body, true, false);
				/*if ($enviado){
					echo "El correo ha sido enviado<br>";
				}*/
			}
		}		
	?>

<br><font face="calibri,calibri,calibri"><h2 align="Center"><img align="left" src="http://www.cwv.com.ve/wp-content/uploads/2012/06/logo-Dayco-Host.jpg" width="100"> Registre su pago </h2></font></br>
	
<form action="" method="POST" name="registro" >
<p><hr color="green" size="5" /></p>
		<h3>INFORMACION DEL SERVICIO</h3>
		<div class="ss-item-required">
		<p>
			<font face="calibri"><b><td>Tipo de Servicio a Renovar asociado al pago:</td></font>
			<font face="calibri" color="red">Renovación de Plan<input required value="Plan" type="radio" name="tipo"></font>
			<font face="calibri" color="red">Renovacion de Dominio<input required value="Dominio" type="radio" name="tipo"></font>
			<font face="calibri" color="red">Ambos servicios<input required value="Ambos" type="radio" name="tipo"></font>
		<p>
			<font face="calibri"><b><td>Nombre del Dominio:</td></b></font>
			<textarea required rows="1" cols="70" name="nom" placeholder="Agregue el(los) dominios separados por (',')"></textarea>
		</p>	
		</div>
<hr color="green" size="5" />
			<h3 >INFORMACION DEL PAGO</h3>
		<div class="ss-item-required">
		<p>
			<font face="calibri"><b><td>Forma de Pago:</td></font>
			<font face="calibri" color="red">Deposito<input value="Deposito" id="radio-1" type="radio" name="forma" required></font>
			<font face="calibri" color="red">Transferencia<input value="Transferencia" id="Transferencia" type="radio" name="forma" onchange="habilitarCombo(this.value)" required></font> 
			
			<font face="calibri"><b><td>Banco Emisor:</td></font>
				<select required name="segundo" disabled="disabled" id="segundo" required>
					<option>Seleccione</option>
					<option>Venezuela</option>
					<option>Banesco</option>
					<option>Mercantil</option>
					<option>Bicentenario</option>
					<option>Provincial</option>
					<option>Tesoro</option>
					<option>Bancaribe</option>
				</select>
		</p>
		<p>
			<font face="calibri"><b><td>Numero de Transferencia o Deposito:</td></b></font>
			<input required name="refe" onkeypress="return valida(event)" placeholder="Favor ingrese el número de Transferencia" size="31"> <br/>
		<p>
		
			<font face="calibri"><b><td>Fecha de Transferencia o Deposito:</td></b> </font>
			<input required type="date" name="fechaPago" placeholder="Favor ingrese la fecha del pago" size="15"> <br/>
		
		<p>
			<font face="calibri"><b><td>Monto de Transferencia o Deposito:</td></b></font>
			<input required name="monto" type="text" placeholder="Favor ingrese el monto del pago" size="25" onchange="applyFormatCurrency(this);"> <br/>
			<!--<script>
				$('.money').mask('000.000.000.000.000,00', {reverse: true});
				$('.money2').mask("#.##0,00", {reverse: true});
				</script>-->
		
		<p>
			<font face="calibri"><td>Retenciones Aplicadas:</td></font>
	   		<font face="calibri" color="red"> ISLR <input required  type="checkbox" name="rete" value="ISLR"></font>
			<font face="calibri" color="red"> IVA <input required  type="checkbox" name="rete" value="IVA"></font>
			<font face="calibri" color="red"> Impuesto Municipal <input required  type="checkbox" name="rete" value="Impuesto Municipal"></font>
			<font face="calibri" color="red"> Ninguna <input required type="checkbox" name="rete" value="Ninguna"></font>
		</div>
<hr color="green" size="5"/>
			<h3>INFORMACION FISCAL</h3>
	<div class="ss-item-required">
			<p>
				<font face="calibri"><b><td>Razon Social asociada al servicio:</td></b> </font>
				<input required name="nomcli" size="25" required placeholder="Nombre de su razon social"> <br/>
			</p>
			<p>
				<font face="calibri"><b><td>Rif / C.I:</td></b> </font>
				<select name="comboident" required>
					<option>Seleccione</option>
					<option>V</option>
					<option>J</option>
					<option>G</option>
					<option>E</option>
					<option>P</option>
				</select>
			<input required name="identificacion" onkeypress="return valida(event)" placeholder="Favor ingrese de identificación" size="25" maxlength="9"> <br/>
			</p>
			<p>
			<font face="calibri"><b><td>Correo:</td></b> </font>
			<input required name="correo" onclick="validarEmail(this.form.correo.value)" placeholder="Favor ingrese su correo electrónico" size="25"> <br/>
			</p>
			<p>
			
	<font face="calibri">Estado: <select style="width: 150px;" required name="estado" id="estado" onchange="change_select(this.id, 'municipio','list.php?ent=municipio');"></select></font>
	<font face="calibri">Municipio: <select style="width: 150px;" required name="municipio" id="municipio" onchange="change_select(this.id, 'parroquia','list.php?ent=parroquia');"></select></font>
	<font face="calibri">Parroquia: <select style="width: 150px;" required name="parroquia" id="parroquia"></select></font>
			<script type="text/javascript">
				$("#estado").chosen(); load_select("estado", "list.php?ent=estado"); $("#estado").val("1");
				$("#municipio").chosen(); //load_select("municipio", "list.php?ent=municipio"); 
				$("#parroquia").chosen(); //load_select("parroquia", "list.php?ent=parroquia"); 
	 			</script>
			</p>
			<font face="calibri"><b><td>Dirección Fiscal:</td></b></font>
			<br><textarea rows="10" cols="40" required="required" name="direccion" placeholder="Favor ingrese su dirección"></textarea></br>
		<p>
			<font face="calibri"><b><td>Telefono principal:</td> </font>
			<input type="tel" id="phone" name="tele1" required>
			<script>
  				$("#phone").intlTelInput({
  				utilsScript: "telefono/build/js/utils.js"});
  				</script>
  			<font face="calibri"><b><td>Telefono secundario:</td></font>
  			<input type="tel" id="phone2" name="tele2" >
			<script>
  				$("#phone2").intlTelInput({
  				utilsScript: "telefono/build/js/utils.js"});
  				</script>
				</p>
	</div>
<hr color="green" size="5" />

<div align="Center">
	<div class="g-recaptcha" data-sitekey="6Lc6-xQUAAAAAAQ_ChTk6o3DsIOQdm0gj3F_2fdW"></div>
	<input type="button" onclick="enviar()" value="Enviar información">
	<input type="reset" value="Borrar información">
</div>
</form>	