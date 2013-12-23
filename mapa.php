<?php require('config.php');
include_once ("comprueba.php");// incluyo las clases a ser usadas
$link=mysql_connect($sql_host,$sql_user,$sql_pass);
mysql_select_db($sql_db,$link);
$view= new stdClass(); // creo una clase standard para contener la vista
////$view->disableLayout=false;// marca si usa o no el layout , si no lo usa imprime directamente el template
?>
<html>
<head>
	<title>TECHO PARA TODOS</title>
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="mapa.ico" type="image/x-icon" />
	<link rel="stylesheet" href="leaflet.css" />
	    <link rel="stylesheet" href="style.css" />
		
	<!--[if lte IE 8]><link rel="stylesheet" href="../dist/leaflet.ie.css" /><![endif]-->
	<style>
		div#map {
    width: 100%;
    height: 100%;
}

		.info {
		padding: 10px 8px;
			width: 350px;
    		height: 560px;
			font: 12px/14px Arial, Helvetica, sans-serif;
			background: white;
			background: rgba(255,255,255,0.6);
			box-shadow: 0 0 10px rgba(0,0,0,0.6);
			border-radius: 2px;
		}
		.info h4 {
			margin: 0 0 5px;
			color: red;
		}

		.legend {
			width: 100px;
    		height: 170px;
			text-align: center;
			line-height: 18px;
			color: #02024d;
		}
		.legend i {
			width: 18px;
			height: 18px;
			float: left;
			margin-right: 8px;
			opacity: 0.8;
		}
.encabezado {
			
    		padding: 10px 8px;
			width:auto;
    		height: auto;
			font: 12px/14px Arial, Helvetica, sans-serif;
			background: white;
			background: rgba(255,255,255,0.6);
			box-shadow: 0 0 10px rgba(0,0,0,0.6);
			border-radius: 2px;
			
		}

#popup {
	left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
	
	
}

.content-popup {
	margin:0px auto;
	margin-top:120px;
	position:relative;
	padding:10px;
	width:700px;
	min-height:250px;
	border-radius:4px;
	background-color: #f3f8fb;
	box-shadow: 0 2px 5px #666666;
	 opacity: 0.9;
	
}


.popup-overlay {
	left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 999;
	display:none;
	background-color: #000033;
    cursor: pointer;
    opacity: 0.7;
}

.close {
	position: absolute;
    right: 15px;
}
#scrollbar1 { width: 700px; margin: 20px 0 10px; }
#scrollbar1 .viewport { width: 680px; height: 480px; overflow: hidden; position: relative; }
#scrollbar1 .overview { list-style: none; position: absolute; left: 0; top: 0; padding: 0; margin: 0; }
#scrollbar1 .scrollbar{ background: transparent url(images/bg-scrollbar-track-y.png) no-repeat 0 0; position: relative; background-position: 0 0; float: right; width: 15px; }
#scrollbar1 .track { background: transparent url(images/bg-scrollbar-trackend-y.png) no-repeat 0 100%; height: 100%; width:13px; position: relative; padding: 0 1px; }
#scrollbar1 .thumb { background: transparent url(images/bg-scrollbar-thumb-y.png) no-repeat 50% 100%; height: 20px; width: 25px; cursor: pointer; overflow: hidden; position: absolute; top: 0; left: -5px; }
#scrollbar1 .thumb .end { background: transparent url(images/bg-scrollbar-thumb-y.png) no-repeat 50% 0; overflow: hidden; height: 5px; width: 25px; }
#scrollbar1 .disable { display: none; }
#menuContainer {
    position:relative;
    float:left;
    font-size:12px;
}
#menubox {
    position:absolute;
    top:23px;
    left:0;
    display:none;
    z-index:29;
}
#menuForm {
    width:180px; 
    border:1px solid #899caa;
    background:#d2e0ea;
    padding:5px;
}
#openmenu:hover {
    background:url(images/buttonbgHover.png) repeat-x;
}
.buttonmenu:hover {
    background:url(images/buttonbgHover.png) repeat-x;
}
.buttonmenu { 
     width:120px;
    float:left;
    background:#339cdf url(images/buttonbg.png) repeat-x;
  	padding:7px 10px 8px 10px;
}

