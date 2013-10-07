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
	  	    <input class="btn" type="button" value="Guardar" name="enviar">
	  	    <input class="btn" type="reset" value="Restablecer" name="reset">
		    <a class='btn' href="index2.php?section=<?echo $_GET['section']?>">Volver</a>
		</div>
	
		</form>

	<?}

	function show( $result ){
	
		global $db, $THEMEDIR;
		?>

		<script type="text/javascript">	
		$(document).ready(function() {
  		  $('a.confirm').click(function(event) {
    		    event.preventDefault()
    		    var url = $(this).attr('href');
    		    var confirm_box = confirm('¿Estás seguro de querer eliminar este grupo?');
    		    if (confirm_box) {
       		      window.location = url;
    		    }
  		  });
		});
		</script>

		<h2>Grupos</h2>
		<?
		foreach ($result as $fila) {
	
			$db->select_db("census_".$fila['NOMBRE_BBDD']);
			$count = current($db->f_sql("select count(ID) as COUNT from censo"));
			$row = Array();

			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[COD_GRUPO]\">$fila[NOMBRE]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[COD_GRUPO]\">$fila[NOMBRE_BBDD]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=remove&id=$fila[COD_GRUPO]\">$count[COUNT]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=remove&id=$fila[COD_GRUPO]\" class='confirm-delete' data-id='$fila[COD_GRUPO]'><i class='icon-trash' title='Borrar'></i></a>";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("Nombre","Base de datos","Nº de personas","");
		
		echo cHtml::widget_table("80%",$headers_list,$filas,$columns_size);
		echo cHtml::widget_deleteModal(HTML_admin_grupos::$section);
		?>

		<br />
		<div class="center">
			<a class='btn' href="index2.php?section=<?echo $_GET['section']?>&task=new">Nuevo grupo</a>
		</div>
	<?}
}
?>
