<?php
/**
 * Pantalla inicial donde se muestra el listado de usuarios
 */

include("config.inc.php");
include("validate.inc.php");

include("header.inc.php");

$error="";
if($_GET["id"])
{
	# revisamos que el usuario a eliminar no sea el que esta activo
	if($_GET["id"]!=$_SESSION["id"])
	{
		# Eliminamos un usuario
		$result=mysql_query("DELETE FROM Users WHERE id=".$_GET["id"],$link);
	}else{
		$error="No se puede eliminar el usuario que esta activo";
	}
}

include("menu.inc.php");
?>

<div style="margin:0 auto;width:550px;">

<?php
if($error)
	echo "<div class='error'>$error</div>";

if(!$_GET["pagina"])
	$_GET["pagina"]=1;

# Titulos del listado
echo "<div class='row rowTitle'>";
	echo "<div class='delete'></div>";
	echo "<div class='update'></div>";
	echo "<div class='name'>Nombre</div>";
	echo "<div class='user'>Usuario</div>";
echo "</div>";

# obtenemos el total de registros de la base de datos
$result=mysql_query("SELECT count(*) as Total FROM Users",$link);
$row=mysql_fetch_array($result);
$totalRegistros=$row["Total"];

# realizamos un bucle por toda la base de datos para mostrar todos los registros
$result=mysql_query("SELECT * FROM Users LIMIT ".($numeroRegistros*($_GET["pagina"]-1)).", ".$numeroRegistros,$link);
while($row=mysql_fetch_array($result))
{
	echo "<div class='row'>";
		echo "<div class='delete'><a href='menu.php?id=".$row["id"]."'>Eliminar</a></div>";
		echo "<div class='update'><a href='update.php?id=".$row["id"]."'>Modificar</a></div>";
		echo "<div class='name'>".$row["username"]."</div>";
		echo "<div class='user'>".$row["user"]."</div>";
	echo "</div>";
}

# se llama a la funcion que pagina el listado
paginacion($totalRegistros,$numeroRegistros,$_GET["pagina"]);
?>

</div>

<?php
include("footer.inc.php");

/**
 * Funcion que nos realiza la paginacion, mostrandonos todos los valores
 * y las flechas de siguiente y anterior
 *	$fields				= Numero de registros
 *	$fielsView			= Numero de registros a mostrar
 *	$pagina				= Numero de la pagina actual a mostrar
 *	$totalNumbersView	= Determina el total de numeros a visualizar por pagina.
 *						Tiene que ser un valor entero y par
 */
function paginacion($fields,$fielsView,$pagina=0,$totalNumbersView=10)
{
	if($fields>$fielsView)
	{
		echo "<div style='text-align:center;margin-top:10px;'>";
			# Mostramos anterior y inicio
			if($pagina>1)
			{
				echo "<a href='".$_SERVER["PHP_SELF"]."?pagina=1' class='pageOk'>Inicio</a>";
				echo "<a href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina-1)."' class='pageOk'>Anterior</a>";
			}else{
				echo "<span class='pageKo'>Inicio</span><span class='pageKo'>Anterior</span>";
			}
			
			# Mostramos los valores intermedios
			$totalPage=ceil($fields/$fielsView);
			$pageStart=1;
			$pageEnd=$totalPage;
			if($totalPage>$totalNumbersView)
			{
				# Si estamos en una posicion superior a la pagina 10...
				if($page>($totalNumbersView/2))
					$pageStart=$page-($totalNumbersView/2);
				# Si la pagina actual + 10 es inferior al total...
				if($page+($totalNumbersView/2)<$totalPage)
					$pageEnd=$page+($totalNumbersView/2);
			}
			if($pageEnd-$pageStart<$totalNumbersView && $totalPage>$totalNumbersView)
			{
				if($pageStart==1)
					$pageEnd=$page+($totalNumbersView/2)+(($totalNumbersView/2)-$page)+1;
				if($pageEnd==$totalPage)
					$pageStart=$page-($totalNumbersView/2)-(($page-$totalPage)+($totalNumbersView/2));
			}

			# Mostramos los numeros de de paginas
			for($i=$pageStart;$i<=$pageEnd;$i++)
			{
				if ($i==$pagina)
					echo "<span class='pageSelect'> ".$i." </span>";
				else{
					echo "<a href='".$_SERVER["PHP_SELF"]."?pagina=".$i."' class='pageOk'>".$i."</a>";
				}
			}
			
			# Mostramos siguiente y fin
			if($pagina<$totalPage)
			{
				echo "<a href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina+1)."' class='pageOk'>Siguiente</a>";
				echo "<a href='".$_SERVER["PHP_SELF"]."?pagina=".$totalPage."' class='pageOk'>Final</a>";
			}else{
				echo "<span class='pageKo'>Siguiente</span><span class='pageKo'>Final</span>";
			}
		echo "</div>";
	}
}
?>
