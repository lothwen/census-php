<?php
session_start();	

//Validar si se ha logueado
if (isset($_COOKIE['data'])) {
	$counter=++$_COOKIE['data[l]'];
	setcookie("data[l]", $counter,time() + (60*60*24));
} else {	
	header("Location: error.php");				
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<link rel="STYLESHEET" href="style/estilo.css" type="text/css">
	<link rel="STYLESHEET" href="style/estilo-tabla.css" type="text/css">
