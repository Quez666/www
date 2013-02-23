<?php
/**
 * Created by JetBrains PhpStorm.
 * User: g3ck0
 * Date: 30/03/12
 * Time: 04:14 PM
 * To change this template use File | Settings | File Templates.
 */
if(isset($Mensaje_Resultado)){
    echo '<div class="error">'.$Mensaje_Resultado.'</div>';
}
echo validation_errors('<div class="error">','</div>');
echo form_open('inicio/index/').
    form_fieldset('Iniciar Sesión').
        '<div class="textfield">
            '.form_label('Usuario:', 'user_name').'
            '.form_input('user_name').'
        </div>
        <div class="textfield">
            '.form_label('Contraseña:', 'user_pass').'
            '.form_password('user_pass').'
        </div>

        <div class="buttons">
            '.form_submit('login', 'Accesar').'
        </div>';
echo form_fieldset_close();
echo form_close();