<?php
session_start();
if(!isset($_SESSION["login"])){
header("location:index.php");
} else {
require('config.php');
$link=mysql_connect($sql_host,$sql_user,$sql_pass);
mysql_select_db($sql_db,$link);
$id=$_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
<?php
if (strlen($id)== 0){
    ?>	
						<script language="javascript" type="text/javascript">
						window.location="programs.php";
						</script>
	<?php   
                  
} else {
	$result = mysql_query('DELETE FROM programas WHERE id=\'' . $id . '\'',$link);
   		

 ?>	
						<script language="javascript" type="text/javascript">
						window.location="programs.php";
						</script>
	<?php   

}
?>
</body>
</html>
<?php
}
?>	
