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
			$id=$_POST['id'];
		////	$login="oscarlarebel_69@hotmail.com";
			$tipos="programa";
			
			$consulta=mysql_query('SELECT * FROM programas WHERE id=\'' . $id . '\'');
				while($row = mysql_fetch_array($consulta))
						{
						$nombre=$row["nombre"];
						$descripcion=$row["descripcion"];
						$convocatoria=$row["convocatoria"];
						$id_correo=$row["id_correo"];
						}
?>
<?php
echo "<font face='Arial, Helvetica, sans-serif' size='3' color='#a41203' style='font-weight:bold'>$nombre</font><HR color='#baccda'>";
?>

<br>

<?php
echo "<div align='justify' style='width:600px'><font face='Arial, Helvetica, sans-serif' size='2'>Descripcion:</font><br><font face='Arial, Helvetica, sans-serif' size='2' color='#05369a'>";
echo nl2br("$descripcion");
echo "</font></div>";
?>

<br>
<?php
echo "<div align='justify' style='width:600px'><font face='Arial, Helvetica, sans-serif' size='2'>Convocatoria:</font><br><font face='Arial, Helvetica, sans-serif' size='2' color='#05369a'>";
echo nl2br("$convocatoria");
echo "</font></div>";	
?>
<br>
<br>
<?php
 if(!isset($_SESSION["login"]))
{
?>
<font face="Arial, Helvetica, sans-serif" size="2" color="#a41203">Necesitas estar registrado para poder comentar y participar</font>
<br><br>
<?php
} else {
}
?>	
<?php
$total=mysql_num_rows(mysql_query('SELECT * FROM participacion WHERE id_programa=\'' .$id . '\''));
echo "<font face='Arial, Helvetica, sans-serif' size='2' color='#a41203'>$total</font> <font face='Arial, Helvetica, sans-serif' size='2'>ya estan participando en este programa</font>";

if(mysql_num_rows(mysql_query('SELECT * FROM participacion WHERE id_correo=\'' . mysql_real_escape_string($login) . '\' AND id_programa=\'' . $id . '\'')) == 1) {
?>
<br><br>
<font face="Arial, Helvetica, sans-serif" size="3" color="#a41203">Ya estas participando</font><br>
<a href="javascript:void(0);" id="delpar" data-id="<?php echo ($id); ?>" data-correo="<?php echo ($login); ?>" data-nombre="<?php echo ($nombre); ?>" data-fecha="<?php echo ($fecha1); ?>" data-hora="<?php echo ($hora); ?>" data-tipos="<?php echo ($tipos); ?>" ><font face="Arial, Helvetica, sans-serif"color="#a41203" size="3" style="text-decoration:underline">Dejar de participar</font></a></br>
<?php

}else {
?>
<br><br>
<a href="javascript:void(0);" id="addpar" data-id="<?php echo ($id); ?>" data-correo="<?php echo ($login); ?>" data-nombre="<?php echo ($nombre); ?>" data-fecha="<?php echo ($fecha1); ?>" data-hora="<?php echo ($hora); ?>" data-tipos="<?php echo ($tipos); ?>" ><font face="Arial, Helvetica, sans-serif"color="#a41203" size="3">No esperes más, unete y </font> <font face="Arial, Helvetica, sans-serif"color="#a41203" size="3" style="text-decoration:underline">participa</font></a><br>
<?php

		}

?>
<br>
<form name ="message" id="message" method="POST" action="viewprograms.php">
<input type="text" name="mensaje" id="mensaje" size="80" style="height:35px">
<input type="hidden" name="login" id="login" value="<?php echo ($login); ?>">
<input type="hidden" name="id" size="20" id="id" value="<?php echo ($id); ?>">
<input type="hidden" name="hora" size="20" id="hora" value="<?php echo ($hora); ?>">
<input type="hidden" name="fecha" size="20" id="fecha" value="<?php echo ($fecha1); ?>">
<input type="hidden" name="tipo_tabla" size="20" id="tipo_tabla" value="<?php echo ($tipos); ?>">
<input id="submit" type="submit" name="submit" value ="Enviar mensaje" style="color: #a41203; border-color:#2677b5; background-color:#a0c3dd; font-size: 14px; cursor: pointer; height:35px; width:120px; font-weight:bold" />
</form>
<?php
if(mysql_num_rows(mysql_query('SELECT * FROM mensajes WHERE receptor=\'' . $id . '\'AND tipo=\'' . $tipos . '\'')) >= 1) {
$mensajes = mysql_query('SELECT * FROM mensajes WHERE receptor=\'' . $id . '\'AND tipo=\'' . $tipos . '\' ORDER BY id DESC');
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
			echo '<td>'. $logo .' <font face="Arial, Helvetica, sans-serif" size="2" style="font-weight:bold">'. $nombre_emisor .'</font></td></tr><tr><td><font face="Arial, Helvetica, sans-serif" size="2" color="#05369a"> '. $mensaje. '</font> <br><font face="Arial, Helvetica, sans-serif" size="1" color="#a0c3dd">'. $fecha .' a las '. $hora .'</font><br><a href="javascript:void(0);" id="delcoment" data-id="'.$id.'" data-idmensaje="'.$id_mensaje.'" data-tipotabla="'.$tipos.'"><font face="Arial, Helvetica, sans-serif" size="1">Eliminar</font></a></br><hr color="#baccda" width="400"></td>';
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

