<div id="sidebar">
<ul>
    <li>
      <h2 class="sidebartitle">Búsqueda rápida de chavales</h2>
	<form method="post" id="searchform" action="index2.php?section=chavales&task=show&rama=0">
		<div><input type="text" value="" name="search" id="s" />
			<input type="submit" id="searchsubmit" value="Buscar" />
		</div>
	</form>
    </li>

    <li>
      <h2 class="sidebartitle">Ramas</h2>
      <ul>
      	<?
	$sql = "select ID, NOMBRE from ramas;";
	foreach($db-> f_sql($sql) as $rama)
		echo "<li><a href='index2.php?section=chavales&task=show&rama=$rama[ID]'>$rama[NOMBRE]</a></li>";
	?>
      </ul>
    </li>
	
    <li>
      <h2 class="sidebartitle">Ayuda</h2>
      <ul>
      	<li><a href="index2.php?section=ayuda&task=tutorial">Manual de usuario</a></li>
      	<li><a href="index2.php?section=ayuda&task=faq">F.A.Q. (preguntas frecuentes)</a></li>
      </ul>
    </li>
 </ul>
</div>
<!--/sidebar -->
