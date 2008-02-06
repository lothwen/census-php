<html>

<head></head>
 
<body>
<?
include("lib/conexionbd.php");

for($rama=1;$rama<7;$rama++){

	$sql2 = "select NOMBRE from ramas where ID=".$rama;
	$consulta2 = f_leer($sql2);
	$fila2 = mysql_fetch_array($consulta2);
	$nombre_rama = $fila2['NOMBRE'];
?>
	<h2><?echo $nombre_rama?></h2>
	<table border=1 style="border-collapse:collapse" width="50%">
		<tr>	
			<td><b>NOMBRE</b></td>
			<td><b>APELLIDOS</b></td>
			<td><b>DNI</b></td>
		</tr>
	<?
	$sql = "select NOMBRE,APELLIDOS,DNI,DNI_AMA,DNI_AITA from census where RAMA=".$rama;
	$consulta = f_leer($sql);

	while($fila=mysql_fetch_array($consulta)){

		 echo "<tr>";
	         echo "<td>".$fila['NOMBRE']."</td>";
		 echo "<td>".$fila['APELLIDOS']."</td>";
	         if ($fila['DNI']!="")
		         echo "<td>".$fila['DNI']."</td>";
		 elseif($fila['DNI_AMA'])
		         echo "<td>".$fila['DNI_AMA']." (Ama)</td>";
		 elseif($fila['DNI_AITA'])
		         echo "<td>".$fila['DNI_AITA']." (Aita)</td>";
	   	 else
			 echo "<td>Faltan datos</td>";

		 echo "</tr>";
	 }
?>
</table>
<?}?>
</html>

