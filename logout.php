<?php
session_start();
if(!isset($_SESSION["login"])){
header("location:index.php");
} else {
session_unset();
session_destroy();

?>	
						<script language="javascript" type="text/javascript">
						window.location="mapa.php";
						</script>
	<?php   
}
?>
