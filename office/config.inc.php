<?php
/**
 * Fichero de configuración, que se incluye en cada una de las paginas.
 * Realiza la conexion a la base de datos y contiene algunas funciones
 */

session_start();

$conf_dom="localhost";
$conf_usr="root";
$conf_pas="toor";
$conf_db="db_per";

# determina el total de registros a mostrar por pagina en el listado de usuarios
$numeroRegistros=10;

# conectamos con la base de datos
$link=mysql_connect($conf_dom,$conf_usr,$conf_pas);
if(!$link)
{
	exit("No hay connexion con la base de datos: ".mysql_error());
}
# conectamos con la tabla
$db_selected=mysql_select_db($conf_db, $link);
if(!$db_selected)
{
	exit("No existe la base de datos: ".mysql_error());
}

/**
 * Funcion que codifica una contraseña en md5 utilizando una semilla
 * Tiene que recibir la contraseña en claro
 * Devuelve la contraseña codificafa en md5 con semilla
 */
function returnPass($passwordUser)
{
	$seed="LaCasaAzul";
	return md5($passwordUser.$seed);
}
?>
