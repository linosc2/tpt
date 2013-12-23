<?php
session_start();
$action=$_POST['action'];
$login=$_SESSION["login"];
		// se definen los datos del servidor de base de datos 
		$conection['server']="localhost";  //host
		$conection['user']="inkubame_techopt";         //  usuario
		$conection['pass']="techoparatodos2013";             //password
		$conection['base']="inkubame_techo";           //base de datos
		
		// crea la conexion pasandole el servidor , usuario y clave
		$conect= mysql_connect($conection['server'],$conection['user'],$conection['pass']);

		if ($conect) // si la conexion fue exitosa , selecciona la base
		{
			mysql_select_db($conection['base']);			
		}
if(!isset($_SESSION["login"])){
} else {
switch ($action)
{
case 'addpar':
$id=$_POST['id'];
///$login=$_POST['correo'];
$nombre=$_POST['nombre'];
$fecha=$_POST['fecha'];
$hora=$_POST['hora'];
$tipos="programa";

$tipo="participacion";
$nombre_actividad="participacion en:".$nombre;
$personales= mysql_query('INSERT INTO participacion (id_correo, id_programa, nom_programa, hora, fecha, tipo) VALUES (\'' . mysql_real_escape_string($login) . '\', \'' . $id . '\', \'' . $nombre . '\', \'' . $hora . '\', \'' . $fecha . '\', \'' . $tipo . '\')');

$actividad= mysql_query('INSERT INTO actividad (id_correo, id_actividad, nombre_actividad, tipo, hora, fecha) VALUES (\'' . mysql_real_escape_string($login) . '\', \'' . $id . '\', \'' . $nombre_actividad . '\', \'' . $tipo . '\', \'' . $hora . '\', \'' . $fecha . '\')');

break;

case 'delpar':
$id=$_POST['id'];
//$login=$_POST['correo'];
$nombre=$_POST['nombre'];
$fecha=$_POST['fecha'];
$hora=$_POST['hora'];
$tipos="programa";

$tipo="participacion";
$nombre_actividad="haz dejado de participar en:".$nombre;
$result = mysql_query('DELETE FROM participacion WHERE id_correo=\'' . mysql_real_escape_string($login) . '\' AND id_programa=\'' . $id . '\'');
$actividad= mysql_query('INSERT INTO actividad (id_correo, id_actividad, nombre_actividad, tipo, hora, fecha) VALUES (\'' . mysql_real_escape_string($login) . '\', \'' . $id . '\', \'' . $nombre_actividad . '\', \'' . $tipo . '\', \'' . $hora . '\', \'' . $fecha . '\')');

break;

case 'message':
$id=$_POST['id'];
$mensaje = $_POST['mensaje'];
//$login=$_POST['login'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$tipos = $_POST['tipo_tabla'];


if (strlen($mensaje)== 0)
{
			}
else
{
if(mysql_num_rows(mysql_query('SELECT * FROM publico WHERE correo=\'' . mysql_real_escape_string($login) . '\'')) == 1) {
											$publico=mysql_query('SELECT * FROM publico WHERE correo=\'' . mysql_real_escape_string($login) . '\'');
											while($row = mysql_fetch_array($publico))
												{
													$nombres_emisor1=$row["nombre"];
													$foto_emisor1=$row["foto"];
												}	
											

						
						}
						else
						{
											$organizacion=mysql_query('SELECT * FROM organizacion WHERE correo=\'' . mysql_real_escape_string($login) . '\'');
											while($row = mysql_fetch_array($organizacion))
												{
													$nombres_emisor1=$row["nombre"];
													$foto_emisor1=$row["foto"];
												}
												
						}
$tipo="mensaje";
$nombre_actividad="escribiste un mensaje en :".$nombre;
$add_mensaje = mysql_query('INSERT INTO mensajes (emisor, mensaje, receptor, tipo, hora, fecha, nombre_emisor, foto_emisor) VALUES (\'' . mysql_real_escape_string($login) . '\', \'' . $mensaje . '\', \'' . $id . '\', \'' . $tipos . '\', \'' . $hora . '\', \'' . $fecha . '\', \'' . $nombres_emisor1 . '\', \'' . $foto_emisor1 . '\')');

$actividad= mysql_query('INSERT INTO actividad (id_correo, id_actividad, nombre_actividad, tipo, hora, fecha) VALUES (\'' . mysql_real_escape_string($login) . '\', \'' . $id . '\', \'' . $nombre_actividad . '\', \'' . $tipo . '\', \'' . $hora . '\', \'' . $fecha . '\')');

}

break;

case 'delcoment':
$id=$_POST['id'];
$id_mensaje = $_POST['id_mensaje'];
//$login=$_POST['login'];
$fecha = $_POST['fecha'];
$tipo_tabla = $_POST['tipo_tabla'];
$tipos="programa";
	$result = mysql_query('DELETE FROM mensajes WHERE emisor=\'' . mysql_real_escape_string($login) . '\' AND id=\'' . $id_mensaje . '\'');
break;
	
case 'changepass':
$contrasena1= $_POST['contrasena1'];
$contrasena2=$_POST['contrasena2'];
$contrasena3=$_POST['contrasena3'];

$consulta=mysql_query('SELECT * FROM publico WHERE correo=\'' . mysql_real_escape_string($login) . '\'');
///$query=mysql_query($consulta,$link);
while($row = mysql_fetch_array($consulta))
{
$pass=$row["password"];
$salt=$row["salt"];

}

if ($contrasena1=="")
{
}
else
{
$contrasena = crypt(md5($contrasena1), '$1$'. $salt .'usuario');
if(mysql_num_rows(mysql_query('SELECT * FROM publico WHERE correo=\'' . mysql_real_escape_string($login) . '\' AND password=\'' . mysql_real_escape_string($contrasena) . '\'')) == 1) {
            if($contrasena2 == $contrasena3) {
				if(strlen($contrasena2) >= 5 && strlen($contrasena2) <= 20) {
				
				function generateSalt($length=16) {
      			$randstr='';
      			srand((double)microtime()*1000000);
   				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      			while(strlen($randstr)<$length) {
         		$randstr.=substr($chars,(rand()%(strlen($chars))),1);
      			} 
      			return $randstr;
   				}
				$new_pass = generateSalt();
				
				$result = mysql_query('UPDATE publico SET password=\'' . crypt(md5($contrasena2), '$1$'. $new_pass .'usuario') . '\', salt=\'' . $new_pass . '\' WHERE correo=\'' . mysql_real_escape_string($login) . '\''); 
				
						
               		} else {
               			}
			   } else {
               }
            	
			} else {
            }
         
	}

	
	break;
}	
}
