<?php
session_start();
if(!isset($_SESSION["login"])){
header("location:index.php");
} else {
require('config.php');
$link=mysql_connect($sql_host,$sql_user,$sql_pass);
mysql_select_db($sql_db,$link);
$id=$_GET['id'];
$login=$_SESSION["login"];
$consulta1=mysql_query('SELECT * FROM programas WHERE id=\'' . $id . '\'');
///$query=mysql_query($consulta,$link);
while($row = mysql_fetch_array($consulta1))
{
$nombre=$row["nombre"];
$descripcion=$row["descripcion"];
$convocatoria=$row["convocatoria"];
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
    color: #05359a;
    background-color: #d0e9fb;
    padding: 3px;
}
 
input:focus {
    box-shadow: 0 0 10px #aaa;
    -webkit-box-shadow: 0 0 10px #aaa;
    -moz-box-shadow: 0 0 10px #aaa;
    border:1px solid #a41203;
    background-color:white;
	color: #05359a;
}
/* END INPUT */

/* TEXTAREA */
textarea {
background: #d0e9fb;
font-family: Arial, Helvetica, sans-serif;
font-size: 12px;
color: #05369a;
border: 1px solid #02024d;
}
textarea:focus {
        box-shadow: 0 0 10px #aaa;
    -webkit-box-shadow: 0 0 10px #aaa;
    -moz-box-shadow: 0 0 10px #aaa;
    border:1px solid #a41203;
    background-color:white;
	color: #05359a;
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
<div align="center"><span class="style1">Editar programa</span>
</div>
<div align="center"><br>
    <span class="style2">En esta sección podrás editar la información del programa que quieras cambiar.</span>
</div>
<hr color="#baccda">
<form name="editar" action="editprogram.php?id=<?php echo ($id);?>" method="post" onsubmit="return valida(this);">
  <pre><font face="Arial, Helvetica, sans-serif" size="2" >
           Nombre del programa: <input type="text" name="nombre" size="65" value="<?php  echo ($nombre); ?>" />
                  
                         Descripción: 
                                            <textarea name="descripcion" rows="7" cols="68"><?php echo ($descripcion); ?></textarea>
                                
                       Convocatoria: 
                                            <textarea name="convocatoria" rows="7" cols="68"><?php echo ($convocatoria); ?></textarea>                                
<?php
$newnombre=$_POST['nombre'];
$newdescripcion=$_POST['descripcion'];
$newconvocatoria=$_POST['convocatoria'];
if ($newnombre == "")
{
}
else
{
$editar= mysql_query('UPDATE programas SET nombre=\'' . $newnombre . '\', descripcion=\'' . $newdescripcion . '\', convocatoria=\'' . $newconvocatoria . '\' WHERE id=\'' . $id . '\''); 
?>	
<script language="javascript" type="text/javascript">
			window.location="edit.php";
</script>
<?php
}
?>	
                                                                    <input type="submit" name="enviar" value="Editar programa" style="color: #a41203; border-color:#2677b5; background-color:#a0c3dd; font-size: 14px; cursor: pointer; height:40px; width:180px; font-weight:bold" ></font></pre> 

</body>
</html>
<?php
}
?>	

