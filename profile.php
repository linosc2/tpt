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
<!DOCTYPE html PU-BLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="mapa.ico" type="image/x-icon" />
<link rel="stylesheet" href="css/style.css" />
<script src="js/botones.js" type="text/javascript"></script>
<style type="text/css">
<!--
.style1 {
	color: #02024d;
	font-size: 10px;
}
.style2 {font-size: 10px;}
-->
</style>
</head>
<title>TECHO PARA TODOS</title>
<meta charset="UTF-8">
<!--[if IE]><![endif]-->

</head>
<body>
<center>
<?php
if(mysql_num_rows(mysql_query('SELECT correo FROM organizacion WHERE correo=\'' . mysql_real_escape_string($login) . '\'')) == 1) {
$consulta=mysql_query('SELECT * FROM organizacion where correo=\'' . mysql_real_escape_string($login) . '\'');
while($row = mysql_fetch_array($consulta))
{
$nombre=$row["nombre"];
$foto=$row["foto"];

}		
?>
	 <table width="900" border="0" align="center">
	 <tr><td width="500" align="left"><img src="images/logotipo.png" width="158" height="60" /></td>
	   <td align="right">
	   
 <a href="bienvenida.php" target="dinamico">
 
	<?php
if (strlen($foto)== 0)
		{

echo '<img src="images/noDisponible.png" height="30" width="30" border="1">';
}else {
echo '<img src="logo/'.$foto.'" height="30" width="30">';

		}
		?>
		
    <?php	
	echo "<font face:'Arial, Helvetica, sans-serif' size='2'>$nombre</font>";
	
	?>
	</a>
	</td></tr></table>
<br>
	 <table width="950" height="600" align="center" style="border-collapse: collapse;" rules="cols">
	 <tr>
	   <td width="200" align="left" style="border:2px solid #baccda">
	<?php
if (strlen($foto)== 0)
		{

echo '<pre>       <img src="images/noDisponible.png" height="70" width="75" border="1"></pre>';
}else {
echo '<pre>       <img src="logo/'.$foto.'" height="70" width="75"></pre>';

		}
		?>
 		
<nav>
              <ul>    
<li> <a href="newprogram.php" target="dinamico" ><img src="images/menu/uno.png" /></a></li>

<li><a href="programs.php" target="dinamico" ><img src="images/menu/dos.png" /></a></li>

<li><a href="logo_organizacion.php" target="dinamico" ><img src="images/menu/tres.png" /></a></li>

<li><a href="change_pass_org.php" target="dinamico" ><img src="images/menu/cuatro.png" /></a></li>

<li><a href="logout.php"><img src="images/menu/cinco.png" /></a></li>
</ul></nav>
<br><br><br><br><br><hr color="#baccda" width="180" align="center">
<center><div align="center" style="width:180px"><span class="style1">Copyright 2013 Todos los Derechos Reservados</span> <a href="http://www.joae.com.mx" target="_blank" class="style2" ><font style="text-decoration:underline">JOAE</font></a></div>
</center></td>
<td width="1" style="border:1px solid #ffffff"></td>
<td width="730">
<iframe src="bienvenida.php" height="100%" width="100%" frameborder="0" name="dinamico" >Consulta</iframe>
</td>
</tr>
<?php
}
else{
?>
<script language="javascript" type="text/javascript">
	window.location="logout.php";
</script>
<?php
}
}
?>		
</table>
</center>
</body>
</html>
