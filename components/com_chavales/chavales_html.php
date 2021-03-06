<? 

class HTML_kid {

	static $section = "chavales";
	
	function edit( $id=0, $row ) {

?>
<!-- Bootstrap datepicker includes -->
<link href="js/datepicker/css/datepicker.css" rel="stylesheet">
<script type="text/javascript" src="js/datepicker/js/bootstrap-datepicker.js" ></script>

<script type="text/javascript">
$(document).ready(function() {
	$('.ajax-typehead').typeahead({
    		source: function(query, process) {
        		return $.ajax({
            			url: $(this)[0].$element[0].dataset.link,
            			type: 'get',
            			data: {name_startsWith: query, maxRows: 10, country: 'ES', lang: 'es', featureClass: 'P', username: 'euskai'},
            			dataType: 'json',
            			success: function(json) {
					var result_array = new Array;
                			$.map(json.geonames, function(data, item){
	                    			result_array.push(data.name);
 			               	});
                			return typeof json.geonames == 'undefined' ? false : process(result_array);
            			}
        		});
    		},
		property: 'name',
	    	items: 6,
		minLength: 2,
		updater: function(selected){
        		$.ajax({
            			url: "http://api.geonames.org/postalCodeSearchJSON",
            			type: 'get',
            			data: {placename: selected, maxRows: 1, country: 'ES', username: 'euskai'},
            			dataType: 'json',
            			success: function(json) {
					$('#cpostal').val(json.postalCodes[0].postalCode);
					$('#provincia').val(json.postalCodes[0].adminName2);
                			return true;
            			}
        		});
			$('#email').focus();
			return selected;
		},
	});	
});
</script>
<h2><?echo $id>0 ? "Modificar chaval/a" : "Insertar nuevo chaval/a" ?></h2>
<form name="insertar" method="post" action="<?echo $PHP_SELF.'?section='.HTML_kid::$section.'&task=save&id='.$id?>">

	<fieldset>
	  <legend>Datos generales</legend>

	  <ul>
	  	<li><label for="nombre">Nombre:</label>
		    <input type="text" id="nombre" name="nombre" value="<?echo $row['NOMBRE']?>" required>
		</li>

	  	<li><label for="apellidos">Apellidos:</label>
		    <input type="text" id="apellidos" name="apellidos" value="<?echo $row['APELLIDOS']?>" required>
		</li>

	  	<li><label for="rama">Rama:</label>
	  	    <?echo cHtml::widget_select("ramas","ID","NOMBRE","rama",$row['RAMA']);?>
		</li>

	  	<li><label for="dni">DNI:</label>
	  	    <input type="text" id="dni" name="dni" maxlength="10" value="<?echo $row['DNI']?>">
		</li>
	  	<li><label for="dni">Fecha de Nacimiento:</label>
		    <?echo cHtml::widget_date("fecha_nacimiento", $row['FECHA_NACIMIENTO']);?>
		</li>
	  </ul>
	</fieldset>

	<fieldset>
	  <legend>Datos familiares</legend>
	  
	  <ul>
    		<li><div class="controls controls-row">
    			<label class="control-label" for="ama">Ama:</label>
	  	    	<input class="span2" type="text" id="ama" name="ama" value="<?echo $row['AMA']?>">
    			<label class="span1 control-label" for="dni_ama">DNI Ama:</label>
	  	    	<input class="span2" type="text" id="dni_ama" name="dni_ama" maxlength="10" value="<?echo $row['DNI_AMA']?>">
    		</div></li>
    		
		<li><div class="controls controls-row">
    			<label class="control-label" for="aita">Aita:</label>
	  	    	<input class="span2" type="text" id="aita" name="aita" value="<?echo $row['AITA']?>">
    			<label class="span1 control-label" for="dni_aita">DNI Aita:</label>
	  	    	<input class="span2" type="text" id="dni_aita" name="dni_aita" maxlength="10" value="<?echo $row['DNI_AITA']?>">
    		</div></li>
	  </ul>
	</fieldset>

	<fieldset>
	  <legend>Contacto</legend>
	
	  <ul>	
	  	<li><label for="direccion">Dirección:</label>
	  	    <div class="input-prepend">
			<span class="add-on">&nbsp;C/&nbsp;</span>
	  	        <input type="text" class="span4" id="direccion" name="direccion" value="<?echo $row['DIRECCION']?>" required>
		    </div>
		</li>

	  	<li><div class="controls controls-row">
			<label for="municipio">Municipio:</label>
	  	    	<input type="text" class="ajax-typehead span2" id="municipio" name="municipio" value="<?echo $row['MUNICIPIO']?>" class="ui-autocomplete-input" autocomplete="off" data-link='http://api.geonames.org/searchJSON' data-provide="typeahead" required>

	  		<label for="cpostal">&nbsp;&nbsp;C. Postal:</label>
	  	    	<input type="text" class="span1" id="cpostal" name="cpostal" maxlength="5" value="<?echo $row['CODIGO_POSTAL']?>" required>
		    </div>
		</li>
	  
	  	<li><label for="provincia">Provincia:</label>
	  	    <input type="text" id="provincia" name="provincia" value="<?echo $row['PROVINCIA']?>" required>
		</li>
	 
    		<li><div class="control-group">
    			<label class="control-label" for="email">Email</label>
    			<div class="controls">
    				<div class="input-prepend">
    					<span class="add-on"><i class="icon-envelope"></i></span>
    					<input class="span3" id="email" name="email" type="email" value="<?echo $row['EMAIL']?>">
    				</div>
    			</div>
    		</div></li>
	  
	  	<li><label for="telefono1">Teléfono 1:</label>
	  	    <input type="text" id="telefono1" name="telefono1" maxlength="9" value="<?echo $row['TELEFONO1']?>" required>
		</li>

	  	<li><label for="telefono2">Teléfono 2:</label>
	  	    <input type="text" id="telefono2" name="telefono2" maxlength="9" value="<?echo $row['TELEFONO2']?>">
		</li>
	  </ul>
	</fieldset>
	
	<fieldset>
	  <legend>Otros datos</legend>
	  <textarea rows="10" class="span6" id="observaciones" name='observaciones'><?echo $row['OBSERVACIONES']?></textarea>
	</fieldset>
	
	<div>
		<input class="btn" type="submit" value="Guardar" name="enviar">
	  	<input class="btn" type="reset" value="Restablecer" name="reset">
	</div>

  </table>
	
</form>

<?	
	}

