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
$theme = $conf->getsetting('theme');
if($theme!=''){
	$THEMEDIR = 'themes/'.$theme;
	if(!is_dir($THEMEDIR)) $THEMEDIR = 'themes/default/'; // Jump to default theme if not exist.
}else{
	$THEMEDIR = 'themes/default/'; // Jump to default theme if not exist.
}
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

	<link type="text/css" href="js/fg-menu/fg.menu.css" media="screen" rel="stylesheet" />
    	<link type="text/css" href="js/fg-menu/theme/ui.all.css" media="screen" rel="stylesheet" />

	<!-- External jquery js -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="js/fg-menu/fg.menu.js"></script>

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
		// Navigation Menu
		include 'includes/nav-menu.php';
		?>

	</div>

	<?include 'includes/sidebar.php';?>
	
	<div id="content">
		<div id="body">
