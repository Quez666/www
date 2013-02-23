<?php
   require_once('conf/connection.php');
  //si alguien pulso algun boton borrar jajaja te fuistes marcelino
  //es decir elimina el registro! uppssss :(
  if(isset($_POST["borrar"]))
  {
	  $id=stripslashes($_POST["ide"]);
	  $del="delete from personas where identidad=\"$id\" limit 1";
	  mysql_query($del,$conn) or die("Error en el query: ".mysql_error());
	  echo "Registro eliminado con exito!";
  }
  //Mostramos los registros con el boton borrar
  else
  {
	  //Creamos el query para mostrar los registros! jajaja
	  $sql="select * from personas order by identidad";
	  $r=mysql_query($sql,$conn) or die("Error en el query: ".mysql_error());
	  $n=mysql_num_rows($r);
	    //hay registros si $n>0
	    if($n>0)
		{
			//Codigo embedido de html en PHP gracias Rasmus por este potente PHP!
        	  while($rw=mysql_fetch_assoc($r))
			   {
				   echo "<form method=\"post\" action=\"borrar.php\">";
			       echo "<table border=\"1\">";
				   echo "<tr>";
				    echo "<td>".$rw["identidad"]."</td>";
					echo "<td>".$rw["nombres"]."</td>";
					echo "<td>".$rw["apellidos"]."</td>";
					echo "<td>".$rw["direccion"]."</td>";
					echo "<td>".$rw["tel_cel"]."</td>";
					echo "<td><input type=\"submit\" name=\"borrar\" value=\"Borrar\"></td>";
					echo "<td><input type=\"hidden\" name=\"ide\" value=\"".$rw["identidad"]."\"></td>";
				   echo "</tr>";
				  echo "</table></form>";
			   }
			   
			   mysql_free_result($r);
		}
		else
		{
			echo "No se encontraron registros!";
		}

	   }
?>