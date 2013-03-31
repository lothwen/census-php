<? 

class HTML_admin_grupos {

	static $section = "admin_grupos";
	
	function edit( $id=0, $row ) { ?>
		
		<h2><?echo $id>0 ? $titulo="Modificar Grupo" : $titulo="Insertar nuevo grupo";?></h2>
		<form name="insertar" method="post" action="<?echo $PHP_SELF."?section=".HTML_admin_grupos::$section."&task=save&id=$id" ;?>">

  		<table width="60%" align="center">
		  <tr>
	  	    <td>Nombre: </td>
	  	    <td><input type="text" name="nombre" value="<?echo $row['NOMBRE']?>" required></td>
		  </tr>
		  <tr>
	  	    <td>Base de datos: </td>
	  	    <td><input type="text" name="nombre_bbdd" value="<?echo $row['NOMBRE_BBDD']?>"></td>
		  </tr>
		</table>
		  
		<div class="center">
	  	    <input class="button" type="button" value="Guardar" name="enviar">
	  	    <input class="button" type="reset" value="Restablecer" name="reset">
		    <input type='button' onCLick='javascript:window.location="index2.php?section=<?echo $_GET['section']?>"' value='Volver'>
		</div>
	
		</form>

	<?}

	function show( $result ){
	
		global $db, $THEMEDIR;
	
		echo "<h2>Grupos</h2>";

		foreach ($result as $fila) {
	
			$db->select_db("census_".$fila['NOMBRE_BBDD']);
			$count = current($db->f_sql("select count(ID) as COUNT from censo"));
			$row = Array();

			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[COD_GRUPO]\">$fila[NOMBRE]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[COD_GRUPO]\">$fila[NOMBRE_BBDD]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=remove&id=$fila[COD_GRUPO]\">$count[COUNT]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=remove&id=$fila[COD_GRUPO]\"><img src=\"".$THEMEDIR."/img/borrar.png\" border=0/></a>";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("Nombre","Base de datos","Nº de personas","");
		
		echo cHtml::widget_table("80%",$headers_list,$filas,$columns_size);
		?>

		<br />
		<div class="center">
			<input type='button' onCLick='javascript:window.location="index2.php?section=<?echo $_GET['section']?>&task=new"' value='Nuevo grupo'>
		</div>
	<?}
}
?>
