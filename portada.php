<?
include 'lib/cab0.php';
include 'version.php';
?>
	<title>Euskai Census <?echo $version?> : Portada</title>
</head>
<?
include 'lib/cab1.php';
?>
	<center><h2> Census <?echo $version?></h2></center>

<p> Bienvenid@ a Census</p>

<p>Census es una simple aplicación web para llevar el censo de los chavales apuntados a un grupo eskaut. El objetivo
de la misma es facilitarle la vida al coordinador del grupo, ya que de esta manera, los datos de los chavales se
encuentran siempre accesibles y centralizados. Con esto evitamos el tener copias de censos desactualizados y permitimos el acceso a los datos de los chavales al resto de monitores.</p>
<p>Entre las posibilidades que nos ofrece esta herramienta encontramos:</p>
<ul>
	<li> Añadir, modificar y eliminar chavales al censo.
	<li> Hacer busquedas con varios criterios de busqueda.
	<li> Exportar en formato pdf las busquedas que hagamos.
	<li> Exportar etiquetas para pegar en sobres con la dirección de los chavales.
</ul>

<p> Si quieres visitar la pagina web del grupo, deberas dirigirte a <a href="http://euskai.org">http://euskai.org</a></p>

<center><img alt="flor-lis.png" src="<?echo $THEMEDIR?>/img/flor-lis.png"></center>
<?include 'lib/footer.php'?>
