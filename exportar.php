<?
include 'lib/cab0.php';
?>
<title>Euskai Census v1.0 : Exportar datos</title>
</head>
<?
include 'lib/cab1.php';
?>
<h2>Por hacer !</h2>
<form action="pdf_cartas.php" method="post">
<input type="hidden" name="query" value="SELECT ID,NOMBRE,APELLIDOS,RAMA FROM censo">
<input type="submit" name="cartas" value="Exportar para cartas">
</form>
<?
include 'lib/footer.php';
?>'
