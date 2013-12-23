<?php
session_start();
if(!isset($_SESSION["login"])){
header("location:index.php");
} else {
?>

<div class="content-popup">

	<div class="close"><a href="#" id="close"><img src="images/close.png"/></a></div>
  <div align="center"><br />
    <?php
include_once ("clase.php");// incluyo las clases a ser usadas
?>
    <font face="Arial, Helvetica, sans-serif" size="+1" color="#a41203" style="font-weight:bold">CAMBIAR PASSWORD</font><HR color="#baccda" width="400">    </div><center>
  <form name="change_p_public" id="change_p_public" method="POST" action="pass_public.php"><font style="font-family:Arial, Helvetica, sans-serif" size="2">
                    Contrase&ntilde;a Anterior: <BR><input type="password" name="contrasena1" id="contrasena1" size="40"/>
     <BR><BR>
                       Nueva contrase&ntilde;a: <BR><input type="password" name="contrasena2" id="contrasena2" size="40"/>
     <BR><BR>
                                     Confirmar nueva contrase&ntilde;a: <BR>
                                     <input type="password" name="contrasena3" id="contrasena3" size="40"/>
<BR><BR>
                                                              <input name="submit" type="submit"  value="Cambiar" style="color: #a41203; border-color:#2677b5; background-color:#a0c3dd; font-size: 14px; cursor: pointer; height:40px; width:180px; font-weight:bold" /></font>																																										
</form></center><BR>
  <div align="center"><font face="Arial, Helvetica, sans-serif" size="2" color="#a41203">Podr&aacute;s utilizar tu nueva contrase&ntilde;a en tu proximo inicio de sesi&oacute;n </font></div>
</div>
<?php
}
?>	