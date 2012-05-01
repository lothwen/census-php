	<div id="menu">
		<ul id="nav">
			<li class="page_item"><a href="#">Censo</a>
				<ul>
					<li><a href="index2.php?section=chavales&task=new">Insertar un nuevo chaval/a</a></li>
					<li><a href="index2.php?section=chavales">Realizar una búsqueda</a></li>
				</ul>
			</li>
			<!--<li class="page_item"><a href="#">Actividades</a>
				<ul>
					<li><a href="">Actividades</a></li>
				</ul>
			</li>-->
			<li class="page_item"><a href="#">Utilidades</a>
				<ul>
					<li><a href="index2.php?section=exportar">Exportar datos</a></li>
					<li><a href="index2.php?section=circulares">Circulares</a></li>
				</ul>
			</li>
			<li class="page_item"><a href="#">Configuración</a>
				<ul>
					<li><a href="index2.php?section=grupo">Configuración</a></li>
					<li><a href="index2.php?section=usuarios">Usuarios</a></li>
					<li><a href="index2.php?section=ramas">Ramas</a></li>
				</ul>
			</li>
			<?if ($_SESSION['val_rol']=='0'){?>
			<li class="page_item"><a href="#">Administración</a>
				<ul>
					<li><a href="index2.php?section=admin_grupos">Grupos</a></li>
					<li><a href="index2.php?section=admin_privilegios">Privilegios</a></li>
				</ul>
			</li>
			<?}?>
			<li class="page_item"><a href="index2.php?section=logout">Salir</a></li>
		</ul>
			
		<script src="js/mootools-1.2-core-min.js" type="text/javascript" charset="utf-8"></script>
        	<script src="js/menuMatic_0.67.js" type="text/javascript" charset="utf-8"></script>
        	<script type="text/javascript" >
       	        	window.addEvent('domready', function() {
                      		var myMenu = new MenuMatic();
               		});
        	</script>
	</div>
