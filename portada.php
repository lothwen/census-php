<?
include 'includes/html_heads.php';
?>
<br />
<center><h2> <?echo $conf-> getSetting('group_name'); ?> Census <?echo $conf-> getSetting('version');?></h2></center>

<h4> Bienvenid@ a Census</h4><br />

<h2 style='color:red;font-weight:bold'>ULTIMOS CAMBIOS:</h2>
<ul>
	<li><h3 style='color:red'>ARREGLADOS FALLOS EN IMPRESIÓN DE ETIQUETAS</h3></li>
	<li><h3 style='color:red'>Si faltan códigos postales, habría que completar las fichas de los chavales que les falte el código postal.</h3></li>
	<li><h3 style='color:red'>Mejorada la ficha del chaval con nuevos campos y mas ordenados</h3></li>
</ul>

<h3 style='color:green'>Para cualquier pregunta, problema, sugerencia, piropo :-) , podéis contactar conmigo por email en <a href='mailto:danillo@euskai.org'>danillo@euskai.org</a></h3>

<br /><br/>
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

<p> Si quieres visitar la pagina web del grupo, deberas dirigirte a <a href="<?echo $conf-> getSetting('group_web');?>"><?echo $conf-> getSetting('group_web');?></a></p>

<center><img alt="flor-lis.png" src="<?echo $THEMEDIR?>/img/flor-lis.png"></center>
<?include 'includes/footer.php'?>