	function finder() { ?>

	<h2>Realizar una busqueda</h2>

	<? $action=$PHP_SELF."?section=".HTML_kid::$section."&task=show"; ?>
	<form method="post" action="<?echo $action?>">

		<table align="center" width="80%">
			<tr>
			  <th colspan="2"><h3>CRITERIO</h3></th>
			</tr>

			<tr>
			  <td>Nombre: </td>
			  <td><input type="text" name="nombre"></td>
			</tr>

			<tr>
			  <td>Apellidos: </td>
			  <td><input type="text" name="apellidos"></td>
			</tr>

			<tr>
			  <td>Rama: </td>
			  <td><?echo cHtml::widget_select("ramas","ID","NOMBRE","rama");?></td>
			</tr>
		</table>

		<br />

		<div class="center">
	        	<input class="btn" type="submit" value="Buscar" name="enviar">
	        </div>

	</form>

	<?
	}

	function show( $result ){
	
		global $THEMEDIR;
	
		echo "<h2>Resultado de la busqueda</h2>";

		foreach ($result as $fila) {
	
			$row = Array();

			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[NOMBRE]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[APELLIDOS]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[TELEFONO1]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[NOMBRE_RAMA]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=remove&id=$fila[ID]\" class='confirm-delete' data-id='$fila[ID]'><i class='icon-trash' title='Borrar'></i></a>";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("Nombre","Apellidos","Telefono","Rama","");
		
		echo cHtml::widget_table("90%",$headers_list,$filas,$columns_size);
		echo cHtml::widget_deleteModal(HTML_kid::$section);
	}
}
?>
