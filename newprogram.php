<?php 
session_start();
if(!isset($_SESSION["login"])){
header("location:index.php");
} else {
/* Cerramos la parte de codigo PHP porque vamos a escribir bastante HTML y nos será mas cómodo así que metiendo echo's */
 
require('config.php');
$link=mysql_connect($sql_host,$sql_user,$sql_pass);
mysql_select_db($sql_db,$link);
$login=$_SESSION["login"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <title>Techo para todos</title>
 <style type="text/css">
<!--
-->
BODY{
font-family:Arial, Helvetica, sans-serif;
color:#02024d;
overflow-x: hidden;
}
/* INPUT */
input{
    font-size:12px;
	height:35px;
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
font-family: Arial, Helvetica, sans-serif;
font-size: 12px;
border:1px solid #02024d;
    color: #05369a;
    background-color: #d0e9fb;
}
textarea:focus {
       box-shadow: 0 0 10px #aaa;
    -webkit-box-shadow: 0 0 10px #aaa;
    -moz-box-shadow: 0 0 10px #aaa;
    border:1px solid #a41203;
    background-color:white;
	color: #05369a;
	}
.style6 {
	color: #a41203;
	font-size: 20px;
	font-weight: bold;
}
 </style>
</head>
<body>

<div id="cm-example6" style="width:700px;height:400px;border:2px solid #2677b5;margin:6px 0 6px 0;"></div>
<script type="text/javascript">
	function mapawms6(){
    var cloudmade = new CM.Tiles.CloudMade.Web({key: '6a72e3fb4fe14ed6b36bb447b2c2d940'});
    var map = new CM.Map('cm-example6', cloudmade);
    map.setCenter(new CM.LatLng(23.0797, -103.5352), 5);
		
	function displayMessage(msg) {
	document.getElementById('mensaje').value = msg;
}
    
CM.Event.addListener(map, 'click', function(latlng) {
		displayMessage(latlng.toString(4));
		
});
    
CM.Event.addListener(map, 'dragend', function() {
	displayMessage(map.getCenter().toString(4));
});
	}
	window.onload = mapawms6;
</script>  
<!-- 7 Usando Google Maps-->
<!-- Cargar script de Cloudmade -->

<script type="text/javascript" src="http://tile.cloudmade.com/wml/latest/web-maps-lite.js"></script>


<form name="newprogram" action="newprogram.php" method="post">
  <div align="center"><span class="style6">Datos del programa</span>
  </div>
  <center><div id="message"></div></center>
  <pre><font face="Arial, Helvetica, sans-serif" size="2">                                   Ubicación: <input type="text" id="mensaje" name="mensaje" size="60">
                                                 <font face="Arial, Helvetica, sans-serif" size="2">   * Da clic sobre el mapa para obtener la ubicación</font>
											  
                  Nombre del programa: <input type="text" name="nombre" size="60" value="<?php if (isset($_POST["nombre"])){ echo $_POST["nombre"];} ?>" />
                               
                                Descripción: 
                                                   <textarea name="descripcion" rows="7" cols="63"><?php if (isset($_POST["descripcion"])){ echo $_POST["descripcion"];} ?></textarea>
									              
                             Convocatoria: 
                                                   <textarea name="convocatoria" rows="7" cols="63"><?php if (isset($_POST["convocatoria"])){ echo $_POST["convocatoria"];} ?></textarea>                               
<?php
require('config.php');
$link=mysql_connect($sql_host,$sql_user,$sql_pass);
mysql_select_db($sql_db,$link);
$nombre=$_POST['nombre'];
$mensaje=$_POST['mensaje'];
$descripcion=$_POST['descripcion'];
$convocatoria=$_POST['convocatoria'];
$latlong = preg_replace('#\((.+?)\)#i', '$1', $mensaje, 1);
if (strlen($nombre)==0)
{
}
else
{
			
if (strlen($mensaje)==0)
{
?>	
									<script language="javascript" type="text/javascript">
									var temp = document.getElementById('message');
									temp.innerHTML = "Debe de dar clic sobre el mapa para elegir una ubicacion"
									</script>
							<?php
}
else
{			
$personales= mysql_query('INSERT INTO programas (nombre, latitud, id_correo, descripcion, convocatoria) VALUES (\'' . mysql_real_escape_string($nombre) . '\', \'' . $latlong . '\', \'' . $login . '\', \'' . $descripcion . '\', \'' . $convocatoria . '\')');
?>	
<script language="javascript" type="text/javascript">
			window.location="save.php";
</script>
<?php
}
}
?>                                                                    
                                                                         <input type="submit" name="enviar" value="Registrar programa" style="color: #a41203; border-color:#2677b5; background-color:#a0c3dd; font-size: 14px; cursor: pointer; height:40px; width:180px; font-weight:bold" ></font></pre> 
            
</form>

</body>
</html>
<?php
}
?>	
