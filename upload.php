<?php
session_start();
if(!isset($_SESSION["login"])){
header("location:index.php");
} else {
require('config.php');
$link=mysql_connect($sql_host,$sql_user,$sql_pass);
mysql_select_db($sql_db,$link);
$login=$_SESSION["login"];
$consulta=mysql_query('SELECT * FROM publico WHERE correo=\'' . mysql_real_escape_string($login) . '\'');
///$query=mysql_query($consulta,$link);
while($row = mysql_fetch_array($consulta))
{
$foto=$row["foto"];
}	
$uploaddir = 'uploads/';
$imagen = basename($_FILES['userfile']['name']); 
$imagen1 = explode(".",$imagen); 
$nombre_limpio= preg_replace('[/+|\\.+]', '', $login);
$imagen2 = rand(100,9999). $nombre_limpio .".".$imagen1[1];
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], "temp/".$imagen2)) {
  	  include("resize.php");
   	
   	  $thumb=new thumbnail("temp/".$imagen2);
	  $thumb->size_width(50);
   
      $thumb->size_height(50);
   
      $thumb->jpeg_quality(90);
   
      $thumb->save("logo/".$imagen2);
	  
	  		if (strlen($foto)== 0)
		{
		}else {
		unlink ("logo/".$foto);
		}
	$result = mysql_query('UPDATE publico SET foto=\'' . $imagen2 . '\' WHERE correo=\'' . mysql_real_escape_string($login) . '\'');
	$result1 = mysql_query('UPDATE mensajes SET foto_emisor=\'' . $imagen2 . '\' WHERE emisor=\'' . mysql_real_escape_string($login) . '\'');

unlink("temp/".$imagen2); 
echo "success";
} else {
  echo "error";
}
}
?>