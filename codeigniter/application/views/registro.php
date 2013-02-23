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
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.qtip.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>css/reset.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" charset="utf-8" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/redmond/jquery-ui-1.8.18.custom.css" type="text/css" charset="utf-8" />
    <link rel="shortcut icon" href="http://cfdifacil.mx/wp-content/uploads/2012/03/favicon.ico" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/jquery.qtip.css" type="text/css" charset="utf-8" />  
    <script type="text/javascript">
        var base_url = "<?php echo base_url();?>index.php/";
    </script>
    <?php if(isset($head)){
        echo $head;
    }?>
<script type="text/javascript" charset="utf-8">
$(function(){
	$('#menu li a').click(function(event){
		var elem = $(this).next();
		if(elem.is('ul')){
			event.preventDefault();
			$('#menu ul:visible').not(elem).slideUp();
			elem.slideToggle();
		}
	});
});
</script>
<script type="text/javascript">
$(document).ready(function(){

	$("ul.subnav").parent().append("<span></span>");
	$("ul.topnav li span").click(function() {

		//Following events are applied to the subnav itself (moving subnav up and down)
		$(this).parent().find("ul.subnav").slideDown('slow').show(); //Drop down the subnav on click

		$(this).parent().hover(function() {
		}, function(){
			$(this).parent().find("ul.subnav").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up
		});

		//Following events are applied to the trigger (Hover events for the trigger)
		}).hover(function() {
			$(this).addClass("subhover"); //On hover over, add class "subhover"
		}, function(){	//On Hover Out
			$(this).removeClass("subhover"); //On hover out, remove class "subhover"
	});

});

</script>

<script type="text/javascript" class="example">
$(document).ready(function()
{
	$('.tooltip').qtip({
		content: {
		attr: 'alt'
	},
		position: {
			my: 'bottom left',
			target: 'mouse',
			viewport: $(window), // Keep it on-screen at all times if possible
			adjust: {
				x: 10,  y: 00
			}
		},
		hide: {
			fixed: true // Helps to prevent the tooltip from hiding ocassionally when tracking!
		},
		style: 'ui-tooltip-cream'
	});
});
</script>

</head>
<body>
<div id="header"><a href="http://www.cfdifacil.mx" target="_blank" class="logo"></a></div>

<?php
    if(isset($nav))
    {
        echo $nav;
    }
    else
    {
        echo '<div id="nav">';
        echo anchor('/', 'Inicio'); ?> | <?php echo anchor('registro/add', 'Registrarse')?> | <?php echo anchor('registro/restart_password', 'Recuperar Contraseña');
        echo '</div>';
    }
?>

<div id="content">
<div class="center">
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

</div>
</body>
</html>