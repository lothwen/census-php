<? 

class HTML_notas {

	static $section = "notas";
	
	function edit( $id=0, $row ) { ?>

		<h2><?echo $id>0 ? $titulo="Modificar Nota" : $titulo="Insertar nueva nota";?></h2>
		<form name="insertar" method="post" action="<?echo $PHP_SELF."?section=".HTML_notas::$section."&task=save&id=$id" ;?>">

  		<table width="100%" align="center">
		  <tr>
	  	    <td>Titulo: </td>
	  	    <td><input type="text" name="titulo" value='<?echo $row['TITULO']?>' class="span6" required ></td>
		  </tr>
		  
		  <tr>
	  	    <td>Contenido: </td>
	  	    <td><textarea class="span6" rows='30' name="contenido" required ><?echo $row['CONTENIDO']?></textarea></td>
		  </tr>

		  <tr>
	  	    <td><input class="btn" type="submit" value="Guardar" name="enviar" /></td>
	  	    <td><a class='btn' href="index2.php?section=<?echo $_GET['section']?>">Volver</a></td>
		  </tr>
	        </table>
	
		</form>

	<?}

	function show( $result ){
	
		global $THEMEDIR;
	
		echo "<h2>Notas</h2>";

		foreach ($result as $fila) {
	
			$row = Array();

			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[TITULO]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=remove&id=$fila[ID]\" class='confirm-delete' data-id='$fila[ID]'><i class='icon-trash' title='Borrar'></i></a>";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("TITULO","");
		$columns_size = Array("90%","10%");
		
		echo cHtml::widget_table("90%",$headers_list,$filas,$columns_size);
		echo cHtml::widget_deleteModal(HTML_notas::$section);
		?>

		<br />
		<div class="center">
			<a class='btn' href="index2.php?section=<?echo $_GET['section']?>&task=new">Nueva nota</a>
		</div>
	<?}
}
?>
