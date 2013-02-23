<?php
   //solicitamos archivo de conexion a mysql
   require_once('conf/connection.php');
   //si an pulsado el boton de enviar
  $enviar=$_POST["enviar"];
  if(isset($enviar))
  {
	  //grupo de variables enviadas mediante metodo post desde el formulario
	  $identidad=stripslashes($_POST["identidad"]);
	  $nombres=stripslashes($_POST["nombres"]);
	  $apellidos=stripslashes($_POST["apellidos"]);
	  $direccion=stripslashes($_POST["direccion"]);
	  $tel_cel=stripslashes($_POST["tel_cel"]);
	  
	  //comprobamos si la identidad personal de esta persona existe
	  //si existiera no haremos nada!. Mediante un query
	  $comprobar="select * from personas where identidad=\"$identidad\"";
	  //Enviamos el query a Mysql mediante la funcion de PHP mysql_query()
	  $r_ide=mysql_query($comprobar,$conn) or die("Error en el query: ".mysql_error());
	  //Vemos si el query nos mando registros y cuantos mediante mysql_num_rows()
	  $nr_ide=mysql_num_rows($r_ide);
	    //Es decir si devolvio registros
		if($nr_ide>0)
		{
			//Mandamos un script java con notificacion
			echo "Esta identidad: $identidad ya existe!";
		}
		//procedemos a guardar el registro
		else
		{
			//Construimos el query!
			$insertar="insert into personas(identidad, nombres, apellidos, direccion, tel_cel) values (";
			$insertar.="\"$identidad\", \"$nombres\", \"$apellidos\", \"$direccion\", \"$tel_cel\")";
			//enviamos el query mediante la funcion mysql_query()
			mysql_query($insertar, $conn) or die("Error en el query: ".mysql_error());
			mysql_close($conn);
			echo "Registro almacenado con exito!";
		}
  }
  //si no han pulsado el bonton enviar, suponemos que han cargado el archivo adicionar.php
  //y se mostrara el formulario! :)
  else
  {
	  echo "Intento ilegal de llamar al SCRIPT!";
  }
?>