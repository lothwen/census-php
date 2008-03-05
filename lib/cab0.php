<?php
session_start();	

//Validar si se ha logueado
if (!isset($_COOKIE['sessionid']))
//	header("Location: error.php");				

include 'lib/config.php';

$THEMEDIR = 'themes/'.$theme.'_'.$database;
if(!is_dir($THEMEDIR)) $THEMEDIR = 'themes/'.$theme;

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<link rel="STYLESHEET" href="<?echo $THEMEDIR?>/estilo.css" type="text/css">
	<link rel="STYLESHEET" href="<?echo $THEMEDIR?>/estilo-tabla.css" type="text/css">
