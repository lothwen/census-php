<?
include 'lib/cab0.php';
include 'version.php';
include 'lib/conexionbd.php';
include 'lib/utils.php';
?>
	<title>Euskai Census <?echo $version?> : Actividades</title>
</head>
<?
include 'lib/cab1.php';
?>

<table class="mi_tabla">
	<tr>
		<th class="cab_tabla">Nombre</th>
		<th class="cab_tabla">Fecha</th>
		<th class="cab_tabla"></th>
	</tr>
<?
$sSql = "SELECT * FROM actividades WHERE FECHA > ";
$sSql .= date("d-m-Y");

$result = f_leer($sSql);

while($row = mysql_fetch_array($result)){
	$contador++;
	if ($contador % 2 == 0)
		$clase = "tr_par";
	else
		$clase = "tr_impar";
?>
	<tr class="<?echo $clase?>">
		<td><a href="actividades2.php?id=<?echo $row['ID']?>&abierta=<?echo $row['ACOMPANANTES']?>"><?echo $row['NOMBRE']?></a></td>
		<td><?echo cambiaf_a_normal($row['FECHA'])?></td>
		<td><a href="actividadesa.php?editar=<?echo $row['ID']?>"><img src="images/editar.png" border="0"></a>
		    <a href="actividadesa.php?borrar=<?echo $row['ID']?>"><img src="images/borrar.png" border="0"></a></td>
	</tr>
<?}?>

</table>
		<br><center><input type="button" value="Nuevo" onClick="window.location='actividadesa.php';"></center>



<?
include 'lib/footer.php';
?>
