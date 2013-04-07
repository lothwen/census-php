<? 

class HTML_presupuestos {

	static $section = "presupuestos";
	
	function edit( $id=0, $row ) {

		global $THEMEDIR;
		?>
		
		<style>
		<?echo "@import url('$THEMEDIR/calendar.css');";?>
		</style>
		<script src="js/calendar.js" type=text/javascript></script>
		<script src="js/calendar-es.js" type=text/javascript></script>
		<script src="js/calendar-setup.js" type=text/javascript></script>
	
		<script>
		function ensureNumeric(e){

			tecla = (document.all) ? e.keyCode : e.which; 
    			if (tecla==8) return true; 
    			patron =/\d/;
    			te = String.fromCharCode(tecla);
    			return patron.test(te);
		}
		
		
		function changeType(layer_name){
			var select = eval('document.insertar.select_'+layer_name);
    
			if(select.selectedIndex == 1 || select.selectedIndex == 2){
        			area = document.getElementById('span0_'+layer_name);
       				area.style.visibility='visible';
        			area.style.display='block';
        			
				area = document.getElementById('span1_'+layer_name);
       				area.style.visibility='visible';
        			area.style.display='block';
    			}else{
        			area = document.getElementById('span0_'+layer_name);
       				area.style.visibility='hidden';
        			
				area = document.getElementById('span1_'+layer_name);
       				area.style.visibility='hidden';
    			}
		}
		
		$(document).ready(function(){
		    $("#add_button").click(function(){
		    	$('#partidas_ingresos_table tr:last').clone(true).insertAfter('#partidas_ingresos_table tr:last');
		        return false;
		    });
		    
		    $("#add_button2").click(function(){
		    	$('#partidas_gastos_table tr:last').clone(true).insertAfter('#partidas_gastos_table tr:last');
		        return false;
		    });
		  });

		</script>
		
		<h2><?echo $id>0 ? $titulo="Modificar Presupuesto" : $titulo="Crear nuevo Presupuesto";?></h2>
		<form name="insertar" method="post" action="<?echo $PHP_SELF."?section=".$_GET['section']."&subsection=".$_GET['subsection']."&task=save&id=$id" ;?>">

  		<table width="60%" align="center">
		  <tr>
	  	    <td>Nombre: </td>
	  	    <td><input type="text" name="nombre" value="<?echo $row['NOMBRE']?>"></td>
		  </tr>
		  <tr>
	  	    <td>Fecha inicio: </td>
	  	    <td><?echo cHTML::widget_date("fecha_inicio",$row['FECHA_INICIO']);?></td>
		  </tr>
		  <tr>
	  	    <td>Fecha fin: </td>
	  	    <td><?echo cHTML::widget_date("fecha_fin",$row['FECHA_FINAL']);?></td>
		  </tr>
		</table>
		<br />
		<fieldset>
		<legend>Partidas ingresos</legend>
  		<table width="95%" align="center" id="partidas_ingresos_table">
			<tr>
				<td align="center"><b>Tipo</b></td>
				<td align="center"><b>Nombre</b></td>
				<td align="center"><b>Cantidad</b></td>
				<td align="center" colspan="3"><b>Nº cuotas</b></td>
			</tr>
			<tr>
				<td><select name="tipo[]" id="select_ingresos0" onChange="javascript:changeType('ingresos0');">
					<option value="0">Importe único</option>
					<option value="1">Importe a plazos</option>
					<option value="2">Cuota</option>
				</select></td>
				<td><input type="text" size="17" name="nombre_partida[]"></td>
				<td><input type="text" onKeyPress='return ensureNumeric(event);' size="5" name="cantidad[]"></td>
				<td><span id="span0_ingresos0" style="visibility:hidden">x</span></td>
				<td><span id="span1_ingresos0" style="visibility:hidden"><input type="text" onKeyPress='return ensureNumeric(event);' size="2" maxlength="2" name="numero_plazos[]"></span></td>
				<td><a href="#" id="add_button"><img src="<?echo $THEMEDIR?>/img/addicon.gif" border="0"></a></td>
			</tr>
		</table>	
		</fieldset>
		<br /> <br />
		<fieldset>
		<legend>Partidas gastos</legend>
  		<table width="95%" align="center" id="partidas_gastos_table">
			<tr>
				<td align="center"><b>Tipo</b></td>
				<td align="center"><b>Nombre</b></td>
				<td align="center"><b>Cantidad</b></td>
				<td align="center" colspan="3"><b>Nº cuotas</b></td>
			</tr>
			<tr>
				<td><select name="tipo[]" id="select_gastos0" onChange="javascript:changeType('gastos0');">
					<option value="0">Importe único</option>
					<option value="1">Importe a plazos</option>
				</select></td>
				<td><input type="text" size="17" name="nombre_partida[]" ></td>
				<td><input type="text" onKeyPress='return ensureNumeric(event);' size="5" name="cantidad[]"></td>
				<td><span id="span0_gastos0" style="visibility:hidden">x</span></td>
				<td><span id="span1_gastos0" style="visibility:hidden"><input type="text" onKeyPress='return ensureNumeric(event);' size="2" maxlength="2" name="numero_plazos[]"></span></td>
				<td><a href="#" id="add_button2"><img src="<?echo $THEMEDIR?>/img/addicon.gif" border="0"></a></td>
			</tr>
		</table>	
		</fieldset>
		<br />
  		<table width="60%" align="center">
		  <tr>
	  	    <td><input class="btn" type="submit" value="Guardar" name="enviar"></td>
	  	    <td><input class="btn" type="reset" value="Restablecer" name="reset"></td>
		  </tr>
	        </table>
	
		</form>

	<?}
	
