<?php
  require_once('conf.inc');
  //Nota: nunca jamas será buena idea utilizar el usuario y password del servidor
  //de MySql, cuando estemos creando nuestros scripts!
   //Nos conectamos a mysql
   $conn=mysql_connect(SERVER,DB_USER,DB_PASS) or die("Error de conexion: ".mysql_error());
   //Seleccionamos la base de datos
   mysql_select_db(DB,$conn) or die("Error al seleccionar DB: ".mysql_error());
?>