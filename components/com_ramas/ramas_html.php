<? 

class HTML_ramas {

	static $section = "ramas";
	
	function edit( $id=0, $row ) { ?>

		<h2><?echo $id>0 ? $titulo="Modificar Rama" : $titulo="Insertar nueva rama";?></h2>
		<form name="insertar" method="post" action="<?echo $PHP_SELF."?section=".HTML_ramas::$section."&task=save&id=$id" ;?>">

  		<table width="60%" align="center">
		  <tr>
	  	    <td>Nombre: </td>
	  	    <td><input type="text" name="nombre" value="<?echo $row['NOMBRE']?>" required></td>
		  </tr>

		  <tr>
	  	    <td><input class="btn" type="submit"value="Guardar" name="enviar"></td>
	  	    <td><input class="btn" type="reset" value="Restablecer" name="reset">
		        <a class="btn" href="index2.php?section=<?echo $_GET['section']?>">Volver</a></td>
		  </tr>
	        </table>
	
		</form>

	<?}

	function show( $result ){
	
		global $THEMEDIR;
	
		echo "<h2>Ramas</h2>";

		foreach ($result as $fila) {
	
			$row = Array();

			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[NOMBRE]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=remove&id=$fila[ID]\"><img src=\"".$THEMEDIR."/img/borrar.png\" border=0/></a>";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("Nombre","");
		$columns_size = Array("90%","10%");
		
		echo cHtml::widget_table("40%",$headers_list,$filas,$columns_size);
		?>

		<br />
		<div class="center">
			<a class='btn' href="index2.php?section=<?echo $_GET['section']?>&task=new">Nueva rama</a>
		</div>
	<?}
}
?>
