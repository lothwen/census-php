<?
$nombre_seccion="Actividades";
include 'includes/html_heads.php';
include 'version.php';
?>

<h2><?echo $nombre_seccion?></h2>
<table class="mi_tabla">
	<tr>
		<th class="cab_tabla">Nombre</th>
		<th class="cab_tabla">Fecha</th>
		<th class="cab_tabla"></th>
	</tr>
<?
$sSql = "SELECT * FROM actividades WHERE FECHA > " . date("d-m-Y");

foreach($db-> f_sql($sSql) as $row){
	$contador++;
	if ($contador % 2 == 0)
		$clase = "tr_par";
	else
		$clase = "tr_impar";
?>
	<tr class="<?echo $clase?>">
		<td><a href="actividades2.php?id=<?echo $row['ID']?>&abierta=<?echo $row['ACOMPANANTES']?>"><?echo $row['NOMBRE']?></a></td>
		<td><?echo $row['FECHA']?></td>
		<td><a href="actividadesa.php?editar=<?echo $row['ID']?>"><img src="<?echo $THEMEDIR?>/img/editar.png" border="0"></a>
		    <a href="actividadesa.php?borrar=<?echo $row['ID']?>" class="confirm-delete" data-id="<?echo $row['ID']?>"><i class="icon-trash" title="Borrar"></i></a></td>
	</tr>
<?}?>

</table>

<br><center><input class="btn" type="button" value="Nuevo" onClick="window.location='actividadesa.php';"></center>

<?
include 'includes/footer.php';
?>
