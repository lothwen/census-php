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
	 * Devuelve el codigo html correspondiente a un selector de hora.
	 * @param string $hourname Nombre del selector de hora.
	 * @param string $minutesname Nombre del selector de minutos.
	 * @param integer $initialhour Hora inicial. Default: 08
	 * @param integer $finalhour Hora Final. Default: 20
	 * @param integer $minuteinc Incremento a aplicar a los minutos. Default: 1
	 * return string
	 */
	function widget_time($hourname, $minutesname, $minuteinc=15, $initialhour=8, $finalhour=20) {

		//Comprobaciones para que no entren datos incongruentes ;-)
		if($initialhour<0 || $initialhour>23) $initialhour="00";
		if($finalhour<0 || $finalhour>23) $finalhour="23";

		$retorno = "<select name='$hourname' class='date'>";
			
		for($i=$initialhour;$i<=$finalhour;$i++)
			$retorno .= "<option value='$i'>".sprintf("%02d",$i)."</option>";
			
		$retorno .= "</select>:";
		
		$retorno .= "<select name='$minutesname' class='date'>";
		
		for($i=0;$i<60;$i+=$minuteinc)
			$retorno .= "<option value='$i'>".sprintf("%02d",$i)."</option>";
		
		$retorno .= "</select></b>";

		return $retorno;
	
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
 * @param string $onchangescript Nombre y parametros de la funcion javascript a ejecutar en el onchange.
 * @param string $condition condicion de filtrado de la tabla de la bbdd.
 * @return string 
 */
function widget_select($ddbbtable,$ddbbid,$ddbbname,$selectname,$defaultid=NULL,$onchangescript=NULL,$condition=NULL,$obligatory=NULL) {
	
	global $db; 

	if (is_array($ddbbname ))  $NAME = implode(",",$ddbbname);
	else $NAME = $ddbbname;

	if ($condition != NULL) $where = " where $condition ";
	else $where = "";


	if ($onchangescript!="")
		$onchange="onChange=\"javascript:$onchangescript\"";
	else
		$onchange = "";

	$retorno = "
			<div id='div$selectname' style='display:inline'>
			<select class='select' name='$selectname' id='$selectname' $onchange>";
	if ($obligatory==NULL)
		$retorno .= "<option value='0'>Seleccione una opcion</option>";
	
	$sql = "select $ddbbid,$NAME from $ddbbtable $where order by $NAME";
	foreach ($db-> f_sql($sql) as $fila){
		$cod_cargo = $fila[$ddbbid];
		if ($cod_cargo==$defaultid) $select = "selected";
		else $select = "";
		$NOMBRE = "";
		if (is_array($ddbbname )) {
			for ($j=0; $j<count($ddbbname); $j++) {
				$n = $ddbbname[$j];
				$NOMBRE .= " ".$fila[$n];
			}
		}
		else $NOMBRE = $fila[$ddbbname];

		$retorno .= "<option value='$cod_cargo' $select>".$NOMBRE."</option>";	
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
             echo "      <th width='".$tamanhos[$i]."'>".$header_list[$i]."</th> \n";
 
             echo "
                 </tr>
             </thead>
             ";
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
     echo " 
         </tbody>
         </table>
         ";
 
}

}
?>
