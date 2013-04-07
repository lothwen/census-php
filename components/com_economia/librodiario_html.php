<? 

class HTML_librodiario {

	static $section = "librodiario";
	
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

		$(document).ready(function(){
			// Parametros para e combo1
   			$("#combo1").change(function () {
   				$("#combo1 option:selected").each(function () {
					elegido=$(this).val();
					$.post("combo1.php", { elegido: elegido }, function(data){
						$("#combo2").html(data);
						$("#combo3").html("");
					});			

        });

   })
		</script>

		<h2><?echo $id>0 ? $titulo="Modificar linea" : $titulo="Insertar nueva linea";?></h2>
		<form name="insertar" method="post" action="<?echo $PHP_SELF."?section=$_GET[section]&subsection=$_GET[subsection]&task=save&id=$id" ;?>">

  		<table width="60%" align="center">
		  <tr>
		    <td>Tipo:</td>
		    <td><select name="tipo">
		    	  <option value="0">Ingreso</option>
		    	  <option value="1">Gasto</option>
			</select>
		    </td>
		  </tr>
		  <tr>
	  	    <td>Presupuesto:</td>
	  	    <td><?echo cHTML::widget_select("economia_Presupuestos", "COD_PRESUPUESTO", "NOMBRE", "select_presupuesto");?></td>
		  </tr>
		  <tr>
	  	    <td>Partida:</td>
	  	    <td><?echo cHTML::widget_select("economia_Partidas", "COD_PARTIDA", "NOMBRE", "select_partida");?></td>
		  </tr>
		  <tr>
	  	    <td>Fecha:</td>
	  	    <td><?echo cHTML::widget_date("fecha");?></td>
		  </tr>
		  <tr>
	  	    <td>Importe:</td>
	  	    <td><input type="text" name="importe" size="5" style="text-align:right" onKeyPress='return ensureNumeric(event)'>&nbsp;€</td>
		  </tr>
		  <tr>
	  	    <td>Concepto:</td>
	  	    <td><input type="text" name="concepto"></td>
		  </tr>

		  <tr>
	  	    <td><input class="btn" type="submit" value="Guardar" name="enviar"></td>
	  	    <td><input class="btn" type="reset" value="Restablecer" name="reset"></td>
		  </tr>
	        </table>
	
		</form>

	<?}

	function details( $month, $result ){
	
		global $THEMEDIR;
	
		$months = Array("Enero", "Febrero", "Marzo", "Abril", "Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		
		echo "<h2>Libro diario - Detalles de ".$months[$month-1]."</h2>";

		foreach ($result as $fila) {
	
			$row = Array();

			if($fila['TIPO'] == 0){
				$row[] = $fila['FECHA'];
				$row[] = $fila['CONCEPTO'];
				$row[] = $fila['IMPORTE']."&nbsp;€";
			
				$ingresos[] = $row;
				$total_ingresos += $fila['IMPORTE'];
			}else{		
				$row[] = $fila['FECHA'];
				$row[] = $fila['CONCEPTO'];
				$row[] = $fila['IMPORTE']."&nbsp;€";
				
				$gastos[] = $row;
				$total_gastos += $fila['IMPORTE'];
			}	
		}
		
		$headers_list = Array("Fecha","Concepto","Importe");
		$align = Array("center","left","right");
		
		echo "<center><h3>Ingresos</h3></center><br />";
		echo cHtml::widget_table("90%",$headers_list,$ingresos,$columns_size,$align);
		echo "<br /><center><h3>Gastos</h3></center><br />";
		echo cHtml::widget_table("90%",$headers_list,$gastos,$columns_size,$align);
		?>
		<br />
		<div style="text-align: right; padding-right:20px;">
			<b>Total ingresos: </b><?echo $total_ingresos?>&nbsp;€<br />
			<b>Total gastos: </b><?echo $total_gastos?>&nbsp;€<br />
			<b>Balance: </b><?echo $total_ingresos-$total_gastos?>&nbsp;€
		</div>
		<br />
		<div class="center">
			<a class='btn' href="index2.php?section=<?echo $_GET['section']."&subsection=".$_GET['subsection']?>">Volver</a>
		</div>
	<?
	}
	
	function show( $result ){
	
		global $THEMEDIR;
	
		echo "<h2>Libro diario - Ingresos y gastos</h2>";
		?>
		<br />
		<div class="center">
			<a class='btn' href="index2.php?section=<?echo $_GET['section']."&subsection=".$_GET['subsection']?>&task=new">Nueva linea de Ingreso/Gasto</a>
		</div>
		<br /><br />
		<?

		$months = Array("Enero", "Febrero", "Marzo", "Abril", "Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

		foreach ($result as $fila) {
	
			$row = Array();

			$row[] = "<a href=\"index2.php?section=$_GET[section]&subsection=$_GET[subsection]&task=details&id=$fila[MES]\">".$months[$fila[MES]-1]."</a>";
			$row[] = $fila['INGRESOS']."&nbsp;€";
			$row[] = $fila['GASTOS']."&nbsp;€";
			$row[] = $fila['INGRESOS']-$fila['GASTOS']."&nbsp;€";
	
			$filas[] = $row;
		}
		
		$headers_list = Array("Meses","Ingresos","Gastos","Saldo Mes");
		$align = Array("left","right","right","right");
		
		echo cHtml::widget_table("90%",$headers_list,$filas,$columns_size,$align);
	}
}
?>
