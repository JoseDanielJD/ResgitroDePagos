<?php

function getArrayFromSql($sql, $dblink = NULL){
        global $DAYCOPASS_DB;
        $dblink = is_null($dblink) ? $DAYCOPASS_DB : $dblink;
        $resultado = $dblink->query($sql) or doDie($dblink->error);
        $info = array();
        while($fila = $resultado->fetch_assoc()) $info[] = $fila;
        return $info;
}

$enlace =  mysql_connect("localhost", "registro", "Dayco2017");
			mysql_select_db("daycohost");
if (!$enlace) {
    die('No pudo conectarse: ' . mysql_error());
}
//echo 'Conectado satisfactoriamente';
//mysql_close($enlace);
?>