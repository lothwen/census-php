<?

//Borro las cookies
setcookie("sessionid","",0);

include 'version.php';

include 'lib/config.php';
$THEMEDIR = 'themes/'.$theme;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<title>Euskai Census v1.0</title>
	<link rel="STYLESHEET" href="<?echo $THEMEDIR?>/estilo.css" type="text/css">
	<link rel="STYLESHEET" href="<?echo $THEMEDIR?>/estilo-tabla.css" type="text/css">
</head>

<body>
<div id="container">


	<div id="header"><a href="index.php"><img border="0" alt="cabecera" src="<?echo $THEMEDIR?>/cabecera.gif"></a></div>

	<div id="content" style="text-align: center">
		<h1>Se ha desconectado</h1>
		<a href="index.php"><h2>Volver</h2></a>
	</div>

	<div id="footer" colspan="4"><b>Euskai Eskaut Taldea  Census <?echo $version?> Licensed under the GNU GPL2 License</b><br>
	    <a href="http://validator.w3.org/check?uri=referer">
	    <img class="imagen" src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01 Transitional" height="31" width="88"></a>	
</div>	

</div>
</body>
</html>
