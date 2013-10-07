<? 

class HTML_pagoseeb {

	static $section = "pagoseeb";
	
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
	
		echo "<h2>Pagos pendientes EEB</h2>";

		foreach ($result as $fila) {
	
			$row = Array();

			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[FECHA]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[CONCEPTO]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&task=edit&id=$fila[ID]\">$fila[IMPORTE]</a>";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("Fecha","Concepto","Importe");
		
		echo cHtml::widget_table("90%",$headers_list,$filas,$columns_size);
	}
}
?>
