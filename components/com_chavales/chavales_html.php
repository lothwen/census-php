<? 

class HTML_kid {

	static $section = "chavales";
	
	function edit( $id=0, $row ) {

?>

<script>
function f_aceptar(){

	var formulario;	
	formulario = document.insertar;

	if (formulario.nombre.value==""){	
		alert("Debe rellenar el campo nombre");
	}else{
		if (formulario.apellidos.value==""){	
			alert("Debe rellenar el campo apellidos")
		}else{
			if (formulario.direccion.value == ""){	
				alert("Debe rellenar el campo direccion");
			}else{
				if (formulario.telefono.value == ""){	
					alert("Debe rellenar el campo telefono");
				}else{
					if(formulario.rama.value == "0"){
						alert("Debe elegir una rama");
					}else{
						formulario.submit();
					}
				}
			}
		}
	}
}
</script>

<h2><?echo $id>0 ? "Modificar chaval/a" : "Insertar nuevo chaval/a" ?></h2>
<form name="insertar" method="post" action="<?echo $PHP_SELF.'?section='.HTML_kid::$section.'&task=save&id='.$id?>">

  <table width="60%" align="center">
	<tr>
	  <td>Nombre:</td>
	  <td><input type="text" name="nombre" value="<?echo $row['NOMBRE']?>"></td>
	</tr>

	<tr>
	  <td>Apellidos: </td>
	  <td><input type="text" name="apellidos" value="<?echo $row['APELLIDOS']?>"></td>
	</tr>

	<tr>
	  <td>Rama: </td>
	  <td><?echo cHtml::widget_select("ramas","ID","NOMBRE","rama",$row['RAMA']);?></td>
	</tr>

	<tr>
	  <td>DNI: </td>
	  <td><input type="text" name="dni" maxlength="10" value="<?echo $row['DNI']?>"></td>
	</tr>

	<tr>
	  <td>Ama: </td>
	  <td><input type="text" name="ama" value="<?echo $row['AMA']?>"></td>
	</tr>

	<tr>
	  <td>DNI Ama: </td>
	  <td><input type="text" name="dni_ama" maxlength="10" value="<?echo $row['DNI_AMA']?>"></td>
	</tr>

	<tr>
	  <td>Aita: </td>
	  <td><input type="text" name="aita" value="<?echo $row['AITA']?>"></td>
	</tr>

	<tr>
	  <td>DNI Aita: </td>
	  <td><input type="text" name="dni_aita" maxlength="10" value="<?echo $row['DNI_AITA']?>"></td>
	</tr>

	<tr>
	  <td>E-mail: </td>
	  <td><input type="text" name="email" value="<?echo $row['EMAIL']?>"></td>
	</tr>
	
	<tr>
	  <td>Dirección: </td>
	  <td><input type="text" name="direccion" value="<?echo $row['DIRECCION']?>"></td>
	</tr>

	<tr>
	  <td>Pueblo: </td>
	  <td><input type="text" name="pueblo" value="<?echo $row['PUEBLO']?>"></td>
	</tr>

	<tr>
	  <td>Teléfono: </td>
	  <td><input type="text" name="telefono" maxlength="9" value="<?echo $row['TELEFONO']?>"></td>
	</tr>

	<tr>
	  <td>Móvil:</td>
	  <td><input type="text" name="movil" maxlength="9" value="<?echo $row['MOVIL']?>"></td>
	</tr>

	<tr>
	  <td><input class="button" type="button" onClick="f_aceptar()" value="Guardar" name="enviar"></td>
	  <td><input class="button" type="reset" value="Restablecer" name="reset"></td>
	</tr>

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
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[TELEFONO]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[NOMBRE_RAMA]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=remove&id=$fila[ID]\"><img src=\"".$THEMEDIR."/img/borrar.png\" border=0/></a>";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("Nombre","Apellidos","Telefono","Rama","");
		
		echo cHtml::widget_table("90%",$headers_list,$filas,$columns_size);
	}
}
?>
