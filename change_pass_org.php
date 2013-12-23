<?php
session_start();
if(!isset($_SESSION["login"])){
header("location:index.php");
} else {
require('config.php');
$link=mysql_connect($sql_host,$sql_user,$sql_pass);
mysql_select_db($sql_db,$link);
$login=$_SESSION["login"];

$consulta=mysql_query('SELECT * FROM organizacion WHERE correo=\'' . mysql_real_escape_string($login) . '\'');
///$query=mysql_query($consulta,$link);
while($row = mysql_fetch_array($consulta))
{
$pass=$row["password"];
$salt=$row["salt"];

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Techo para todos</title>
<style type="text/css">
<!--
BODY{
font-family:Arial, Helvetica, sans-serif;
color:#02024d;
overflow-x: hidden;
}
/* INPUT */
input{
    font-size:12px;
	height:30px;
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
background: #eee;
font-family: Arial, Helvetica, sans-serif;
font-size: 10pt;
color: #666666;
border: 1px solid #cccccc;
}
textarea:focus {
        background-color:white;
        border:1px solid #a41203;
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
	font-size: 12px;
}
-->
</style>
</head>

<body>
<br>
<center>
<div align="center"><span class="style1">Cambiar password</span>
</div><br>
<span class="style2">En este apartado podrás cambiar tu password, solo tendrás que ingresar tu antigua contraseña y la nueva. Tu nueva contraseña podrá ser utilizada la próxima ves que inicies sesión.</span>
<hr color="#baccda">
<br><br>
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

function valida(incuvame)
{
	if ( vacio(incuvame.contrasena1.value) == false || (incuvame.contrasena2.value) == false || (incuvame.contrasena3.value) == false)
	{
		jAlert("Existen campos obligatorios vacios. Compruebe que todos los campos están llenos.", "INFORMACION");
		return false
	}
	else
	{
		
		return true
		
	}
}
</script>
<form name="editar" action="change_pass_org.php" method="post" onSubmit="return valida(this);">
<center><div id="message"></div></center>
<font face="Arial, Helvetica, sans-serif" size="2">
   Contrase&ntilde;a Anterior: </br><input type="password" name="contrasena1"  size="50"/>
     </br></br>
       Nueva contrase&ntilde;a: </br><input type="password" name="contrasena2" size="50" />
</br></br>
Confirmar contrase&ntilde;a: </br><input type="password" name="contrasena3" size="50" />
</br></br>
                                                                                              <input name="submit" type="submit" class="boton" value="Cambiar" style="color: #a41203; border-color:#2677b5; background-color:#a0c3dd; font-size: 14px; cursor: pointer; height:40px; width:180px; font-weight:bold" />																																										
</font></form>

<?php

$contrasena1= $_POST['contrasena1'];
$contrasena2=$_POST['contrasena2'];
$contrasena3=$_POST['contrasena3'];
if ($contrasena1=="")
{
}
else
{
$contrasena = crypt(md5($contrasena1), '$1$'. $salt .'organizacion');
if(mysql_num_rows(mysql_query('SELECT * FROM organizacion WHERE correo=\'' . mysql_real_escape_string($login) . '\' AND password=\'' . mysql_real_escape_string($contrasena) . '\'')) == 1) {
            if($contrasena2 == $contrasena3) {
				if(strlen($contrasena2) >= 5 && strlen($contrasena2) <= 20) {
				
				function generateSalt($length=16) {
      			$randstr='';
      			srand((double)microtime()*1000000);
   				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      			while(strlen($randstr)<$length) {
         		$randstr.=substr($chars,(rand()%(strlen($chars))),1);
      			} 
      			return $randstr;
   				}
				
				
				
				$new_pass = generateSalt();
				
				$result = mysql_query('UPDATE organizacion SET password=\'' . crypt(md5($contrasena2), '$1$'. $new_pass .'organizacion') . '\', salt=\'' . $new_pass . '\' WHERE correo=\'' . mysql_real_escape_string($login) . '\''); 
				
?>	
<script language="javascript" type="text/javascript">
		window.location="change_pass.php";
</script>
<?php
						
               		} else {
                  			?>	
									<script language="javascript" type="text/javascript">
									var temp = document.getElementById('message');
									temp.innerHTML = "Contrase&ntilde;a debe ser de 6 a 20 caracteres."

									</script>
							<?php
               			}
			   } else {
                  ?>	

									<script language="javascript" type="text/javascript">
									
									var temp = document.getElementById('message');
									temp.innerHTML = "Contrase&ntilde;a no coinciden."

									</script>
							<?php
               }
            	
			} else {
               ?>	
									<script language="javascript" type="text/javascript">
									var temp = document.getElementById('message');
									temp.innerHTML = "Contrase&ntilde;a anterior invalida."

									</script>
							<?php   
            }
         
	}
?>
</center>
</body>
</html>
<?php
}
?>	