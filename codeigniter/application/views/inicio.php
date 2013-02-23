<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>CFDI Fácil | Comprobante Fiscal Digital</title>
<meta name="description" content="CFDI Fácil es una empresa de tecnología de la Información que proporciona un Servicio de Facturación Electrónica rápido y sencillo, dándole una excelente experiencia al usuario al momento de realizar sus Facturas Electrónicas." /><meta name="keywords" content="factura electronica, CFD, CFDI, facturacion electronica, facturacion electronica en mexico, SAT, Proveedor Autorizado de certificacion, facturacion, CFDI facil" />
    <script type="text/javascript" src="<?php echo base_url();?>js/XMLWriter-1.0.0-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.8.18.custom.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>css/reset.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/redmond/jquery-ui-1.8.18.custom.css" type="text/css" charset="utf-8" />
    <link rel="shortcut icon" href="http://cfdifacil.mx/wp-content/uploads/2012/03/favicon.ico" />
    <script type="text/javascript">
        var base_url = "<?php echo base_url();?>";
    </script>
    <?php if(isset($head)){
    echo $head;
}?>

</head>
<body class="home">
<div id="inicio">

<div class="home-menu">
<a href="http://www.cfdifacil.mx" target="_blank" class="logo"></a>

<div id="nav">
    <?php
        echo anchor('/', 'Inicio'); ?> | <?php echo anchor('registro/add', 'Registrarse')?> | <?php echo anchor('registro/restart_password', 'Recuperar Contraseña');
    ?>
</div>

</div>
<div id="content">
<?php
// if there is any pagination display it.
if (isset($pagination) && !empty($pagination))
{
    echo '<div id="pagination">' . $pagination . '</div>';
}
?>
    <?php echo (isset($content)) ? $content : ''; ?>
</div>
</div>
<div id="footer">
<a href="mailto:contactanos@cfdifacil.mx">contactanos@cfdifacil.mx</a> | © 2012 CFDI Fácil, Todos los derechos reservados.
</div>
</body>
</html>