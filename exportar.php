<?
include 'lib/cab0.php';
?>
<title>Euskai Census v1.0 : Exportar datos</title>
</head>
<?
include 'lib/cab1.php';
?>
<form action="pdf_cartas.php" method="post">
<table align="center" width="30%" border="0">
	<tr height="60"><td></td></tr>
	<tr>
		<td>Impresión de etiquetas para sobres.</td>
	</tr>
	<tr>
		<table>
		<tr>
			<td>Rama: </td>
			<td><select size="1" name="rama">
				<option value="6">Todas</option>
				<option value="1">Koskorrak</option>
				<option value="2">Kaskondoak</option>
				<option value="3">Oinarinak</option>
				<option value="4">Azkarrak</option>
				<option value="5">Trebeak</option>
				<option value="0">Arduradunak</option>
			</select></td>
		</tr>
		</table>
	</tr>
	<tr>
		<td>
		<input type="submit" name="cartas" value="Exportar para cartas">
		</td>
	</tr>
</table>
</form>
<?
include 'lib/footer.php';
?>'
