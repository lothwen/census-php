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

if (isset($_POST['cod_actividad'])) {
	$codigo = $_POST['cod_actividad'];
	$abierta = $_POST['abierta'];
} else { 
	$codigo = $_GET['id'];
	$abierta = $_GET['abierta'];
}

if (isset($_POST['nuevo'])){
	$sSql = "INSERT INTO actividadChaval VALUES('','".$codigo."','".$_POST['asistente']."','".$_POST['num_acom']."')";
	f_ejecutar($sSql);
}
?>

<form action="actividades2.php" method="post">


<select name="asistente">
<?
$sSql = "SELECT ramas.NOMBRE as RAMA, census.ID, census.NOMBRE, census.APELLIDOS FROM ramas,census WHERE census.RAMA = ramas.ID ORDER BY census.RAMA";
$result = f_leer($sSql);


while($row=mysql_fetch_array($result)){

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
<input type="submit" name="nuevo" value="Nuevo asistente">
</form>
<?
$sSql = "SELECT actividadChaval.NUM_ACOM, census.NOMBRE, census.APELLIDOS ";
$sSql .= "FROM  actividadChaval,census ";
$sSql .= "WHERE actividadChaval.COD_CHAVAL = census.ID AND COD_ACTIVIDAD='".$codigo."'";

$result = f_leer($sSql);
$numFilas = mysql_num_rows($result);

if ($numFilas > 0){?>

	<br>
	<table class="tabla2" border="1">
		<tr>
			<th>Asistente</th>
			<? if($abierta) echo "<th>Nº de Acom.</th>";?>
		</tr>
	<?
	while($row=mysql_fetch_array($result)){

		echo "<tr>";
			echo "<td>".$row['NOMBRE']." ". $row['APELLIDOS']."</td>";
			if ($abierta){ 
				echo "<td><".$row['NUM_ACOM']."</td>";
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
include 'lib/footer.php';
?>
