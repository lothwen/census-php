<?		
/*
 * cHtml.php
 *
 * Html code helper
 *
 * Based on html_widgets.php
 */


class cHtml {

	function __construct(){
	}

	/**
	 * Devuelve el codigo html correspondiente a un selector de fecha.
	 * @param string $inputname Nombre del selector de fecha.
	 * @param string $defaultdate Opcional fecha por defecto.
	 * return string
	 */
	function widget_date($inputname,$defaultdate=NULL,$onchangescript=NULL) {
		$id_fechaini = "f".rand("1000","4000");
		$id_boton = "b".rand("1000","4000");
		if ($onchangescript!=NULL) 
			$onchange="onChange=\"javascript:$onchangescript\"";
		$retorno = "
			<input class='text' id='$id_fechaini' name='$inputname' style='width: 70px' value='$defaultdate' $onchange> 
			<input id='$id_boton' value='...' type='button' class='input_botonfecha'> 
				<SCRIPT type=text/javascript>
					Calendar.setup({
	 				inputField     :    \"$id_fechaini\",     
					ifFormat       :    \"%d/%m/%Y\",   
					button         :    \"$id_boton\"   
					});
				</SCRIPT>";
		return $retorno;
	}	

	/**
	 * Devuelve el codigo html correspondiente al tag select que se quiere generar.
	 * @param string $ddbbtable Nombre de la Tabla de la bbdd de la cual se quiere hacer el select.
	 * @param string $ddbbid Campo de la tabla que se va a usar como VALUE en el select.
	 * @param array $ddbbname Campos de la tabla que se van a mostrar en el desplegable.
	 * @param string $selectname Nombre que se le asignara al select al crear el codigo html.
	 * @param string $defaultid VALUE seleccionado por defecto en el select.
	 * @param string $condition condicion de filtrado de la tabla de la bbdd.
	 * @return string 
	 */
	function widget_select($ddbbtable,$ddbbid,$ddbbname,$selectname,$defaultid=NULL,$condition=NULL) {
	
		global $db; 

		if (is_array($ddbbname ))  $NAME = implode(",",$ddbbname);
		else $NAME = $ddbbname;

		if ($condition != NULL) $where = " where $condition ";
		else $where = "";

		$retorno = "<div id='div$selectname' style='display:inline'>
		    		<select class='select' name='$selectname' id='$selectname' required>
				    <option value=''>Seleccione una opción</option>";
	
		$sql = "select $ddbbid,$NAME from $ddbbtable $where order by $NAME";
		foreach ($db-> f_sql($sql) as $fila){
			$id = $fila[$ddbbid];
			if ($id == $defaultid) $select = "selected";
			if (is_array($ddbbname )) {
				for ($j=0; $j<count($ddbbname); $j++) {
					$n = $ddbbname[$j];
					$NOMBRE .= " ".$fila[$n];
				}
			}
			else $NOMBRE = $fila[$ddbbname];
			$retorno .= "<option value='$id' $select>".$NOMBRE."</option>";	
		}

		$retorno .= "</select></div>";
		return $retorno;
	}


	function widget_table($width,$header_list,$filas,$tamanhos=NULL, $align=NULL) {
	
		echo "<table class='table_list' width='$width' align='center' >";
 
     		if (count($filas)>0) {
         		echo "
             		<thead>
                 	  <tr>";
         		for ($i=0; $i<count($header_list); $i++)
             			echo "    <th width='".$tamanhos[$i]."'>".$header_list[$i]."</th> \n";
             			echo "
                 			  </tr>
             				</thead>";
             	}
 
     		echo "<tbody>";
    		if (count($filas)<1) {
         		echo "<tr class='linea2' colspan='".count($header_list)."'><td>No se han encontrado resultados.</td></tr>";
         	}
 
     		for ($i=0; $i<count($filas); $i++) {
         		$fila = $filas[$i];
         		$class = "linea2";
         		if ($i%2==0)
             			$class = "linea1";
         		echo "<tr class='$class'>";
         		for ($j=0; $j<count($fila); $j++)
             			echo "<td align='".$align[$j]."'>".$fila[$j]."</td>";
         		echo "</tr>";
         	}

     		echo "</tbody>
         	   </table>";

	}

}
?>
