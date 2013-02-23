<?php
  require_once('conf/connection.php');
  //Actualizamos la data
  if(isset($_POST["actual"]))
  {
	 $act="update personas set nombres=\"".$_POST["nom"]."\", apellidos=\"".$_POST["ape"]."\", direccion=\"".$_POST["dir"]."\", tel_cel=\"";
	 $act.=$_POST["tel"]."\" where identidad=\"".$_POST["ide"]."\"";
	 mysql_query($act,$conn) or die("Error en el query: ".mysql_error());
	  echo "
	      <script>
		     document.location.reload(true);
		  </script>
	  "; 
  }
  //Mostramos el formualrio con los datos a modificar
  else
  {
	  $sql="select * from personas order by identidad";
	  $r=mysql_query($sql,$conn) or die("Error del query: ".mysql_error());
	  $n=mysql_num_rows($r);
	   
	   if($r>0)
	   {
		   while($rw=mysql_fetch_assoc($r))
		   {
			   echo "<form method=\"post\" action=\"actualizar.php\">";
			   echo "<table border=\"1\">";
			    echo "<tr>";
				 echo "<td><input type=\"text\" name=\"ide\" value=\"".$rw["identidad"]."\"></td>";
				 echo "<td><input type=\"text\" name=\"nom\" value=\"".$rw["nombres"]."\"></td>";
				 echo "<td><input type=\"text\" name=\"ape\" value=\"".$rw["apellidos"]."\"></td>";
				 echo "<td><input type=\"text\" name=\"dir\" value=\"".$rw["direccion"]."\"></td>";
				 echo "<td><input type=\"text\" name=\"tel\" value=\"".$rw["tel_cel"]."\"></td>";
				 echo "<td><input type=\"submit\" name=\"actual\" value=\"Actualizar\"></td>";
				echo "<tr>";
			   echo "</table></form>"; 
		   }
	   }
	   else
	   {
		   echo "No hay registros!";
	   }
  }
?>