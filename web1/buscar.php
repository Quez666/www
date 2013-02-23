<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Busqueda de persona iteractiva</title>
<script type="text/javascript" src="js/jquery-1.6.2.js"></script>
<script type="text/javascript">
  //Preguntamos si todos los objeto del DOM de la pagina estan listos
  $(document).ready(function(){
	  //programamos el evento keyup del text [pat]
	  $("#pat").keyup(function(){
		  //Mandamos mediante post al archivo PHP los valores del Formulario
		  $.post("search.php", {patron:frm_sch.pat.value, opcion:$("input[@name='rd1']:checked").val()}, function(result) {
			   //Lo devuelto por el parametro [result] lo escribimos en el div de resultado mediante el metodo html
			  $("#resultado").html(result).show();
		  });
	  });
  });
</script>
</head>
<body>
<h3>Busqueda iteractiva segun opcion</h3>
  <!--En el formulario no es necesario especificar el action ya que lo haremos por JQuery -->
  <form id="frm_sch" name="frm_sch">
    <table>
      <tr>
       <td>Buscar por:</td>
      </tr>
      <tr>
        <td><label>Identidad</label></td>
        <td><input type="radio" id="rd1" name="rd1" value="1"</td>
      </tr>
      <tr>
        <td><label>Nombres</label></td>
        <td><input type="radio" id="rd1" name="rd1" value="2"</td>
      </tr>
      <tr>
        <td><label>Apellidos</label></td>
        <td><input type="radio" id="rd1" name="rd1" value="3"</td>
      </tr>
      <tr>
        <td><label>Patron de busqueda: </label></td>
        <td><input type="text" id="pat" name="pat"</td>
      </tr>
    </table>
  </form>
  <!-- En este div mandaremos el resultado de los patrones de busqueda -->
  <div id="resultado">
  </div>
</body>
</html>