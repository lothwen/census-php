<? 

class HTML_exportar {

	static $section = "exportar";
	
	function show(){
	
		global $THEMEDIR, $db;
?>
<script type="text/javascript">
function checkAll(field){
    $(':checkbox[name^="ramas"]').each(function(index){
        this.checked=true;
        $('#submit_labels').removeAttr('disabled');
    });
}

function uncheckAll(field){
    $(':checkbox[name^="ramas"]').each(function(index){
        this.checked=false;
        $('#submit_labels').attr('disabled', 'disabled');
    });
}
$(document).ready(function() {
	$("#select_all").click(checkAll);
	$("#select_none").click(uncheckAll);

	$('.check').change(function() {
    		if ($('.check:checked').length) {
        		$('#submit_labels').removeAttr('disabled');
    		} else {
        		$('#submit_labels').attr('disabled', 'disabled');
    		}
	});
});
</script>	
<h2>Exportar datos</h2>

<div class="center">

	<fieldset>
		<legend>Impresión de etiquetas para sobres</legend>
		<form id="form_labels" method="POST" action="index2.php?section=<?echo $_GET['section']?>&task=labels">
			<table border="0" align="center">
				<tr>
					<td>Seleccionar <a id="select_all" href="#">Todos</a>&nbsp;/</td>
					<td><a id="select_none" href="#">Ninguno</a></td>
				</tr>
				<? 
				$sql = "select ID, NOMBRE from ramas";
				foreach($db-> f_sql($sql) as $rama){?>
				<tr>
					<td><?echo $rama['NOMBRE']?></td>
					<td><input class="check" type="checkbox" name="ramas[]" value="<?echo $rama['ID']?>" checked="checked"></td>
				</tr>
				<?}?>
			</table>
			<br/>
			<input type="submit" id="submit_labels" value="Impresión de etiquetas">
		</form>
	</fieldset>

	<fieldset>
		<legend>Exportar datos</legend>
        	<a href="index2.php?section=<?echo $_GET['section']?>&task=pdf" ><img alt="Exportar Censo en formato pdf" src="<?echo $THEMEDIR?>/img/pdf-icon-big.gif" /></a>
		<br />
		<input type="button" onCLick="javascript:window.location='index2.php?section=<?echo $_GET['section']?>&task=html'" value="Exportar a html plano">
	</fieldset>

	<fieldset>
		<legend>Total de chavales</legend>
		<table border="0" align="center">
        		<tr>
                		<th>Rama</th>
                		<th>Total</th>
        		</tr>      
			<?
			$sSql = "SELECT ramas.NOMBRE, COUNT(censo.ID) as total FROM ramas "
			. "left join censo on ramas.ID = censo.RAMA GROUP BY ramas.ID";

			foreach($db-> f_sql($sSql) as $row){?>
	        		<tr>
	                		<td><?echo $row['NOMBRE']?></td>
	                		<td><?echo $row['total']?></td>
	        		</tr>   
			<?}?>
		</table>
	</fieldset>
</div>
<?
	}
}
?>
