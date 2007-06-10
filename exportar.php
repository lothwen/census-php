<?
include 'lib/cab0.php';
include 'version.php';
?>
	<title>Euskai Census <?echo $version?> : Exportar datos</title>
</head>
<?
include 'lib/cab1.php';
?>
<form action="pdf_cartas.php" method="post">
<table align="center" border="0">
	<tr>
		<td>Impresion de etiquetas para sobres.</td>
	</tr>
	<tr>
		<td><input type="checkbox" name="todos">Todos</td>
	</tr>

	<tr>
		<td><input type="checkbox" name="koskorrak">Koskorrak</td>
	</tr>

	<tr>
		<td><input type="checkbox" name="kaskondoak">Kaskondoak</td>
	</tr>

	<tr>
		<td><input type="checkbox" name="oinarinak">Oinarinak</td>
	</tr>

	<tr>
		<td><input type="checkbox" name="azkarrak">Azkarrak</td>
	</tr>

	<tr>
		<td><input type="checkbox" name="trebeak">Trebeak</td>
	</tr>
	
	<tr>
		<td><input type="checkbox" name="arduradunak">Arduradunak</td>
	</tr>
	
	<tr>
		<td><input type="submit" name="cartas" value="Exportar para cartas"></td>
	</tr>
</table>
</form>

<?
$sSql = "SELECT COUNT(ID) FROM census GROUP BY RAMA";
$result = f_leer($sSql);
while($row = mysql_fetch_array($result))
        $total_ramas[] = $row[0];

?>

<table align="center" border="0">
        <tr>
                <th>Rama</td>
                <th>Total</td>
        </tr>   
                <td>Arduradunak</td>
                <td><?echo $total_ramas[0]?></td>
        </tr>   
        <tr>
                <td>Koskorrak</td>
                <td><?echo $total_ramas[1]?></td>
        </tr>   
        <tr>
                <td>Kaskondoak</td>
                <td><?echo $total_ramas[2]?></td>
        </tr>   
        <tr>
                <td>Oinarinak</td>
                <td><?echo $total_ramas[3]?></td>
        </tr>   
        <tr>
                <td>Azkarrak</td>
                <td><?echo $total_ramas[4]?></td>
        </tr>   
        <tr>
                <td>Trebeak</td>
                <td><?echo $total_ramas[5]?></td>
        </tr>   
</table>

<form action="pdf.php" method="post">
        <input type="hidden" name="sentencia" value="SELECT * FROM censo">
        <center><input type="submit" name="generar" value="Exportar Censo en formato pdf"></center>
</form>

<?
include 'lib/footer.php';
?>
