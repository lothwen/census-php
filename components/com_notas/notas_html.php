<? 

class HTML_notas {

	static $section = "notas";
	
	function edit( $id=0, $row ) { ?>

		<h2><?echo $id>0 ? $titulo="Modificar Nota" : $titulo="Insertar nueva nota";?></h2>
		<form name="insertar" method="post" action="<?echo $PHP_SELF."?section=".HTML_notas::$section."&task=save&id=$id" ;?>">

  		<table width="100%" align="center">
		  <tr>
	  	    <td>Titulo: </td>
	  	    <td><input type="text" name="titulo" value='<?echo $row['TITULO']?>' style='width:93%' required ></td>
		  </tr>
		  
		  <tr>
	  	    <td>Contenido: </td>
	  	    <td><textarea cols="50" rows='30' name="contenido" required ><?echo $row['CONTENIDO']?></textarea></td>
		  </tr>

		  <tr>
	  	    <td><input class="button" type="submit" value="Guardar" name="enviar" /></td>
	  	    <td><input type='button' onCLick='javascript:window.location="index2.php?section=<?echo $_GET['section']?>"' value='Volver'></td>
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
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=remove&id=$fila[ID]\"><img src=\"".$THEMEDIR."/img/borrar.png\" border=0/></a>";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("TITULO","");
		$columns_size = Array("90%","10%");
		
		echo cHtml::widget_table("90%",$headers_list,$filas,$columns_size);
		?>

		<br />
		<div class="center">
			<input type='button' onCLick='javascript:window.location="index2.php?section=<?echo $_GET['section']?>&task=new"' value='Nueva nota'>
		</div>
	<?}
}
?>