	function details( $result ){
	
		echo "<h2>Detalles de " . $result[0]['NOMBRE']. "</h2>";
		
		foreach ($result as $fila) {
	
			$row = Array();

			$row[] = "<a href=\"index2.php?section=$_GET[section]&subsection=$_GET[subsection]&task=details&id=$fila[COD_PARTIDA]\">$fila[FECHA]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&subsection=$_GET[subsection]&task=details&id=$fila[COD_PARTIDA]\">$fila[CONCEPTO]</a>";
			$row[] = $fila['IMPORTE']."&nbsp;€";
	
			$filas[] = $row;

			$total_gastos += $fila['IMPORTE'];
		}
		
		$headers_list = Array("Fecha","Concepto","Importe");
		$align = Array("center","left","right");
		
		echo cHtml::widget_table("90%",$headers_list,$filas,$columns_size, $align);
		?>

		<br />
		<div style="text-align: right; padding-right:20px;">
			<b>Total Partida: </b><?echo $result[0]['TOTAL']?>&nbsp;€<br />
			<b>Gasto realizado: </b><?echo $total_gastos?>&nbsp;€<br />
			<b>Restante: </b><?echo $result[0]['TOTAL']-$total_gastos?>&nbsp;€
		</div>
	<?}
	
	function show( $actual, $past ){
	
		global $THEMEDIR;
	
		echo "<h2>Presupuesto " . $actual[0]['NOMBRE_PRESUPUESTO']. "</h2>";

		foreach ($actual as $fila) {
	
			$row = Array();

			if($fila['TIPO_PARTIDA'] == 0){
				$row[] = "<a href=\"index2.php?section=$_GET[section]&subsection=$_GET[subsection]&task=details&id=$fila[COD_PARTIDA]\">$fila[NOMBRE_PARTIDA]</a>";
				$row[] = $fila['TOTAL']."&nbsp;€";
				if($fila['BALANCE']=="") $fila['BALANCE']=0; // Set to 0 eur., in case of null value
				if($fila['BALANCE'] > $fila['TOTAL'])
					$row[] = "<span style='color:red;font-weight:bold;'>".$fila['BALANCE']."&nbsp;€</span>";
				else
					$row[] = $fila[BALANCE]."&nbsp;€";
	
				$ingresos[] = $row;

				$total_ingresos += $fila['TOTAL'];
				$total_ingresos_balance += $fila['BALANCE'];
			}else{
				$row[] = "<a href=\"index2.php?section=$_GET[section]&subsection=$_GET[subsection]&task=details&id=$fila[COD_PARTIDA]\">$fila[NOMBRE_PARTIDA]</a>";
				$row[] = $fila['TOTAL']."&nbsp;€";
				if($fila['BALANCE']=="") $fila['BALANCE']=0; // Set to 0 eur., in case of null value
				if($fila['BALANCE'] > $fila['TOTAL'])
					$row[] = "<span style='color:red;font-weight:bold;'>".$fila['BALANCE']."&nbsp;€</span>";
				else
					$row[] = $fila['BALANCE']."&nbsp;€";
	
				$gastos[] = $row;

				$total_gastos += $fila['TOTAL'];
				$total_gastos_balance += $fila['BALANCE'];
			}
		}
		
		$row = Array();
		$row[] = "<b>TOTAL</b>";
		$row[] = "<b>$total_ingresos €</b>";
		$row[] = "<b>$total_ingresos_balance €</b>";
	
		$ingresos[] = $row;
		
		$row = Array();
		$row[] = "<b>TOTAL</b>";
		$row[] = "<b>$total_gastos €</b>";
		$row[] = "<b>$total_gastos_balance €</b>";
	
		$gastos[] = $row;
		
		$headers_list = Array("Partida","Total","Balance");
		$align = Array("left","right","right");
		
		echo "<center><h3>Ingresos</h3></center><br />";
		echo cHtml::widget_table("90%",$headers_list,$ingresos,$columns_size, $align);
		echo "<center><h3>Gastos</h3></center><br />";
		echo cHtml::widget_table("90%",$headers_list,$gastos,$columns_size, $align);
		
		unset($filas); // Clear the data of the previous table
		?>
		<br />
		<div class="center">
			<a class='btn' href="index2.php?section=<?echo $_GET['section']."&subsection=".$_GET['subsection']?>&task=new">Nuevo presupuesto</a>
		</div>
		<br /><br />
		<h2>Años anteriores</h2>

		<?
		foreach ($past as $fila) {
	
			$row = Array();

			$row[] = "<a href=\"index2.php?section=$_GET[section]&subsection=$_GET[subsection]&task=show&id=$fila[COD_PRESUPUESTO]\">$fila[NOMBRE]</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&subsection=$_GET[subsection]&task=show&id=$fila[COD_PRESUPUESTO]\">$fila[APELLIDOS] €</a>";
			$row[] = "<a href=\"index2.php?section=$_GET[section]&subsection=$_GET[subsection]&task=show&id=$fila[COD_PRESUPUESTO]\">$fila[TELEFONO] €</a>";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("Nombre","Total","Balance");
		$align = Array("left","right","right");
		
		echo cHtml::widget_table("90%",$headers_list,$filas,$columns_size, $align);
	}
}
?>
