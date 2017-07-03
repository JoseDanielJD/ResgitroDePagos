<?php
	include 'conexion.php';

	$sql = NULL;
	switch($_GET["ent"]){
		case "estado":
			$sql = "SELECT id as val, nombre as txt FROM estado";
//			$fil = isset($_GET["fil"]) ? $_GET["fil"] : 1; // fil >> 1 = DTTO CAPITAL
//			$sql .= " WHERE id = $fil";
			$sql .= " ORDER BY id desc";
			break;
		case "municipio":
			$sql = "SELECT id as val, nombre as txt FROM municipio";
			$fil = isset($_GET["fil"]) ? $_GET["fil"] : 1; // fil >> 1 = DTTO CAPITAL
			$sql .= " WHERE estado_id = $fil";
			break;
		case "parroquia":
			$sql = "SELECT id as val, nombre as txt FROM parroquia";
			$fil = isset($_GET["fil"]) ? $_GET["fil"] : 1; // fil >> 1 = LIBERTADOR
			$sql .= " WHERE municipio_id = $fil";
			break;
	}

if (!is_null($sql))
{
	$result = mysql_query($sql);
	if ($result)
	{
		$info = array();
   		while($fila = mysql_fetch_assoc($result)) $info[] = $fila;	
   		echo json_encode($info);			
	}
}else{
	echo "error";
}
