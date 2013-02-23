<?php
   //Invocamos o cargamos el escript de conexion
   require_once("conf/connection.php");
   
   //Cargamos las variables con los datos proporcionados si existen!
  $patron=stripslashes($_POST["patron"]);
  $opcion=stripslashes($_POST["opcion"]);
  
   //Si nos mandaron datos?
   if(isset($patron) && isset($opcion))
   {
	   //Si patron=1 entonces la busqueda sera por la identidad
	   if($opcion==1)
	   {
		   //El asteriscon el la consulta indica todos los campos de la tabla personas
		   //el operador like indica que sera un patron de cadena a buscar
		   //para encontrar una coincidencia!
		   $buscar='select * from personas where identidad like \'%'.$patron.'%\'';
		   $r=mysql_query($buscar,$conn) or die("Error en el query: ".mysql_error());
		   $n=mysql_num_rows($r);
		    //si hay registros los procesamos
			if($n>0)
			{
				//recorremos el listado de registros mediante un while
				//tomando los datos del mysql_query y procesarlos como arreglos
				//mediante mysql_fetch_assoc()!
				
				echo "<table border=\"1\">";
				echo "<tr>";
				 echo "<td>IDENTIDAD</td>";
				 echo "<td>NOMBRES</td>";
				 echo "<td>APELLIDOS</td>";
				 echo "<td>DIRECCION</td>";
				 echo "<td>TEL_CEL</td>";
				echo "</tr>";
				while($row=mysql_fetch_assoc($r))
				{
					//Procesamos cada registro como una fila de tabla
					echo "<tr>";
					//$row["nomCampo"] estos nomCampo son los campos devueltos por el
					//query en la variable $r que procesa mysql_fetch_assoc
					 echo "<td>".$row["identidad"]."</td>";
					 echo "<td>".$row["nombres"]."</td>";
					 echo "<td>".$row["apellidos"]."</td>";
					 echo "<td>".$row["direccion"]."</td>";
					 echo "<td>".$row["tel_cel"]."</td>";
					echo "</tr>";
				}
				echo "</table><br>Resultados!";
			}
			else
			{
				echo "No hubieron coincidencias!";
			}
	   }
	   
	  //Si patron=2 entonces la busqueda sera por la nombres
	   if($opcion==2)
	   {
		   $patron=strtoupper($patron);
		   //El asteriscon el la consulta indica todos los campos de la tabla personas
		   //el operador like indica que sera un patron de cadena a buscar
		   //para encontrar una coincidencia!
		   $buscar="select * from personas where ucase(nombres) like \"%$patron%\"";
		   $r=mysql_query($buscar,$conn) or die("Error en el query: ".mysql_error());
		   $n=mysql_num_rows($r);
		    //si hay registros los procesamos
			if($n>0)
			{
				//recorremos el listado de registros mediante un while
				//tomando los datos del mysql_query y procesarlos como arreglos
				//mediante mysql_fetch_assoc()!
				
				echo "<table border=\"1\">";
				echo "<tr>";
				 echo "<td>NOMBRES</td>";
				 echo "<td>APELLIDOS</td>";
				 echo "<td>DIRECCION</td>";
				 echo "<td>TEL_CEL</td>";
				 echo "<td>IDENTIDAD</td>";
				echo "</tr>";
				while($row=mysql_fetch_assoc($r))
				{
					//Procesamos cada registro como una fila de tabla
					echo "<tr>";
					//$row["nomCampo"] estos nomCampo son los campos devueltos por el
					//query en la variable $r que procesa mysql_fetch_assoc
					 echo "<td>".$row["nombres"]."</td>";
					 echo "<td>".$row["apellidos"]."</td>";
					 echo "<td>".$row["direccion"]."</td>";
					 echo "<td>".$row["tel_cel"]."</td>";
					 echo "<td>".$row["identidad"]."</td>";
					echo "</tr>";
				}
				echo "</table><br>Resultados!";
			}
			else
			{
				echo "No hubieron coincidencias!";
			}
	   }
	   
	   //Si patron=3 entonces la busqueda sera por la apellidos
	   if($opcion==3)
	   {
		   $patron=strtoupper($patron);
		   //El asteriscon el la consulta indica todos los campos de la tabla personas
		   //el operador like indica que sera un patron de cadena a buscar
		   //para encontrar una coincidencia!
		   $buscar="select * from personas where upper(apellidos) like \"%$patron%\"";
		   $r=mysql_query($buscar,$conn) or die("Error en el query: ".mysql_error());
		   $n=mysql_num_rows($r);
		    //si hay registros los procesamos
			if($n>0)
			{
				//recorremos el listado de registros mediante un while
				//tomando los datos del mysql_query y procesarlos como arreglos
				//mediante mysql_fetch_assoc()!
				
				echo "<table border=\"1\">";
				echo "<tr>";
				 echo "<td>APELLIDOS</td>";
				 echo "<td>NOMBRES</td>";
				 echo "<td>DIRECCION</td>";
				 echo "<td>TEL_CEL</td>";
				 echo "<td>IDENTIDAD</td>";
				echo "</tr>";
				while($row=mysql_fetch_assoc($r))
				{
					//Procesamos cada registro como una fila de tabla
					echo "<tr>";
					//$row["nomCampo"] estos nomCampo son los campos devueltos por el
					//query en la variable $r que procesa mysql_fetch_assoc
					 echo "<td>".$row["apellidos"]."</td>";
					 echo "<td>".$row["nombres"]."</td>";
					 echo "<td>".$row["direccion"]."</td>";
					 echo "<td>".$row["tel_cel"]."</td>";
					 echo "<td>".$row["identidad"]."</td>";
					echo "</tr>";
				}
				echo "</table><br>Resultados!";
			}
			else
			{
				echo "No hubieron coincidencias!";
			}
	   }
   }
    else
   {
	   echo "No han sido enviados datos para consultar aun!";
   }
?>