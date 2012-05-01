<?php
session_start();	

require 'includes/cMysql.php';
require 'includes/cSettings.php';
require 'includes/cHtml.php';

$db = new cMysql();
include 'includes/session_auth.php';

// Select the session database.
$db->select_db("census_".$_SESSION['val_nombre_bbdd']);

$conf = new cSettings();

// This var is used to access theme style and images.
$THEMEDIR = 'themes/'.$conf->getSetting('theme');
if(!is_dir($THEMEDIR)) $THEMEDIR = 'themes/default/'; // Jump to default theme if not exist.
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<title><?echo $conf-> getSetting('group_name').  " Census ".$conf-> getSetting('version');?></title>
	<link rel="STYLESHEET" href="<?echo $THEMEDIR?>/estilo.css" type="text/css">
	<link rel="STYLESHEET" href="<?echo $THEMEDIR?>/menuMatic.css" type="text/css">
	<link rel="STYLESHEET" href="<?echo $THEMEDIR?>/estilo-tabla.css" type="text/css">
</head>

<body>
<div id="container">
	
	<div id="header">
		<?if (is_file($THEMEDIR."/img/cabecera.gif")){?>
			<a href="portada.php"><img border="0" alt="Cabecera" src="<?echo $THEMEDIR?>/img/cabecera.gif"></a>
		<?}else{?>
			<div id="headerimg">
				<h1><a href="portada.php">Census</a></h1>
				<div class="description">La herramienta eskaut</div>
			</div>
		<?}

		include 'includes/nav-menu.php';
		?>

	</div>

	<?include 'includes/sidebar.php';?>
	
	<div id="content">
		<div id="body">
