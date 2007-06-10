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
include 'lib/footer.php';
?>
