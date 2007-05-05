<?php 
	//Validar que el usuario tiene
 	session_start();	
	//Validar el usaurio 
	if (!isset($val_usuario)) {		
		header("Location: error.php");				
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<title>Euskai Census v1.0</title>
	<link rel="STYLESHEET" href="style/estilo.css" type="text/css">
	<link rel="STYLESHEET" href="style/estilo-tabla.css" type="text/css">
</head>

<body>
<table id="container" width="70%" align="center">

<tr>
	<td id="header" colspan="4"><a href="index.php"><img border="0" alt="logo.png" src="images/logo.png"></a></td>
</tr>

<tr>

	<td class="menu"><a href="./formulario.php">Insertar un nuevo chaval/a</a></td>
	<td class="menu"><a href="./busqueda.php">Realizar una busqueda</a></td>
	<td class="menu"><a href="./exportar.php">Exportar datos</a></td>
</tr>

<tr>
	<td id="content" colspan="4">
