<? 

class HTML_usuarios {

	static $section = "usuarios";
	
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

		
		<h2><?echo $id>0 ? $titulo="Modificar Usuario" : $titulo="Insertar nueva usuario";?></h2>
		<form name="insertar" method="post" action="<?echo $PHP_SELF."?section=".HTML_usuarios::$section."&task=save&id=$id" ;?>">

  		<table width="60%" align="center">
		  <tr>
	  	    <td>Nombre: </td>
	  	    <td><input type="text" name="nombre" value="<?echo $row['NOMBRE']?>"></td>
		  </tr>
		  <tr>
	  	    <td>Usuario: </td>
	  	    <td><input type="text" name="usuario" value="<?echo $row['USUARIO']?>"></td>
		  </tr>
		  <tr>
	  	    <td>Clave: </td>
	  	    <td><input type="text" name="clave" value="<?echo $row['CLAVE']?>"></td>
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
	
		echo "<h2>Usuarios</h2>";

		foreach ($result as $fila) {
	
			$row = Array();

			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[COD_USUARIO]\">$fila[NOMBRE]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[COD_USUARIO]\">$fila[USUARIO]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[COD_USUARIO]\">$fila[CLAVE]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=remove&id=$fila[COD_USUARIO]\"><img src=\"".$THEMEDIR."/img/borrar.png\" border=0/></a>";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("Nombre","Usuario","Clave","");
		
		echo cHtml::widget_table("60%",$headers_list,$filas,$columns_size);
		?>

		<br />
		<div class="center">
			<input type='button' onCLick='javascript:window.location="index2.php?section=<?echo $_GET['section']?>&task=new"' value='Nuevo usuario'>
		</div>
	<?}
}
?>