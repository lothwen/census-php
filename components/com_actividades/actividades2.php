<?
$nombre_seccion="Actividades";
include 'includes/html_heads.php';
include 'version.php';

if (isset($_POST['cod_actividad'])) {
	$codigo = $_POST['cod_actividad'];
	$abierta = $_POST['abierta'];
} else { 
	$codigo = $_GET['id'];
	$abierta = $_GET['abierta'];
}

if (isset($_POST['nuevo'])){
	$sSql = "INSERT INTO actividadChaval VALUES('','".$codigo."','".$_POST['asistente']."','".$_POST['num_acom']."')";
	$db-> f_sql($sSql);
}
?>

<form action="actividades2.php" method="post">


<select name="asistente">
<?
$sSql = "SELECT ramas.NOMBRE as RAMA, censo.ID, censo.NOMBRE, censo.APELLIDOS FROM ramas,censo WHERE censo.RAMA = ramas.ID ORDER BY censo.RAMA";

foreach($db-> f_sql($sSql) as $row){

	if (!isset($rama)){
		echo "	<optgroup label=\"".$row['RAMA']."\">\n";
		$rama=$row['RAMA'];

	}elseif ($rama != $row['RAMA']){
		echo "	</optgroup>\n	<optgroup label=\"".$row['RAMA']."\">\n";
		$rama=$row['RAMA'];

	}else{
		echo "		<option value=\"".$row['ID']."\">".$row['NOMBRE']." ".$row['APELLIDOS']."</option>\n";
	}
}
?>
	</optgroup>
</select>

<? if ($abierta){ ?>
	<select name="num_acom">
		<option>0</option>
		<option>1</option>
		<option>2</option>
		<option>3</option>
		<option>4</option>
		<option>5</option>
		<option>6</option>
	</select>
<?}?>

<input type="hidden" name="cod_actividad" value="<?echo $codigo?>">
<input type="hidden" name="abierta" value="<?echo $abierta?>">
<input class="btn" type="submit" name="nuevo" value="Nuevo asistente">
</form>
<?
$sSql = "SELECT actividadChaval.NUM_ACOM, censo.NOMBRE, censo.APELLIDOS ";
$sSql .= "FROM  actividadChaval,censo ";
$sSql .= "WHERE actividadChaval.COD_CHAVAL = censo.ID AND COD_ACTIVIDAD='".$codigo."'";

$filas = $db-> f_sql($sSql);

if (count($filas) > 0){?>

	<br>
	<table class="tabla2" border="1">
		<tr>
			<th>Asistente</th>
			<? if($abierta) echo "<th>Nº de Acom.</th>";?>
		</tr>
	<?
	foreach($db-> f_sql($sSql) as $row){

		echo "<tr>";
			echo "<td>".$row['NOMBRE']." ". $row['APELLIDOS']."</td>";
			if ($abierta){ 
				echo "<td>".$row['NUM_ACOM']."</td>";
				$total_asistentes += $row['NUM_ACOM'] + 1;
			} else {
				$total_asistentes++;
			} 
		echo "</tr>";
	}
	echo "</table>";
	echo "<br>";
	echo "Total asistentes: ".$total_asistentes;
} else {

	echo "No hay Asistentes a esta actividad.";
}
?>
<?
include 'includes/footer.php';
?>
