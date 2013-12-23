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
$foto=$row["foto"];
}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="js/jquery.1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.alerts.js"></script>
<script src="js/botones.js" type="text/javascript"></script>
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
<div align="center"><span class="style1">Sube la imagen de tu logo</span>
</div><br>
<span class="style2">En este apartado podrás subir la imagen del logo de la organización, solo ten en cuenta que la imagen deber estar en fotmato .jpg, de lo contrario no se podra subir.</span>
<hr color="#dfedf8">

<br><br>
<?php
if (is_uploaded_file($_FILES['im']['tmp_name']) ) { //recojo la imagen 
$imagen = $_FILES['im']['name']; //Obtengo el nombre de la imagen y la extensión de la foto
$imagen1 = explode(".",$imagen); //Genero un nombre aleatorio con números y se asigno la extensión botenido anteriormente
if (".".$imagen1[1] == ".jpg" or ".".$imagen1[1] == ".jpeg" ){
$nombre_limpio= preg_replace('[/+|\\.+]', '', $login);



$imagen2 = rand(100,9999). $nombre_limpio .".".$imagen1[1]; //Coloco la iamgen del usuario en la carpeta correspondiente con el nuevo nombre
///$imagen2 = $_POST['nombre'].".".$imagen1[1];
move_uploaded_file($_FILES['im']['tmp_name'],"temp/".$imagen2); //Asigno a la foto permisos
//echo "<img src='foto/".$imagen2."' height='250' width='190' VSPACE='' HSPACE='10' ALIGN='left' >";
  //$ruta="carpeta/".$imagen2; chmod($ruta,0777); //A partir de aqui sólo si quiero eliminar una foto //
  //$resultArchivos = mysql_query("Selecciono el nombre de la foto antigua"); //
  //$rowArchivos= mysql_fetch_array($resultArchivos); //
	  
	  include("includes/resize.php");
   	
     
	  $thumb=new thumbnail("temp/".$imagen2);
	  $thumb->size_width(50);
   
      $thumb->size_height(50);
   
      $thumb->jpeg_quality(90);
   
      $thumb->save("logo/".$imagen2);
	
		if (strlen($foto)== 0)
		{
print "<center><font color='#a41203' face='Arial, Helvetica, sans-serif' style='font-weight:bold' size=2>Imagen subida exitosament</font></center>";		}
		else {
print "<center><font color='#a41203' face='Arial, Helvetica, sans-serif' style='font-weight:bold' size=2>Imagen editada exitosamente</font></center>";
		unlink ("logo/".$foto);
		}
	$result = mysql_query('UPDATE organizacion SET foto=\'' . $imagen2 . '\' WHERE correo=\'' . mysql_real_escape_string($login) . '\'');
	$result1 = mysql_query('UPDATE mensajes SET foto_emisor=\'' . $imagen2 . '\' WHERE emisor=\'' . mysql_real_escape_string($login) . '\'');
		////unlink("foto/657574417.jpg"); eliminar si ya tiene un logo 
	
	unlink("temp/".$imagen2); ///echo "Tu nueva imagen ha sido subida.";
	$foto = $imagen2;

	}
	else
	{
	print "<center><font color='#a41203' face='Arial, Helvetica, sans-serif' style='font-weight:bold' size=2>Archivo no admitido debe ser .jpg</font></center>";
	}
}
	
//echo "<pre>";
 ?>
 <br><br><br>
<form method="post" action="logo_organizacion.php" enctype="multipart/form-data"> 
<img src="logo/<?php echo ($foto);?>" height="60" width="75" VSPACE="" HSPACE="10"><br><br>
<input name="im" type="file" >
<br><br><input type="submit" name="enviar" value="Subir imagen" style="color: #a41203; border-color:#2677b5; background-color:#a0c3dd; font-size: 14px; cursor: pointer; height:40px; width:180px; font-weight:bold" ></pre>
</form>
</center>

</body>
</html>

<?php
}
?>	