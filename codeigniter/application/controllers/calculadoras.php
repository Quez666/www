<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calculadoras extends CI_Controller {
	
    
	public function ieps($vlitro=11.30,$nlitros=20,$Viva=.16)//parametros que recibira
	{
		$ieps=.0166;
		$subtotal=(($vlitro+$ieps)*$nlitros);//inicio de formula para calcular el ieps
		$iva=(($vlitro*$nlitros)*$Viva);
		$total=($subtotal+$iva);
		 echo $total;
	}
}

    