<?php
/**
 * Parte superior de la pantalla que aparece en todas las paginas una vez estas
 * validado. Contiene las opciones del menu.
 */
?>
<div class='roundBottom' style='display:table;clear:both;width:100%;border:0px solid;padding:10px;background-color:#d0d0d0;'>
	<div style='clear:both;'>
		<div style='float:right;margin-bottom:10px;'>
			Usuario: <b><?php echo $_SESSION["name"]?></b>
		</div>
	</div>
	<div style='clear:both;'>
		<div style='float:left;'>
			<a href='add.php' class='link'>Añadir nuevo usuario</a>
		</div>
		<div style='float:right;'>
			<a href='index.php' class='link'>Salir</a>
		</div>
	</div>
</div>
