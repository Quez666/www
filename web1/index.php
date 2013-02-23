<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Web de Prueba - Para principiantes en PHP y algo de Ajax</title>
<script type="text/javascript" src="js/jquery-1.6.2.js"></script>

<script type="text/javascript">
 //Aqui inicia algo interesante con JQUERY un framework de AJAX! :)
 
 //verificamos si el documento esta listo
 $(document).ready(function() {
	  //Codificamo el evento click de nuestro menu Adicionar
	  $("#add").click(function() {
		  //he aquie la linea que nos permite tomar el archivo adicionar.php
		  //y mandarlo a nuestro div de contenido
		  $("#contenido").load("adicionar.php").show();
	   });
	  
	  //Codificamos el evento click de nuestra opcion de menu Buscar
	  $("#search").click(function() {
		  //utilizamos el callback para determinar que no hayan errores
		  //donde response--> nos devuelve el contenido devuelto por php(lado del servidor)
		  //donde status--> nos dice que ha pasado con la solicitud a php(lado del servidor)
		  //donde xhr--> tipo de respuesta XmlHttpRequest
		  $("#contenido").load("buscar.php", function(response, status, xhr) {
			  if(status=="error") {
				   var msg = "Lo siento pero hay algun error: ";
				   $("#contenido").html(msg + xhr.status + " " + xhr.statusText);   
			   }
			   else
			    {
			       $("#contenido").html(response).show();
			    }
		  });
	  });
	  
	  //Codificamos el evento click de nuestra opcion de menu Borrar
	
	  $("#delete").click(function() {
		  //utilizamos el callback para determinar que no hayan errores
		  //donde response--> nos devuelve el contenido devuelto por php(lado del servidor)
		  //donde status--> nos dice que ha pasado con la solicitud a php(lado del servidor)
		  //donde xhr--> tipo de respuesta XmlHttpRequest
		  $("#contenido").load("borrar.php", function(response, status, xhr) {
			  if(status=="error") {
				   var msg = "Lo siento pero hay algun error: ";
				   $("#contenido").html(msg + xhr.status + " " + xhr.statusText);   
			   }
			   else
			    {
			       $("#contenido").html(response).show();
			    }
		  });
	  });
	  
	  $("#update").click(function() {
		  //utilizamos el callback para determinar que no hayan errores
		  //donde response--> nos devuelve el contenido devuelto por php(lado del servidor)
		  //donde status--> nos dice que ha pasado con la solicitud a php(lado del servidor)
		  //donde xhr--> tipo de respuesta XmlHttpRequest
		   $("#contenido").load("actualizar.php",function(response, status, xhr) {
			   if(status=="error") {
				   var msg = "Lo siento pero hay algun error: ";
				   $("#contenido").html(msg + xhr.status + " " + xhr.statusText);   
			   }
			   else
			   {
			       $("#contenido").html(response).show();
			   }
		   });
	  });
	  
	  $("#list").click(function() {
		  alert("Este codigo lo hacen ustedes es bien facil! :)");
	  });
	  
	  $("#topdf").click(function() {
		window.open("topdf.php","Reporte en PDF","location=1,status=1,scrollbars=1, width=600,height=600");
	  });
	  /*
	  $("#topdf").click(function() {
		   $("#contenido").hide();
		   //Mandamos css con multiples propiedades al estilo css
		   $('embed').css({'width':'600', 'height':'450' });
		   $('<embed src="topdf.php"></embed>').insertAfter('#contenido');
	  });*/
 });
</script>
<!-- Algo de CSS para personalizar la pagina -->
<style type="text/css">
  <!-- Personalizar el body de la pagina -->
  body {
	  background-color: #CCC;
	  font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif;
	  margin: 2px;
	  }
  
  .titulo{
	  background-color: #F0F7FC;
	  border: 2px #ACCFE8 groove;
	  text-align:center;
	  font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
	  font-size:16px;
	  font-style:oblique;
	  color: #3366CC;
	  background-image:url(img/images.jpg);
	  background-position:left top;
	  background-repeat:no-repeat;
	  height:75px;
	  width:auto;
	  margin:2px;
  }
  
  .menu
  {
	  width: 10%;
	  height: 50%;
	  border:4px #FFF groove;
	  margin: 2px;
	  background-color: #F90;
	  float:left;
	  text-align:center;
  }
  
  .comeciales{
	  margin:10px;
	  background-color:#F90;
	  border:2px #FFF groove;
	  width:10%;
	  height:50%;
	  
  }
  
  .contenido{
	  height:auto;
	  width:auto;
	  margin:2px;
	  float:left;
	  color: #3366CC;
	  text-align:center;
	  
  }
  #menuv
  {
        border: 2px solid #ACCFE8;
        border-width: 1px 1px 0 1px;
        width: 130px;
		font: 80% "Trebuchet MS", Arial, Helvetica, sans-serif;
		float:left;
		margin:2px;
   }

   #menuv ul, li {
        list-style-type: none;
   }

   #menuv ul {
        margin: 0;
        padding: 0;
    }

   #menuv li {
        border-bottom: 2px solid #ACCFE8;
    }

   #menuv a {
        text-decoration: none;
        color: #3366CC;
        background: #F0F7FC;
        display: block;
        padding: 6px 6px;
        width: 118px;
    }

    #menuv a:hover {
        background: #DBEBF6;
    }
	
	hr{
		border: 2px #ACCFE8;
	}
</style>
</head>

<body>
<!-- Titulo o encabezado -->
<div class="titulo">
 <h3>Mini - Sistema de ingreso de Personas</h3>
</div>
<hr>

<!-- Opciones de Menu -->
<div id="menuv">
  <ul>
      <li><a href="#menuv" id="add">Adicionar</a></li>
      <li><a href="#menuv" id="search">Buscar</a></li>
      <li><a href="#menuv" id="delete">Borrar</a></li>
      <li><a href="#menuv" id="update">Actualizar</a></li>
      <li><a href="#menuv" id="list">Listar</a></li>
      <li><a href="#menuv" id="topdf">Exportar a PDF</a></li>
      
  </ul>
</div>

<div class="contenido" id="contenido">
  Contenido: Sistema demostrativo basico para personas que desean aprender PHP y algo de AJAX elemental.
  
</div>
<!--
<div class="comeciales">
Comerciales
</div>
-->

</body>
</html>