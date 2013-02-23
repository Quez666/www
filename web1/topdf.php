<?php require_once('conf/connection.php'); ?>

<?php
   $query_rsReportData = "SELECT * FROM personas order by identidad";
   $rsReportData = mysql_query($query_rsReportData, $conn) or die("Error en el query: ".mysql_error());
   $row_rsReportData = mysql_fetch_assoc($rsReportData);
   $totalRows_rsReportData = mysql_num_rows($rsReportData);
    //Verificamos que realmente hallan registros!
    if($totalRows_rsReportData>0)
	{
?>

<?php
   //El uso de PDF_LIB fue tomado del articulo: http://www.dmxzone.com/go?14269
   // creamos las instancia para el manejo de pdf() recuerden es la clase PDF()
   //con esto creamo un objeto que podemos manipular! :)
   $pdf = pdf_new();

   // abrimos el archivo de instancia
   pdf_open_file($pdf, "");

   //Adicionamos informacion de quien lo crea!
   pdf_set_info($pdf, "Author", "Web php de Ejemplo");
   pdf_set_info($pdf, "Title", "Reporte de Personas");
   pdf_set_info($pdf, "Creator", "Ustedes!");
   pdf_set_info($pdf, "Subject", "Reporte de Personas");

   // Dimensiones de pagina (A4)
   pdf_begin_page($pdf, 595, 842);

   //Ruta de directorio de fuentes
   $fontdir = "/media/0A0C68330C681C47/Windows/Fonts";

   // Abrimos las .TTFs (true type fonts)
   pdf_set_parameter($pdf, "FontOutline", "ArialItalic=$fontdir\ariali.ttf");
   pdf_set_parameter($pdf, "FontOutline", "ArialBold=$fontdir\ARIALBD.TTF");
   pdf_set_parameter($pdf, "FontOutline", "Arial=$fontdir\ARIAL.TTF");

   // ------ Empezamos a madar datos al PDF ------//
   // Establecemos la fuente - Arial Bold 15
   $font = pdf_findfont($pdf, "ArialBold", "host",0); pdf_setfont($pdf, $font, 15);  
   // Mandamos como salida al PDF el Titulo
   pdf_show_xy($pdf, "Reporte de Personas", 50, 788);
   // Dibujamos una linea
   pdf_moveto($pdf, 20, 780);
   pdf_lineto($pdf, 575, 780);
   pdf_stroke($pdf);

  // Establecemos una fuente Distinta para encabezado - Arial Italic 12
  $font = pdf_findfont($pdf, "ArialItalic", "host",0); pdf_setfont($pdf, $font, 12);
  $y = 750;
  // Mandamos al PDF el HEAD o cabezera
  pdf_show_xy($pdf, "Personas:", 50, $y);
  $y -= 5;

  // La fuente para el contenido general del PDF - Arial 10
  $font = pdf_findfont($pdf, "Arial", "host",0); pdf_setfont($pdf, $font, 10);

  // Mandamos la salida de la consulta al PDF
  $cadena="";
  do 
  {      $y -= 15;
         $cadena=$row_rsReportData['identidad'].", ".$row_rsReportData['nombres'].", ".$row_rsReportData['apellidos']." ";
	     $cadena.=$row_rsReportData['direccion'].", ".$row_rsReportData['tel_cel'];
         pdf_show_xy($pdf, $cadena, 50, $y);
  } 
  while ($row_rsReportData = mysql_fetch_assoc($rsReportData));

  // ------ Fin del contenido del PDF ------//

  // Fin de Pagina
  pdf_end_page($pdf);

  // Cerramos y a la vez se guarda el archivo
  pdf_close($pdf);

  //Obtenemos el buffer de datos del PDF
  $buf = pdf_get_buffer($pdf);
  //Calcaulamos el tamaño del buffer de datos
  $len = strlen($buf);

  //Cabezeras importanticimas para el tipo de MIME:
  header("Content-type: application/pdf");
  header("Content-Length: $len");
  header("Content-Disposition: inline; filename=report.pdf");
  //jaja mandamos el buffer de datos al explorador
  //y como ya mandamos anticipadamente el tipo de MIME que
  //debe interpretar reconocera que es de tipo: APPLICATION/PDF
  echo $buf;
  
  //Liberamos el objeto
  pdf_delete($pdf);
?>
<?php
   //Liberamos el resultado del query para no
   //sobrecargar el server!
   mysql_free_result($rsReportData);
  }
  else
  {
	  echo "No hay registros, por lo tanto imposible generar archivo PDF :(!";
  }
?>