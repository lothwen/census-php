<? 

class HTML_admin_grupos {

	static $section = "admin_grupos";
	
	function edit( $id=0, $row ) { ?>

		<script>
		function f_aceptar(){

	        	var formulario;
	        	formulario = document.insertar;
	
        		if (formulario.nombre.value==""){
        		        alert("Debe rellenar el campo nombre");
        		}else{
                		formulario.submit();

        	        }
        	}
		</script>

		
		<h2><?echo $id>0 ? $titulo="Modificar Grupo" : $titulo="Insertar nuevo grupo";?></h2>
		<form name="insertar" method="post" action="<?echo $PHP_SELF."?section=".HTML_admin_grupos::$section."&task=save&id=$id" ;?>">

  		<table width="60%" align="center">
		  <tr>
	  	    <td>Nombre: </td>
	  	    <td><input type="text" name="nombre" value="<?echo $row['NOMBRE']?>"></td>
		  </tr>
		  <tr>
	  	    <td>Base de datos: </td>
	  	    <td><input type="text" name="nombre_bbdd" value="<?echo $row['NOMBRE_BBDD']?>"></td>
		  </tr>
		</table>
		  
		<div class="center">
	  	    <input class="button" type="button" onClick="javascript:f_aceptar();" value="Guardar" name="enviar">
	  	    <input class="button" type="reset" value="Restablecer" name="reset">
		        <input type='button' onCLick='javascript:window.location="index2.php?section=<?echo $_GET['section']?>"' value='Volver'>
		</div>
	
		</form>

	<?}

	function show( $result ){
	
		global $THEMEDIR;
	
		echo "<h2>Grupos</h2>";

		foreach ($result as $fila) {
	
			$row = Array();

			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[COD_GRUPO]\">$fila[NOMBRE]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[COD_GRUPO]\">$fila[NOMBRE_BBDD]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=remove&id=$fila[COD_GRUPO]\"><img src=\"".$THEMEDIR."/img/borrar.png\" border=0/></a>";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("Nombre","Base de datos","");
		
		echo cHtml::widget_table("60%",$headers_list,$filas,$columns_size);
		?>

		<br />
		<div class="center">
			<input type='button' onCLick='javascript:window.location="index2.php?section=<?echo $_GET['section']?>&task=new"' value='Nuevo grupo'>
		</div>
	<?}
}
?>
