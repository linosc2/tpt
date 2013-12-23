<?php 
session_start();
// modificacion de codigo Xombra (www.xombra.com) 21/03/2009 para sectorweb.net
    require('config.php');
	$link=mysql_connect($sql_host,$sql_user,$sql_pass);
	mysql_select_db($sql_db,$link);
    $login = $_POST['login'];
function generateSalt($length=16) {
      $randstr='';
      srand((double)microtime()*1000000);
   
      $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      while(strlen($randstr)<$length) {
         $randstr.=substr($chars,(rand()%(strlen($chars))),1);
      } 
      return $randstr;
   }


 if(mysql_num_rows(mysql_query('SELECT correo FROM publico WHERE correo=\'' . mysql_real_escape_string($login) . '\'')) == 1) {
	
    $salt = mysql_query('SELECT salt FROM publico WHERE correo=\'' . $login . '\'LIMIT 1');
	while($row = mysql_fetch_array($salt))
	{
	$salt1=$row["salt"];
	}	
	$pass = crypt(md5($_POST['pass']), '$1$'. $salt1 .'usuario'); 
 
    $result = mysql_query('SELECT correo FROM publico WHERE correo=\'' . $login . '\'AND password=\'' . $pass . '\'');  // Ahora
     
	  if(mysql_num_rows($result)== 1){ // nos devuelve 1 si encontro el usuario y el password
	  
		$array=mysql_fetch_array($result);
         $_SESSION["login"]=$array["correo"];
		 		    // header("Location:index.php");
       }  else {
	   
	   
	   					$result1 = mysql_query('SELECT correo FROM publico WHERE correo=\'' . $login . '\'LIMIT 1');
	    						if(mysql_num_rows($result1)== 1){
	   								$mensaje= "contraseña incorrecta";
									return $mensaje;
	 	      						}
			    				else {  
				   					$mensaje= "usuario incorrecto";
									return $mensaje;
							}
	   								

	} 
}	


elseif (mysql_num_rows(mysql_query('SELECT correo FROM organizacion WHERE correo=\'' . mysql_real_escape_string($login) . '\'')) == 1) 
{
	
    $salt = mysql_query('SELECT salt FROM organizacion WHERE correo=\'' . $login . '\'LIMIT 1');
	while($row = mysql_fetch_array($salt))
	{
	$salt1=$row["salt"];
	}	
	$pass = crypt(md5($_POST['pass']), '$1$'. $salt1 .'organizacion'); 
 
    $result = mysql_query('SELECT * FROM organizacion WHERE correo=\'' . $login . '\'AND password=\'' . $pass . '\'');  // Ahora
      if(mysql_num_rows($result)== 1){ // nos devuelve 1 si encontro el usuario y el password
	  
		$array=mysql_fetch_array($result);
         $_SESSION["login"]=$array["correo"];
		 		     ///header("Location:index.php");
			 
	       }  else {
	    
	   
	   $result1 = mysql_query('SELECT correo FROM organizacion WHERE correo=\'' . $login . '\'LIMIT 1');
	    if(mysql_num_rows($result1)== 1){
	   $mensaje= "contraseña incorrecta";
	   return $mensaje;
	         }
			    else {  
				   $mensaje= "usuario incorrecto";
				   return $mensaje;
					
			}
	  
	} 
}	

?>

