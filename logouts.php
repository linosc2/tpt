<?php
session_start();
if(!isset($_SESSION["login"])){
header("location:index.php");
} else {
session_unset();
session_destroy();
echo "<center>";
       echo "<font color=#666666 face='Georgia' />";
       echo "<div id='footer1'><br /><br /><br /><br /><br /><BR /><BR /><BR /><BR /></div>";
       echo "</center>";
echo "<br><BR /><BR />";
echo "<center>";
echo "<font color=#000066 face='Georgia' />";
echo "La sesión ha finalizado correctamente da click <a href=\"login.php\">aqui para loguearte nuevamente</a>";
echo "</font>";
echo "</center>";
?>	
						<script language="javascript" type="text/javascript">
						window.location="index.php";
						</script>
	<?php   
}
?>
