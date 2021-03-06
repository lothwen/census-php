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
	function widget_date($inputname, $defaultdate=NULL) {
		return '<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="'.$defaultdate.'" id="'.$inputname.'-container" class="input-append date">
				<input type="text" value="'.$defaultdate.'" name="'.$inputname.'" size="16" class="span">
				<span class="add-on"><i class="icon-calendar"></i></span>
			</div>
			<script>$("#'.$inputname.'-container").datepicker({
								"setValue": "'.$defaultdate.'",
								"format": "dd/mm/yyyy"
			});</script>
			';
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
			else $select = "";
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

	/**
	 * Devuelve el codigo html y javascript correspondiente a una ventana modal para la
	 * confirmación de una acción puntual.
	 * @param string $title Titulo de la ventana modal.
	 * @param string $ddbbid Campo de la tabla que se va a usar como VALUE en el select.
	 * @return string 
	 */
	function widget_deleteModal($section, $title="Borrado", $text="Se va a borrar un registro de la base de datos.") {?>

		<div id="myModal" class="modal hide">
    		    <div class="modal-header">
        		<a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         		<h3><?=$title?></h3>
    		    </div>
    		    <div class="modal-body">
        		<p><?=$text?></p>
        		<p>¿Quieres continuar?</p>
    		    </div>
    		    <div class="modal-footer">
      			<a href="#" id="btnYes" class="btn">Sí</a>
      			<a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
    		    </div>
		</div>

		<script type="text/javascript">
		    $(document).ready(function() {
			$(".confirm-delete").on("click", function(e) {
    			    e.preventDefault();
			    var id = $(this).data("id");
    			    $("#myModal").data("id", id).modal("show");
			});

			$("#btnYes").click(function() {
    			    // handle deletion here
  			    var id = $("#myModal").data("id");
  			    $("[data-id="+id+"]").parent().parent().fadeOut();
			    $.ajax({
				type: "POST",
				url: "index2.php?section=<?=$section?>&task=remove&id=" + id,
			    })
			    .done(function( msg ) {
  			    	$("#myModal").modal("hide");
			    });
			});
		    });
		</script>
	<?}
}
?>