#openmenu { 
    display:inline-block;
    float:right;
    background:#d2e0ea url(images/buttonbg.png) repeat-x; 
    border:1px solid #899caa; 
    border-radius:3px;
    -moz-border-radius:3px;
    position:relative;
    z-index:30;
    cursor:pointer;
}

/* Login Button Text */
.buttonmenu span {
    color:#445058; 
    font-size:12px; 
    font-weight:bold; 
    text-shadow:1px 1px #fff; 
   display:block
}
#buscador {
    background-color: white;
    position: absolute;
    top: 20px;
    left: 18px;
    width: auto;
    height: auto;
    padding: 10px;
	opacity: 0.7;
}

#upload_button:hover{
	color:#FFFFFF;
}

</style>

<script type="text/javascript" src="jquery.1.4.2.min.js"></script>
<script language="javascript" src="js/AjaxUpload.2.0.min.js"></script>
<script type="text/javascript" src="jquery.tinyscrollbar.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    $('#close').live('click',function(){
        $('#popup').hide('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
    })
	$('#program').live('click',function(){
       var id=$(this).attr('data-id');
		params={};
		params.id=id;
		 $('#popup').load('viewprograms.php',params,function(){
		  $('#popup').show('slow');
			$('.popup-overlay').fadeIn('slow');
			$('.popup-overlay').height($(window).height());
			 $('#scrollbar1').tinyscrollbar();
		return false;
        })
     })
	 
	 $('#organization').live('click',function(){
       
   		var id=$(this).attr('data-id');
		params={};
		params.id=id;
		 $('#popup').load('vieworganization.php',params,function(){
		  
		
            $('#popup').show('slow');
			
			$('.popup-overlay').fadeIn('slow');
			$('.popup-overlay').height($(window).height());
			 $('#scrollbar1').tinyscrollbar();
		return false;
        })
     })

    $('#addpar').live('click',function(){
       var id=$(this).attr('data-id');
	    var correo=$(this).attr('data-correo');
		 var nombre=$(this).attr('data-nombre');
		  var fecha=$(this).attr('data-fecha');
		   var hora=$(this).attr('data-hora');
		    var tipos=$(this).attr('data-tipos');
		params={};
		params.id=id;
		params.correo=correo;
		params.nombre=nombre;
		params.fecha=fecha;
		params.hora=hora;
		params.tipos=tipos;
		params.action="addpar";
		
			//$('#block').hide();
            //$('#popupbox').hide();
            $('#popup').load('viewprograms.php',params,function(){ $('#scrollbar1').tinyscrollbar();});
			
        
        return false;
    })
	
	 $('#delpar').live('click',function(){
       var id=$(this).attr('data-id');
	    var correo=$(this).attr('data-correo');
		 var nombre=$(this).attr('data-nombre');
		  var fecha=$(this).attr('data-fecha');
		   var hora=$(this).attr('data-hora');
		    var tipos=$(this).attr('data-tipos');
		params={};
		params.id=id;
		params.correo=correo;
		params.nombre=nombre;
		params.fecha=fecha;
		params.hora=hora;
		params.tipos=tipos;
		params.action="delpar";
		
			//$('#block').hide();
            //$('#popupbox').hide();
            $('#popup').load('viewprograms.php',params,function(){ $('#scrollbar1').tinyscrollbar();});
			
        
        return false;
    })
 		$('#message').live('submit',function(){
        	var params={};
			params.id=$('#id').val();
        	params.action='message';
        	params.mensaje=$('#mensaje').val();
			params.respuesta=$('#respuesta').val();
			params.id_mensaje=$('#id_mensaje').val();
        	params.tipo_tabla=$('#tipo_tabla').val();
        	params.fecha=$('#fecha').val();
			params.hora=$('#hora').val();
        	
       		$.post('viewprograms.php',params,function(){
            	
				var para={};
				para.id=$('#id').val();
				$('#popup').load('viewprograms.php',para,function(){ $('#scrollbar1').tinyscrollbar();});
        	})
        	return false;
    		})        
			$('#message1').live('submit',function(){
        	var params={};
			params.id=$('#id1').val();
        	params.action='message';
        	params.mensaje=$('#mensaje1').val();
			params.respuesta=$('#respuesta1').val();
			params.id_mensaje=$('#id_mensaje1').val();
        	params.tipo_tabla=$('#tipo_tabla1').val();
        	params.fecha=$('#fecha1').val();
			params.hora=$('#hora1').val();
        	
       		$.post('viewprograms.php',params,function(){
            	
				var para={};
				para.id=$('#id1').val();
				$('#popup').load('vieworganization.php',para,function(){ $('#scrollbar1').tinyscrollbar();});
        	})
        	return false;
    		})        
			 
	$('#delcoment').live('click',function(){
       var id=$(this).attr('data-id');
	    var id_mensaje=$(this).attr('data-idmensaje');
		 var tipo_tabla=$(this).attr('data-tipotabla');
		 ///var login=$(this).attr('data-login');
		params={};
		params.id=id;
		params.id_mensaje=id_mensaje;
		params.tipo_tabla=tipo_tabla;
		///params.login=login;
		params.action="delcoment";
		
			//$('#block').hide();
            //$('#popupbox').hide();
            $('#popup').load('viewprograms.php',params,function(){ $('#scrollbar1').tinyscrollbar();});
			
        
        return false;
    })
			 
	$('#delcoment1').live('click',function(){
       var id=$(this).attr('data-id');
	    var id_mensaje=$(this).attr('data-idmensaje');
		 var tipo_tabla=$(this).attr('data-tipotabla');
		 ///var login=$(this).attr('data-login');
		params={};
		params.id=id;
		params.id_mensaje=id_mensaje;
		params.tipo_tabla=tipo_tabla;
		///params.login=login;
		params.action="delcoment";
		
			//$('#block').hide();
            //$('#popupbox').hide();
            $('#popup').load('vieworganization.php',params,function(){ $('#scrollbar1').tinyscrollbar();});
			
        
        return false;
    })



		 $('#loginButton').live('click',function(){
      $('#popup').load('logeo.php',function(){
		  $('#popup').show('slow');
			$('.popup-overlay').fadeIn('slow');
			$('.popup-overlay').height($(window).height());
			
		return false;
        })
     })	

	
	$('#logeo').live('submit',function(){
        	var params={};
			///params.id=$('#id').val();
        	///params.action='message';
        	params.login=$('#email').val();
			params.pass=$('#password').val();
			params.action="logeo";
        	
       		$.post('logeo.php',params,function(){
            	
				window.location="mapa.php";
        	})
        	return false;
    		})        

 
	
	
	var menuopen = $('#openmenu');
    var boxmenu = $('#menubox');
   // var form = $('#loginForm');
    menuopen.removeAttr('href');
    menuopen.mouseup(function(menu) {
            boxmenu.toggle();
        menuopen.toggleClass('active');
      });
    $(this).mouseup(function(menu) {
        if(!($(menu.target).parent('#openmenu').length > 0)) {
            menuopen.removeClass('active');
            boxmenu.hide();
        }
    });

 	
	 
	 $('#passPublic').live('click',function(){
      $('#popup').load('pass_public.php',function(){
		  $('#popup').show('slow');
			$('.popup-overlay').fadeIn('slow');
			$('.popup-overlay').height($(window).height());
			
		return false;
        })
     })	
	 $('#change_p_public').live('submit',function(){
        	var params={};
			params.contrasena1=$('#contrasena1').val();
			params.contrasena2=$('#contrasena2').val();
			params.contrasena3=$('#contrasena3').val();
        	params.action='changepass';
            $.post('pass_public.php',params,function(){
            	})
				
        	  $('#popup').hide('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
    		})   
			
			
	var buttonfile = $('#upload_button'), interval;
	new AjaxUpload('#upload_button', {
        action: 'upload.php',
		onSubmit : function(file , ext){
		if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
			// extensiones permitidas
			alert('Error: Solo se permiten imagenes');
			// cancela upload
			return false;
		} else {
			buttonfile.text('Uploading');
			this.disable();
		}
		},
		onComplete: function(file, response){
			buttonfile.text('Upload');
			// enable upload button
			this.enable();			
			// Agrega archivo a la lista
			$('#lista').appendTo('.files').text(file);
			
		}	
	});     

			
});

