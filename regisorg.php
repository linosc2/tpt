<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="js/jquery.1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.alerts.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="mapa.ico" type="image/x-icon" />
<link rel="stylesheet" href="css/style1.css" />
<title>TECHO PARA TODOS</title>
<style>
BODY{
font-family:Arial, Helvetica, sans-serif;
color:#02024d;
overflow-x: hidden;
}
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	color: #a41203;
	font-weight: bold;
	font-size: 20px;
}
.style2 {
	color: #02024d;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
/* INPUT */
input{
    font-size:12px;
    font-family: Arial, Helvetica, sans-serif;
    outline:none;
    transition: all 0.75s ease-in-out;
    -webkit-transition: all 0.75s ease-in-out;
    -moz-transition: all 0.75s ease-in-out;
    border-radius: 5px;
    -webkit-border-radius:5px;
    -moz-border-radius:5px;
    border:1px solid #02024d;
    color: #05369a;
    background-color: #d0e9fb;
    padding: 3px;
}
 
input:focus {
    box-shadow: 0 0 10px #aaa;
    -webkit-box-shadow: 0 0 10px #aaa;
    -moz-box-shadow: 0 0 10px #aaa;
    border:1px solid #a41203;
    background-color:white;
	color: #05369a;
}
/* END INPUT */

/* TEXTAREA */
textarea {
background-color: #d0e9fb;
font-family: Arial, Helvetica, sans-serif;
font-size: 12pt;
color: #05369a;
border: 1px solid #02024d;
}
textarea:focus {
        box-shadow: 0 0 10px #aaa;
    -webkit-box-shadow: 0 0 10px #aaa;
    -moz-box-shadow: 0 0 10px #aaa;
    border:1px solid #a41203;
    background-color:white;
	color: #05369a;
	}
.style4 {
	color: #02024d;
	font-size: 10px;
}
.style7 {font-size: 12}
.style8 {font-size: 12px}
.style9 {font-size: 10px}
</style>
</head>
<body>
<center>
<table align="center" width="800"><tr><td width="600" align="left"><img src="images/logotipo.png" width="158" height="60" /></td>
<td align="right"><table align="right"><tr><td align="right">
 <td><a href="https://www.facebook.com/joaedesign" target="_blank"><img src="images/face.png"></a></td>
<td><a href="https://twitter.com/joaedesign" target="_blank"><img src="images/twitter.png"></a></td>
<td><a href="http://www.youtube.com/joaesoftware" target="_blank"><img src="images/youtube.png"></a></td>
</tr></table></td>
</tr></table>
<script language="javascript" type="text/javascript">
function vacio(q)
{
	for ( i = 0; i < q.length; i++ )
	{
    	if ( q.charAt(i) != " " )
		{
        	return true
		}
	}
	return false
}
//valida que los campo no esten vacios y no tengan sólo espacios en blanco
function valida(regisorg)
{
	if ( vacio(regisorg.nombre.value) == false || (regisorg.descripcion.value) == false || (regisorg.email.value) == false || (regisorg.confirm_email.value) == false) 
	{
		jAlert("Existen campos obligatorios vacios. Compruebe que todos los campos están llenos.", "INFORMACION")
		return false
	}
	else
	{
    	//alert("OK")
			return true
	}
}
</script>
<br /><br /><br />
<div align="center" style="width:850px"><span class="style1">¿Quieres registrar a tu organización en TECHO PARA TODOS?</span>
<br>
<br>
<span class="style2">Entonces ingresa correctamente los datos de la organización y enseguida te haremos llegar un correo con la información para la activación de tu cuenta.</span></div>
<hr color="#baccda" width="850px">
<br />
<div align="center" style="width:850px">
<form name="regisorg" action="regisorg.php" method="post" onsubmit="return valida(this);">
<center><div id="message"></div></center><font face="Arial, Helvetica, sans-serif" size="3">

Nombre:<br /><input type="text" name="nombre" size="60" style="height:30px" value="<?php if (isset($_POST["nombre"])){ echo $_POST["nombre"];} ?>" />
<br /> <br />
Descripción:<br />                                
<textarea name="descripcion" rows="7" cols="45"><?php if (isset($_POST["descripcion"])){ echo $_POST["descripcion"];} ?></textarea>
<br /><br />                                 
Email:<br /></span> <input type="text" name="email" size="60" style="height:30px" value="<?php if (isset($_POST["email"])){ echo $_POST["email"];} ?>" />
<br />                                 <br />                                 
Confirmar email:<br /><input type="text" name="confirm_email" size="60" style="height:30px" value="<?php if (isset($_POST["confirm_email"])){ echo $_POST["confirm_email"];} ?>" />
 <br /><br />     
<label><input type="checkbox" name="terminos" value="acepto" /> 
</label>
</font><font face="Arial, Helvetica, sans-serif" style="font-weight:bold">
<label><span class="style24"><span class="style8">Acepto</span></span></label>
</font><font face="Arial, Helvetica, sans-serif" size="3" style="font-weight:bold">
<label> </label>
</font><font face="Arial, Helvetica, sans-serif" style="font-weight:bold">
<label><span class="style24 style7"><a href="#"><font style="text-decoration:underline">términos y condiciones</font></a></span></label>
</font><font face="Arial, Helvetica, sans-serif" size="3" style="font-weight:bold">
<br />
<br />
<?php
require('config.php');
$link=mysql_connect($sql_host,$sql_user,$sql_pass);
mysql_select_db($sql_db,$link);
$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$email=$_POST['email'];
$confirm_email=$_POST['confirm_email'];
$terminos=$_POST['terminos'];
if (strlen($nombre)==0)
{
}
else
{
function generateSalt($length=16) {
      $randstr='';
      srand((double)microtime()*1000000);
   
      $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      while(strlen($randstr)<$length) {
         $randstr.=substr($chars,(rand()%(strlen($chars))),1);
      } 
      return $randstr;
   }

            if(preg_match('/^([a-zA-Z0-9_\\.\\-])+\\@(([a-zA-Z0-9\\-])+\\.)+([a-zA-Z0-9]{2,4})+$/', $email)) {
			if(mysql_num_rows(mysql_query('SELECT correo FROM publico WHERE correo=\'' . mysql_real_escape_string($email) . '\'')) == 0) {
				if(mysql_num_rows(mysql_query('SELECT correo FROM organizacion WHERE correo=\'' . mysql_real_escape_string($email) . '\'')) == 0) {
								 if($email == $confirm_email) {
								 if (strlen($terminos) > 0){
              	$pass = rand(0,9).rand(100,9999).rand(100,9999).rand(100,9999);
				 $new_pass = generateSalt();
						
$personales= mysql_query('INSERT INTO organizacion (correo, nombre, descripcion, salt, password, terminos) VALUES (\'' . mysql_real_escape_string($email) . '\', \'' .  mysql_real_escape_string($nombre) . '\', \'' . $descripcion . '\', \'' . $new_pass . '\', \'' . crypt(md5($pass), '$1$'. $new_pass .'organizacion') . '\', \'' . $terminos . '\')');


require("includes/class.phpmailer.php");
$mail = new PHPMailer();

$mail->From     = "soporte.inkubame@inkuba.me";
$mail->FromName = "Administrador"; 
$mail->AddAddress ($email); // Dirección a la que llegaran los mensajes.

// Aquí van los datos que apareceran en el correo que reciba

$mail->WordWrap = 50; 
$mail->IsHTML(true);     
$mail->Subject  =  "Correo de activación y acceso al sitio Techo para todos";
$mail->Body     =  "<img src='http://www.inkuba.me/techoparatodos/images/logotipo.png' width='300' height='113' />".
    " \n<br /><br />".
    "<font face='Arial, Helvetica, sans-serif' size='2' style='font-weight:bold' color='#02024d'>".
	"Registrada con el Email: <font face='Arial, Helvetica, sans-serif' size='2' style='font-weight:bold' color='#0e77e2'><strong> $email </strong></font> \n<br />".
	"Su contraseña de acceso al panel de control es: <font face='Arial, Helvetica, sans-serif' size='2' style='font-weight:bold' color='#0e77e2'>$pass</font> \n<br />".
	"Se recomienda que cambie su contraseña al ingresar por primera vez. \n<br />".
	"</font>".

 ///Datos del servidor SMTP

    $mail->IsSMTP(); 
    $mail->Host = "mail.inkuba.me:2525";  // Servidor de Salida.
    $mail->SMTPAuth = true; 
    $mail->Username = "soporte.inkubame@inkuba.me";  // Correo Electrónico
    $mail->Password = "soporteinkubame"; // Contraseña

	$mail->Send();



?>	
<script language="javascript" type="text/javascript">
		jAlert("Registro Exitoso.", "INFORMACION");
		window.location="registro_exitoso.php";

</script>
<?php
} else {
                     		?>	
									<script language="javascript" type="text/javascript">
									var temp = document.getElementById('message');
									temp.innerHTML = "aun no acepta terminos y condiciones"
									</script>
					                <?php

                  		}
						} else {
                     		?>	
									<script language="javascript" type="text/javascript">
									var temp = document.getElementById('message');
									temp.innerHTML = "los correos no son iguales favor de verificar"
									</script>
					                <?php

                  		}

						} else {
                  			?>	
									<script language="javascript" type="text/javascript">
									var temp = document.getElementById('message');
									temp.innerHTML = "El correo ya existe"
									</script>
					                <?php
               			}
						} else {
                  			?>	
									<script language="javascript" type="text/javascript">
									var temp = document.getElementById('message');
									temp.innerHTML = "El correo ya existe"

									</script>
					                <?php
               			}

               		} else {
                  			?>	
									<script language="javascript" type="text/javascript">
									var temp = document.getElementById('message');
									temp.innerHTML = "Correo incorrecto EJEMPLO@CORREO.COM"

									</script>
					                <?php
               			}
echo "$pass";
}
?>	
                                    <input type="submit" name="enviar" value="Registrar" style="color: #a41203; border-color:#2677b5; background-color:#a0c3dd; font-size: 14px; cursor: pointer; height:40px; width:180px; font-weight:bold">
</font>         
</form>
<br>
<hr color="#baccda" width="850px">
<span class="style4">Copyright 2013 Todos los derechos reservados</span> <a href="http://www.joae.com.mx" target="_blank" class="style9"><font style="text-decoration:underline">JOAE</font></a></div>
</center>
</body>
</html>
