<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Adicionar Persona</title>
<script type="text/javascript" src="js/jquery-1.6.2.js"></script>
<script type="text/javascript">

 //He aqui la magia de AJAX gracias al Framework JQuery!
  $(document).ready(function(){
	  //programamos el vento click del boton enviar del formulario
	  $("#enviar").click(function() {
		  
		  //Variables del formulario
		  var ide=frm_add.identidad.value;
		  var nom=frm_add.nombres.value;
		  var ape=frm_add.apellidos.value;
		  var dir=frm_add.direccion.value;
		  var tc=frm_add.tel_cel.value;
		  //preguntamos si no hay campos vacios
		  if(ide!="" && nom!="" && ape!="" && dir!="" && tc!="")
		  {
		      //Enviamos mediante el metodo post de JQuery $.post("archivo.php",{parametros}, callback);
		      $.post("add_reg.php", {enviar:frm_add.enviar.value, identidad:ide, nombres:nom, apellidos:ape, direccion:dir, tel_cel:tc}, function(output){
			    //El parametro output, recibe como salida lo generado por el script php
				alert(output);
				//con esta linea limpiamos el formulario
				document.frm_add.reset();
		      });
		  }
		  else
		  {
			  alert("Existe algun campo vacio!");
		  }
	  });
  });
</script>
<style type="text/css">
 h3{
	 margin: 2px;
 }
</style>
</head>
<body>
 <h3>Formulario registro de Personas</h3>
 <form id="frm_add" name="frm_add" method="post">
   <table>
     <tr>
       <td><label>Identidad:</label></td>
       <td><input type="text" name="identidad" /></td>
     </tr>
     <tr>
       <td><label>Nombres:</label></td>
       <td><input type="text" name="nombres" /></td>
     </tr>
     <tr>
       <td><label>Apellidos:</label></td>
       <td><input type="text" name="apellidos" /></td>
     </tr>
     <tr>
       <td><label>Direccion:</label></td>
       <td><input type="text" name="direccion" /></td>
     </tr>
     <tr>
       <td><label>Telefono/Celular:</label></td>
       <td><input type="text" name="tel_cel" /></td>
     </tr>
     <tr>
       <td><input type="button" id="enviar" name="enviar" value="Guardar" /></td>
       <td><input type="reset" id="cancel" name="cancel" value="Cancelar" /></td>
     </tr>
   </table>
 </form>
</body>
</html>