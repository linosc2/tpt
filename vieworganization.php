<center>
<div class="content-popup">
	<div class="close"><a href="#" id="close"><img src="images/close.png"/></a></div>
	<br />
        
		<div id="scrollbar1">
		<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
        <div class="viewport">
        <div class="overview">
		<?php 
		include_once ("clase.php");// incluyo las clases a ser usadas
		setlocale(LC_ALL, 'esp_esp');
		$Fecha=getdate();
		$hora=$Fecha["hours"].":".$Fecha["minutes"].":".$Fecha["seconds"];  
		$fecha1= strftime("%A %d %B %Y", time());
		$login=$_SESSION["login"];
			$id_correo=$_POST['id'];
		////	$login="oscarlarebel_69@hotmail.com";
			$tipos="organizacion";
			$consulta1=mysql_query('SELECT * FROM organizacion WHERE correo=\'' . $id_correo . '\'');
while($row = mysql_fetch_array($consulta1))
{
$nombre=$row["nombre"];
$descripion=$row["descripcion"];
$foto=$row["foto"];
}
///echo "$imagen";
echo '<img src="logo/'.$foto.'" height="30" width="30" border="0">';
echo "<br>";
echo "<font face='Arial, Helvetica, sans-serif' color='#a41203' style='font-weight:bold'>";
echo "".$nombre;
echo "</font>";
echo "<br><HR color='#baccda'><br>";
echo "<div align='justify' style='width:600px'><font face='Arial, Helvetica, sans-serif' size='2'>Descripcion:</font><br><font face='Arial, Helvetica, sans-serif' size='2' color='#05369a'>";
echo "". $descripion; 
echo "</font></div>";
echo "<br><br>";
 if(!isset($_SESSION["login"]))
{
?>
<font face="Arial, Helvetica, sans-serif" size="2" color="#a41203">Necesitas estar registrado para poder comentar</font>
<br>
<?php
} else {
}
?>
<br>	
<form name ="message1" id="message1" method="POST" action="vieworganization.php">
<input type="text" name="mensaje1" id="mensaje1" size="80" style="height:35px">
<input type="hidden" name="id1" size="20" id="id1" value="<?php echo ($id_correo); ?>">
<input type="hidden" name="hora1" size="20" id="hora1" value="<?php echo ($hora); ?>">
<input type="hidden" name="fecha1" size="20" id="fecha1" value="<?php echo ($fecha1); ?>">
<input type="hidden" name="tipo_tabla1" size="20" id="tipo_tabla1" value="<?php echo ($tipos); ?>">
<input id="submit" type="submit" name="submit" value ="Enviar mensaje" style="color: #a41203; border-color:#2677b5; background-color:#a0c3dd; font-size: 14px; cursor: pointer; height:35px; width:120px; font-weight:bold" />
</form>
<?php
if(mysql_num_rows(mysql_query('SELECT * FROM mensajes WHERE receptor=\'' . $id_correo . '\'AND tipo=\'' . $tipos . '\'')) >= 1) {
$mensajes = mysql_query('SELECT * FROM mensajes WHERE receptor=\'' . $id_correo . '\'AND tipo=\'' . $tipos . '\' ORDER BY id DESC');
echo "<table align=center border=0 cellspacing=5 width=400>";
while($row = mysql_fetch_array($mensajes))
			{
			$mensaje=$row["mensaje"];
			$nombre_emisor=$row["nombre_emisor"];
			$foto=$row["foto_emisor"];
			$hora=$row["hora"];
			$fecha=$row["fecha"];
			$id_mensaje=$row["id"];
///			$tipo=$row["tipo"];
			$emisor=$row["emisor"];
			if (strlen($foto)== 0)
				{
				$logo= '<img src="images/noDisponible.png" height="30" width="30" border="0">';

				}else {
				$logo= '<img src="logo/'.$foto.'" height="30" width="30" border="0">'; 

				}
								
			
			
			echo "<tr>";
			echo '<td>'. $logo .' <font face="Arial, Helvetica, sans-serif" size="2" style="font-weight:bold">'. $nombre_emisor .'</font></td></tr><tr><td><font face="Arial, Helvetica, sans-serif" size="2" color="#05369a"> '. $mensaje. '</font> <br><font face="Arial, Helvetica, sans-serif" size="1" color="#a0c3dd">'. $fecha .' a las '. $hora .'</font><br><a href="javascript:void(0);" id="delcoment1" data-id="'.$id_correo .'" data-idmensaje="'.$id_mensaje.'" data-tipotabla="'.$tipos.'"><font face="Arial, Helvetica, sans-serif" size="1">Eliminar</font></a></br><hr color="#baccda" width="400"></td>';
			echo '<tr><td></td></tr>';
			

}
echo "</table>";

}
else	
{
echo '<font face="Arial, Helvetica, sans-serif" size="2" color="#a41203">No hay mensajes</font>';
}
?>

</div>
</div>
</div>
</div>
</center>

