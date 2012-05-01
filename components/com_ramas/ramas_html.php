<? 

class HTML_ramas {

	static $section = "ramas";
	
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

		
		<h2><?echo $id>0 ? $titulo="Modificar Rama" : $titulo="Insertar nueva rama";?></h2>
		<form name="insertar" method="post" action="<?echo $PHP_SELF."?section=".HTML_ramas::$section."&task=save&id=$id" ;?>">

  		<table width="60%" align="center">
		  <tr>
	  	    <td>Nombre: </td>
	  	    <td><input type="text" name="nombre" value="<?echo $row['NOMBRE']?>"></td>
		  </tr>

		  <tr>
	  	    <td><input class="button" type="button" onClick="javascript:f_aceptar();" value="Guardar" name="enviar"></td>
	  	    <td><input class="button" type="reset" value="Restablecer" name="reset">
		        <input type='button' onCLick='javascript:window.location="index2.php?section=<?echo $_GET['section']?>"' value='Volver'></td>
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
			<input type='button' onCLick='javascript:window.location="index2.php?section=<?echo $_GET['section']?>&task=new"' value='Nueva rama'>
		</div>
	<?}
}
?>
