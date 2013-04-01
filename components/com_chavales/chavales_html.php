<? 

class HTML_kid {

	static $section = "chavales";
	
	function edit( $id=0, $row ) {

?>
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
	  </ul>
	</fieldset>

	<fieldset>
	  <legend>Datos familiares</legend>
	  
	  <ul>
	  	<li><label for="ama">Ama:</label>
	  	    <input type="text" id="ama" name="ama" value="<?echo $row['AMA']?>">
		</li>

	  	<li><label for="dni_ama">DNI Ama:</label>
	  	    <input type="text" id="dni_ama" name="dni_ama" maxlength="10" value="<?echo $row['DNI_AMA']?>">
		</li>
	
	  	<li><label for="aita">Aita:</label>
	  	    <input type="text" id="aita" name="aita" value="<?echo $row['AITA']?>">
		</li>

	  	<li><label for="dni_aita">DNI Aita:</label>
	  	    <input type="text" id="dni_aita" name="dni_aita" maxlength="10" value="<?echo $row['DNI_AITA']?>">
		</li>
	  </ul>
	</fieldset>

	<fieldset>
	  <legend>Contacto</legend>
	
	  <ul>	
	  	<li><label for="direccion">Dirección:</label>
	  	    <input type="text" id="direccion" name="direccion" value="<?echo $row['DIRECCION']?>" required>
		</li>

	  	<li><label for="municipio">Municipio:</label>
	  	    <input type="text" id="municipio" name="municipio" value="<?echo $row['MUNICIPIO']?>" required>
		</li>
	  
	  	<li><label for="cpostal">Código Postal:</label>
	  	    <input type="text" id="cpostal" name="cpostal" maxlength="5" value="<?echo $row['CODIGO_POSTAL']?>" required>
		</li>
	  
	  	<li><label for="provincia">Provincia:</label>
	  	    <input type="text" id="provincia" name="provincia" value="<?echo $row['PROVINCIA']?>" required>
		</li>
	  
	  	<li><label for="email">E-mail:</label>
	  	    <input type="email" id="email" name="email" value="<?echo $row['EMAIL']?>">
		</li>
	  
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
	  <textarea rows="10" style="width:450px" id="observaciones" name='observaciones'><?echo $row['OBSERVACIONES']?></textarea>
	</fieldset>
	
	<div>
		<input class="button" type="submit" value="Guardar" name="enviar">
	  	<input class="button" type="reset" value="Restablecer" name="reset">
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
	        	<input class="button" type="submit" value="Buscar" name="enviar">
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
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=remove&id=$fila[ID]\"><img src=\"".$THEMEDIR."/img/borrar.png\" border=0/></a>";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("Nombre","Apellidos","Telefono","Rama","");
		
		echo cHtml::widget_table("90%",$headers_list,$filas,$columns_size);
	}
}
?>
