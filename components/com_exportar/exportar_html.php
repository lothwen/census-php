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
        $('#export-btn').removeClass('disabled');
    });
}

function uncheckAll(field){
    $(':checkbox[name^="ramas"]').each(function(index){
        this.checked=false;
        $('#export-btn').addClass('disabled');
    });
}
$(document).ready(function() {
	$("#select_all").click(checkAll);
	$("#select_none").click(uncheckAll);

	$('.check').change(function() {
    		if ($('.check:checked').length) {
        		$('#export-btn').removeClass('disabled');
    		} else {
        		$('#export-btn').addClass('disabled');
    		}
	});
	
	$("#export-btn-group ul li a").click(function(){
		$("#export-frm").attr("action", $("#export-frm").attr("action") + "&task=" + $(this).attr("data-task")) ;
		$("#export-frm").submit();
	});
});
</script>	
<h2>Exportar datos</h2>

<form id="export-frm" method="POST" action="index2.php?section=<?echo $_GET['section']?>">
	<table border="0" align="center">
		<tr>
			<td><span style="font-weight: bold;">Seleccionar</span> <a id="select_all" href="#">Todos</a>&nbsp;/</td>
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
	<div id="export-btn-group" class="btn-group offset2">
		<a class="btn btn-large dropdown-toggle" id="export-btn" data-toggle="dropdown" href="#">Exportar&nbsp;&nbsp;<span class="caret"></span></a>
		<ul class="dropdown-menu">
		   <li><a href="#" data-task="labels">Exportar etiquetas para sobres</a></li>
		   <li><a href="#" data-task="pdf">Exportar datos en PDF</a></li>
		   <li><a href="#" data-task="html">Exportar datos en HTML</a></li>
		</ul>
	</div>
</form>

<fieldset>
	<legend>Total de chavales</legend>
	<table border="0" align="center" class='table table-condensed table-striped'>
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
<?
	}
}
?>
