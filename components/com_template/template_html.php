<? 

class HTML_template {

	static $section = "template";
	
	function edit( $id=0, $row ) { ?>

		
		<h2><?echo $id>0 ? $titulo="Modificar __SECCION__" : $titulo="Insertar __SECCION__";?></h2>
		<form name="insertar" method="post" action="<?echo $PHP_SELF."?section=".HTML_template::$section."&task=save&id=$id" ;?>">

  		<table width="60%" align="center">
		  <tr>
	  	    <td>Form1:</td>
	  	    <td><input type="text" name="nombre" value="<?echo $row['NOMBRE']?>"></td>
		  </tr>

		  <tr>
	  	    <td><input class="btn" type="button" value="Guardar" name="enviar"></td>
	  	    <td><input class="btn" type="reset" value="Restablecer" name="reset"></td>
		  </tr>
	        </table>
	
		</form>

	<?}

	function show( $result ){
	
		global $THEMEDIR;
	
		echo "<h2>__TITULO_SECCION__</h2>";

		foreach ($result as $fila) {
	
			$row = Array();

			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[NOMBRE]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[APELLIDOS]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[TELEFONO]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[NOMBRE_RAMA]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=remove&id=$fila[ID]\"><img src=\"".$THEMEDIR."/img/borrar.png\" border=0/></a>";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("Titulo1","Titulo2","Titulo3","Titulo4","");
		
		echo cHtml::widget_table("90%",$headers_list,$filas,$columns_size);
	}
}
?>
