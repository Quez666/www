<?php
/**
 * Pagina donde se dan de alta los nuevos usuarios
 */

include("config.inc.php");
include("validate.inc.php");

# Variable que contendra un posible error si el cliente no dispone de javascript activado
# en su navegador
$error="";
if($_POST["opc"])
{
	if(strlen($_POST["u"])>2 && strlen($_POST["p"])>5 && strlen($_POST["name"])>5)
	{
		# verificamos que el usuario no exista
		$result=mysql_query("select id from Users WHERE user='".addslashes($_POST["u"])."'",$link);
		if(mysql_num_rows($result))
		{
			$error="Este usuario ya existe en la base de datos";
		}else{
			# Añadimos el nuevo usuario
			$result=mysql_query("INSERT INTO Users (username,user,password) VALUES ('".addslashes($_POST["name"])."', '".addslashes($_POST["u"])."','".returnPass($_POST["p"])."')",$link);
			header("location:menu.php");
			return;
		}
	}else{
		$error="Todos los campos son obligatorios";
	}
}

include("header.inc.php");

include("menu.inc.php");
?>

<div class="round" style='margin:0 auto;width:400px;border:1px solid;padding:10px;margin-top:10px;'>
	<center>
	<h2>Añadir nuevo usuario</H2>
	<?php
	if($error)
		echo "<div class='error'>$error</div>";
	
	# Mostramos el formulario
	include("form.inc.php");
	?>
</div>

<?php
include("footer.inc.php");
?>
