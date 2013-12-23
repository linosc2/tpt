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
<link rel="stylesheet" href="css/pagination.css" media="screen">
<link rel="stylesheet" href="css/stylebusca.css" media="screen">
<style type="text/css">
<!--
BODY{
font-family:Arial, Helvetica, sans-serif;
color:#02024d;
overflow-x: hidden;
}
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	color: #a41203;
	font-weight: bold;
	font-size: x-large;
}
.style2 {
	color: #02024d;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
/* TEXTAREA */
textarea {
background: #efeff0;
font-family: Arial, Helvetica, sans-serif;
font-size: 10pt;
color: #666666;
border: 1px solid #cccccc;
}
-->
</style>
</head>
<body>
<br>
<center>
<div align="center"><span class="style1">Ver programas</span>
</div><br>
<span class="style2">En esta sección podrás visualizar los programas que has registrado, teniendo la opción de eliminar y editar programas.</span>
<hr color="#baccda">
<?php
require('config.php');
require('includes/pagination.class.php');
$link=mysql_connect($sql_host,$sql_user,$sql_pass);
mysql_select_db($sql_db,$link);
echo "<div id='resultados' align='center'>";
$items = 10;
$page = 1;
if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
		$limit = " LIMIT ".(($page-1)*$items).",$items";
	else
		$limit = " LIMIT $items";

	$consulta = "SELECT nombre, descripcion, convocatoria, id, id_correo FROM programas WHERE id_correo='$login'";
	$sqlStrAux = "SELECT count(*) as total FROM programas";
	$aux = Mysql_Fetch_Assoc(mysql_query($sqlStrAux,$link));
	$query=mysql_query($consulta.$limit, $link);
if($aux['total']>0){

$p = new pagination;
			$p->Items($aux['total']);
			$p->limit($items);
			$p->target("programs.php");
			$p->currentPage($page);
			$p->show();
			echo "\t<table class=\"registros\" cellpadding='0' cellspacing='0' align='center'>\n";
			$r=0;
			while($row = mysql_fetch_array($query))
			{
			$nombre=$row["nombre"];
			$descripcion=$row["descripcion"];
			$id=$row["id"];
			$programa="programa";
			echo "<tr class=\"row$r\">";
			echo "<td width='10'><td><font face='Arial, Helvetica, sans-serif' size='2' style='font-weight:bold' color='#a41203'>".$nombre."</font><br><br><font face='Arial, Helvetica, sans-serif' size='2' color='#02024d'>Descripción:<br><font face='Arial, Helvetica, sans-serif' size='2' color='#05369a'>".$descripcion."<br></font></font><br></td><td><a href='editprogram.php?id=".$id."'><img src='images/editar.png'></a><br><a href='delete_programs.php?id=".$id."'><img src='images/elim.gif'></a></td></td></tr>";
if($r%2==0)++$r;else--$r;
}

echo "</table>";
$p->show();

}
echo "</div>";


?>
  
</body>
</html>
<?php
}
?>	
