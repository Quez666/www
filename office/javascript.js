<!--
/**
 * Funcion que valida que el contenido del formulario sea correcto
 */
function validateForm()
{
	// cogemos los valores del formulario
	var username=document.getElementById("username").value;
	var user=document.getElementById("user").value;
	var password=document.getElementById("password").value;
	
	// revisamos que existe un nombre de usuario de al menos tres caracteres
	var usernameOk=0;
	if(username.length>2)
	{
		usernameOk=1;
		document.getElementById("eusername").style.display="none";
	}else{
		document.getElementById("eusername").innerHTML="El nombre tiene que tener un minimo de 3 caracteres";
		document.getElementById("eusername").style.display="block";
	}
	
	// revisamos que el usuario de acceso tenga un minimo de 6 caracteres
	var userOk=0;
	if(user.length>5)
	{
		userOk=1;
		document.getElementById("euser").style.display="none";
	}else{
		document.getElementById("euser").innerHTML="El usuario de acceso tiene que tener un minimo de 6 caracteres";
		document.getElementById("euser").style.display="block";
	}
	
	// revisamos que la contraseña de acceso tengo un minimo de 6 caracteres
	var passOk=0;
	if(password.length>5)
	{
		passOk=1;
		document.getElementById("epassword").style.display="none";
	}else{
		document.getElementById("epassword").innerHTML="La contraseña de acceso tiene que tener un minimo de 6 caracteres";
		document.getElementById("epassword").style.display="block";
	}
	
	if(usernameOk==1 && userOk==1 && passOk==1)
		return true;
	return false;
}
-->