</script>


</head>
<body>
   <div id="contenido">
	<div id="map"></div>
	<div id="popup" style="display: none;">
</div>
<div class="popup-overlay"></div>
<div id="buscador">
              			
<?php 
////session_start();
if(!isset($_SESSION["login"]))
{
?>
<a href="javascript:void(0);" id="loginButton"><font size="2" color="#a41203">Login</font></a><br><br>
<a href="registro.php" target="_blank" id="loginButton1"><font size="2" color="#a41203">Registrate</font></a><br><br>
<a href="regisorg.php" target="_blank" id="loginButton1"><font size="2" color="#a41203">Registra tu organización</font></a>
<?php
} else {
?> 
<font face="Arial, Helvetica, sans-serif" size="3" color="#a41203" style="font-weight:bold">BIENVENIDO</font>
<br /><br />
<?php
$login=$_SESSION["login"];
if(mysql_num_rows(mysql_query('SELECT correo FROM organizacion WHERE correo=\'' . mysql_real_escape_string($login) . '\'')) == 1) {
$consulta=mysql_query('SELECT * FROM organizacion where correo=\'' . mysql_real_escape_string($login) . '\'');
while($row = mysql_fetch_array($consulta))
{
$nombre=$row["nombre"];
$foto=$row["foto"];
}		
if (strlen($foto)== 0)
		{
?>
<table><tr><td>
<img src="images/noDisponible.png" height="30" width="30" border="0"></td><td><font face="Arial, Helvetica, sans-serif" size="2" color="#02024d" style="font-weight:bold"> <?php echo $nombre; ?></font></td></tr></table>
<?php
}else {
?> 
<table><tr><td>
<img src="logo/<?php echo $foto; ?>" height="30" width="30"></td><td><font face="Arial, Helvetica, sans-serif" size="2" color="#02024d" style="font-weight:bold"> <?php echo $nombre; ?></font></td></tr></table>
<?php
		}
?> 
<div id="menuContainer"><a href="javascript:void(0);" id="openmenu"><img src="images/icon-cog-shadow.png" height="20" width="20"/></a><div style="clear:both"></div><div id="menubox"><div id="menuForm"><fieldset id="body"><a href="profile.php" target="_parent" class="buttonmenu" ><span><font size="2" color="#a41203">Administrar cuenta</font></span></a><br /><br /><br /><a href="logout.php" id="" class="buttonmenu" ><span></span><font size="2" color="#a41203">Salir</font></span></a></div></div>
<?php
}

elseif(mysql_num_rows(mysql_query('SELECT correo FROM publico WHERE correo=\'' . mysql_real_escape_string($login) . '\'')) == 1) {
$consulta=mysql_query('SELECT * FROM publico where correo=\'' . mysql_real_escape_string($login) . '\'');
while($row = mysql_fetch_array($consulta))
{
$nombre=$row["nombre"];
$foto=$row["foto"];
}		
if (strlen($foto)== 0)
		{
?> 
<table><tr><td>
<img src="images/noDisponible.png" height="30" width="30" border="0"></td><td><font face="Arial, Helvetica, sans-serif" size="2" color="#02024d" style="font-weight:bold"> <?php echo $nombre; ?></font></td></tr></table>
<?php
}else {
?> 
<table><tr><td>
<img src="logo/<?php echo $foto; ?>" height="30" width="30"></td><td><font face="Arial, Helvetica, sans-serif" size="2" color="#02024d" style="font-weight:bold"> <?php echo $nombre; ?></font></td></tr></table>
<?php
		}
?> 
<div id="menuContainer"><a href="javascript:void(0);" id="openmenu"><img src="images/icon-cog-shadow.png" height="20" width="20"/></a><div style="clear:both"></div><div id="menubox"><div id="menuForm"><fieldset id="body"><div id="upload_button" class="buttonmenu"><span><font size="2" color="#a41203">Upload foto</font></span></div>
<ul id="lista">
</ul><br /><br /><a href="javascript:void(0);" id="passPublic" class="buttonmenu" ><span><font size="2" color="#a41203">Cambiar password</font></span></a><br /><br /><br /><a href="logout.php" id="" class="buttonmenu" ><span><font size="2" color="#a41203">Salir</font></span></a></div></div>
<?php
}
else{

}
}
?>	
</div>
	
	<script src="leaflet.js"></script>

         
             
          

	<script type="text/javascript">
		var map = L.map('map', {zoomControl: false}).setView([23.0797, -103.5352], 6);
		L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		    maxZoom: 18
		}).addTo(map);
		var LeafIcon = L.Icon.extend({
			options: {
				iconSize:     [30, 30],
				iconAnchor:   [15 , 30],
				popupAnchor:  [-4, -43]
			}
		});
			<?php 
			$consulta='select * from programas';
			$resultado=mysql_query($consulta,$link);
			while($row=mysql_fetch_array($resultado)){
			$programa="programa";
			?>
			var marcadorIcon<?php echo $row["id"];?> = new LeafIcon({iconUrl: 'programa.png'})
			L.marker([<?php echo $row["latitud"];?>], {icon: marcadorIcon<?php echo $row["id"];?>}).bindPopup('<img src="logo/<?php $logo=mysql_query('select foto from organizacion where correo=\'' . $row["id_correo"] . '\'limit 1',$link); while($foto=mysql_fetch_array($logo)){ echo $foto["foto"];}?>" height="30" width="30" border="0"> <font face="Arial, Helvetica, sans-serif"color="#02024d" style="font-weight:bold"> <?php echo $row["nombre"];?></font><br><?php echo '<a href="javascript:void(0);" data-id="'. $row['id']. '" id="program"><font face="Arial, Helvetica, sans-serif"color="#05369a">Conoce mas del</font> <font face="Arial, Helvetica, sans-serif"color="#a41203" style="text-decoration:underline">programa</font></a><br /><a href="javascript:void(0);" data-id="'. $row['id_correo']. '" id="organization"><font face="Arial, Helvetica, sans-serif"color="#05369a">Conoce mas de la</font> <font face="Arial, Helvetica, sans-serif"color="#a41203" style="text-decoration:underline">organizacion</font></a>'; ?>').addTo(map);
		<?php } ?>
		
		// control that shows state info on hover
		var info = L.control();
		

		info.onAdd = function (map) {
		

			this._div = L.DomUtil.create('div', 'info');
			this.update();
				
			
			return this._div;
		};

		info.update = function (props) {
			
			
				this._div.innerHTML =  ( props ? 
				'<b><center><img src="estados/'+ props.imagen +'" width="295px" height="250px"/><br /><br /><font face="Arial, Helvetica, sans-serif" size="3" color="#A41203">'+ props.name +'<br /> Poblacion (miles de personas): '+ props.poblacion +'<br />' + props.pobreza +'% de la poblacion en situacion pobreza</font></center><br /><font face="Arial, Helvetica, sans-serif" color="#02024d"><font style="font-weight:bold">'+ props.pobreza_mod + '%</font> de la poblacion en situacion de pobreza moderada<br /><font style="font-weight:bold">'+ props.pobreza_ext + '%</font> de la poblacion en situacion de pobreza extrema<br /><font style="font-weight:bold">'+ props.rezago_edu + '%</font> de la poblacion con rezago educativo<br /><font style="font-weight:bold">'+ props.carencia_salud + '%</font> de la poblacion con carencia por acceso a los servicios de salud <br /><font style="font-weight:bold">'+ props.carencia_ss + '%</font> de la poblacion con carencia por acceso a la seguridad social<br /><font style="font-weight:bold">'+ props.carencia_vivi + '%</font> de la poblacion con carencia por calidad y espacios en la vivienda<br /><font style="font-weight:bold">'+ props.carencia_basic_vivi + '%</font> de la poblacion con carencia por acceso a los servicios basicos en la vivienda <br /><font style="font-weight:bold">'+ props.carencia_ali + '%</font> de la poblacion con carencia por acceso a la alimentacin <br /><font style="font-weight:bold">'+ props.ingreso_inf_mini + '%</font> de la poblacion con ingreso inferior a la linea de bienestar minimo<br /><font style="font-weight:bold">'+ props.ingreso_inf_bien + '%</font> de la poblacin con ingreso inferior a la lnea de bienestar</font><br />'
				: '<b><br /><br /><br /><center><img src="images/logotipo.png" width="320" height="120"><center/></b><br /><br /><font face="Arial, Helvetica, sans-serif" size="3" color="#02024d">Techo para todos es la plataforma a trav&eacute;s de<br /><br /> la cual se pretende que la sociedad civil y las<br /><br /> organizaciones gubernamentales y ONG se <br /><br /><font face="Arial, Helvetica, sans-serif" size="3" color="#A41203" style="font-weight:bold">ENTEREN</font>, se <font face="Arial, Helvetica, sans-serif" size="3" color="#A41203" style="font-weight:bold">INVOLUCREN</font> y <font face="Arial, Helvetica, sans-serif" size="3" color="#A41203" style="font-weight:bold">PARTICIPEN</font><br /><br /> conjunta y activamente en el tema de la pobreza<br /><br /> en M&eacute;xico.<br /><br /><br /><center><font style="font-weight:bold"> AYUDAR ESTA EN NOSOTROS<br /><br /> AYUDAR ESTA EN TI, NO ESPERES MAS<br /><br /> INVOLUCRATE, ENTERATE Y PARTICIPA </font><br /><br /><br /> <font face="Arial, Helvetica, sans-serif" size="2" color="#A41203" style="font-weight:bold">Desliza el mouse sobre cualquier estado</font>');
		};

		info.addTo(map);


		//// get color depending l nivel de pobreza
		function getColor(p) {
			return p > 70 ? '#800026' :
			       p > 60  ? '#BD0026' :
			       p > 50  ? '#E31A1C' :
			       p > 40  ? '#FC4E2A' :
			       p > 30   ? '#FD8D3C' :
			       p > 20   ? '#FEB24C' :
			       p > 10   ? '#FED976' :
			       			 '#FFEDA0';
		}

		function style(feature) {
			return {
				weight: 2,
				opacity: 1,
				color: 'white',
				dashArray: '3',
				fillOpacity: 0.7,
				fillColor: getColor(feature.properties.pobreza)
			};
		}

		function highlightFeature(e) {
			var layer = e.target;
			
			layer.setStyle({
				weight: 3,
				color: '#400000',
				dashArray: '',
				fillOpacity: 0.7
			});

			if (!L.Browser.ie && !L.Browser.opera) {
				layer.bringToFront();
			}
			var valores = layer.feature.properties;
			
			info.update(valores);
			
		}

		var geojson;

		function resetHighlight(e) {
			geojson.resetStyle(e.target);
			info.update();
		}

		function zoomToFeature(e) {
			map.fitBounds(e.target.getBounds());
			//var layers = e.target;
			
			//return false;	
			
		}

		function onEachFeature(feature, layer) {
			layer.on({
				mouseover: highlightFeature,
				mouseout: resetHighlight,
				click: zoomToFeature
			});
		}

		geojson = L.geoJson(statesData, {
			style: style,
			onEachFeature: onEachFeature
		}).addTo(map);

		map.attributionControl.addAttribution('powered by &copy; <a href="http://joae.com.mx/">JOAE</a>');
var legend = L.control({position: 'bottomleft'});

		legend.onAdd = function (map) {

			var div = L.DomUtil.create('div', 'info legend'),
				grades = [0, 10, 20, 30, 40, 50, 60, 70 ],
				labels = [],
				from, to;
				div.innerHTML = labels.push('Porcentaje');
			for (var i = 0; i < grades.length; i++) {
				from = grades[i];
				to = grades[i + 1];

				labels.push(
					'<i style="background:' + getColor(from + 1) + '"></i> ' +
					from + (to ? '% &ndash; ' + to +'%' : '% +'));
			}

			div.innerHTML = labels.join('<br>');
			return div;
		};

		legend.addTo(map);

	L.control.zoom({zoomcontrol: true, position:'bottomleft'}).addTo(map)

	</script>

	

</div>
</body>
</html>