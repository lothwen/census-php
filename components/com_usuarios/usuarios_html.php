<? 

class HTML_usuarios {

	static $section = "usuarios";
	
	function edit( $id=0, $row ) { ?>
		
		<h2><?echo $id>0 ? $titulo="Modificar Usuario" : $titulo="Insertar nueva usuario";?></h2>
		<form name="insertar" method="post" action="<?echo $PHP_SELF."?section=".HTML_usuarios::$section."&task=save&id=$id" ;?>">

  		<table width="60%" align="center">
		  <tr>
	  	    <td>Nombre: </td>
	  	    <td><input type="text" name="nombre" value="<?echo $row['NOMBRE']?>" required></td>
		  </tr>
		  <tr>
	  	    <td>Usuario: </td>
	  	    <td><input type="text" name="usuario" value="<?echo $row['USUARIO']?>" required></td>
		  </tr>
		  <tr>
	  	    <td>Clave: </td>
	  	    <td><input type="text" name="clave" value="<?echo $row['CLAVE']?>" required></td>
		  </tr>
		</table>
		  
		<div class="center">
	  	    <input class="btn" type="submit" value="Guardar" name="enviar">
	  	    <input class="btn" type="reset" value="Restablecer" name="reset">
		        <a class='btn' href="index2.php?section=<?echo $_GET['section']?>">Volver</a>
		</div>
	
		</form>

	<?}

	function show( $result ){
	
		global $THEMEDIR;
	
		echo "<h2>Usuarios</h2>";

		foreach ($result as $fila) {
	
			$row = Array();

			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[COD_USUARIO]\">$fila[NOMBRE]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[COD_USUARIO]\">$fila[USUARIO]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[COD_USUARIO]\">$fila[CLAVE]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=remove&id=$fila[COD_USUARIO]\" class='confirm-delete' data-id='$fila[COD_USUARIO]'><i class='icon-trash' title='Borrar'></i></a>";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("Nombre","Usuario","Clave","");
		
		echo cHtml::widget_table("60%",$headers_list,$filas,$columns_size);
		echo cHtml::widget_deleteModal(HTML_usuarios::$section);
		?>

		<br />
		<div class="center">
			<a class='btn' href="index2.php?section=<?echo $_GET['section']?>&task=new">Nuevo usuario</a>
		</div>
	<?}
}
?>
