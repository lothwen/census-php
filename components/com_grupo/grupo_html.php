<? 

class HTML_grupo {

	static $section = "grupo";

	function edit( $row ) { ?>

		<script>
		function f_aceptar(){

	        	var formulario;
	        	formulario = document.insertar;
	
        		if (formulario.nombre.value==""){
        		        alert("Debe rellenar el campo nombre");
        		}else{
                		formulario.submit();

        	        }
        	}
		
		function updateThumbnail(){

	        	var image;
	        	image = document.insertar.theme.value;

			document.images["thumb"].src = "themes/" + image + "/screenshot.png";

        	}
		</script>

		
		<h2>Configuración</h2>
		<form name="insertar" method="post" action="<?echo $PHP_SELF."?section=".HTML_grupo::$section."&task=save";?>">

		<fieldset>
		<legend>Ficha de grupo</legend>
  		<table width="60%" align="center">
		  <tr>
	  	    <td>Nombre: </td>
	  	    <td><input type="text" name="nombre" value="<?echo $row['NOMBRE']?>"></td>
		  </tr>
		  <tr>
	  	    <td>Dirección: </td>
	  	    <td><input type="text" name="direccion" value="<?echo $row['DIRECCION']?>"></td>
		  </tr>
		  <tr>
	  	    <td>Email: </td>
	  	    <td><input type="text" name="email" value="<?echo $row['EMAIL']?>"></td>
		  </tr>
		  <tr>
	  	    <td>Página web: </td>
	  	    <td><input type="text" name="web" value="<?echo $row['WEB']?>"></td>
		  </tr>
	        </table>
		</fieldset>
	
		<br />
		
		<fieldset>
		<legend>Preferencias</legend>
  		<table width="60%" align="center">
		  <tr>
	  	    <td>Tema: </td>
	  	    <td><select name="theme" onChange="javascript:updateThumbnail();">
			<? foreach(scandir("themes/") as $theme) {
				if ($theme == '.' || $theme == '..' || $theme == 'login') continue;
				$selected="";
				if($theme==$row['THEME']) $selected = "selected";
				echo "<option value='$theme' $selected>$theme</option>";
			    } ?>
			</select>
		    </td>
		    <td rowspan="2"><img src="" id="thumb" width="160px" height="110px"></td>
		  </tr>
		  <tr>
	  	    <td>Filas max.:</td>
	  	    <td><select name="max_filas">
		    		<option value="5" <?if($row['MAX_FILAS']==5)echo "selected"?>>5</option>
		    		<option value="10" <?if($row['MAX_FILAS']==10)echo "selected"?>>10</option>
		    		<option value="15" <?if($row['MAX_FILAS']==15)echo "selected"?>>15</option>
		    		<option value="20" <?if($row['MAX_FILAS']==20)echo "selected"?>>20</option>
		    		<option value="30" <?if($row['MAX_FILAS']==30)echo "selected"?>>30</option>
		    		<option value="50" <?if($row['MAX_FILAS']==50)echo "selected"?>>50</option>
			</select>
		    </td>
		  </tr>
	        </table>
		</fieldset>
		
		<br />

		<div class="center">
	     	    <input class="button" type="button" onClick="javascript:f_aceptar();" value="Guardar" name="enviar">
	  	    <input class="button" type="reset" value="Restablecer" name="reset">
	  	</div>
	
		</form>

		<script>updateThumbnail();</script>
	<?}
}
?>
