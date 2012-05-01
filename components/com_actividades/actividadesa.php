<?
$nombre_seccion="Nueva actividad";
include 'includes/html_heads.php';
include 'version.php';

if ($borrar){

	$sSql = "DELETE FROM actividades WHERE ID=".$_GET['borrar'];
	$db-> f_sql($sSql);

	$sSql = "DELETE FROM actividadChaval WHERE ID=".$_GET['borrar'];
	$db-> f_sql($sSql);

	Header("Location: actividadesl.php");
}

if ($nuevo){

	$sSql = "INSERT INTO actividades VALUES('','$nombre','".cambiaf_a_mysql($fecha)."','$abierta')";
	$db-> f_sql($sSql);

	Header("Location: actividadesl.php");
}

if ($actualizar){

	$sSql = "UPDATE actividades SET NOMBRE='$nombre', ACOMPANANTES=$abierta, FECHA='".cambiaf_a_mysql($fecha)."' WHERE ID=".$id;
	$db-> f_sql($sSql);

	Header("Location: actividadesl.php");
}

?>
<style>
<?echo "@import url('$THEMEDIR/calendar.css')";?>
</style>
<script src="js/calendar.js" type=text/javascript></script>
<script src="js/calendar-es.js" type=text/javascript></script>
<script src="js/calendar-setup.js" type=text/javascript></script>

<?

if ($editar){
	$sSql = "SELECT * FROM actividades WHERE ID=".$_GET['editar'];
	$row= current(f_sql($sSql));
}?>
	<h2><?echo $nombre_seccion?></h2>
	<form action="actividadesa.php" mehod="post">
		<table align="center">
		<tr>
			<td>Nombre: </td>
			<td><input type="text" name="nombre" value="<?if($editar) echo $row['NOMBRE']?>"></td>
		</tr>
		<tr>
			<td>Actividad Abierta: </td>
			<td><select name="abierta">
				<option value="1">Si</option>
				<option value="0">No</option>
			</select></td>
		</tr>
		<tr>
			<td>Fecha: </td>
			<td><input  id="fecha" name="fecha"value="<?if($editar) echo $row['FECHA']?>"> <input id="boton_lanzador" type="button" value="..."><br></td>
		<script type=text/javascript>
			Calendar.setup({
			inputField:"fecha",// id del campo de texto
			ifFormat:"%d/%m/%Y",// formato de la fecha, cuando se escriba en el campo de texto
			button:"boton_lanzador"});// el id del botón que lanzará el calendario
		</script>
		</tr>
		<tr height="20"></tr>
		<tr>
		<td></td>
		<?if ($editar){
			echo "<input type=\"hidden\" name=\"id\" value=\"".$row['ID']."\">";
			echo "<td align=\"right\"><input class=\"button\"type=\"submit\" name=\"actualizar\" value=\"Actualizar Actividad\"></td>";
		}else{
			echo "<td align=\"right\"><input class=\"button\"type=\"submit\" name=\"nuevo\" value=\"Nueva Actividad\"></td>";
		}?>
		</tr>
		</table>
	</form>
<?
include 'includes/footer.php';
?>
