	<div id="menu">
		<ul class="nav">
			<li class='dropdown'>
				<a class="page_item dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-user icon-white"></i>&nbsp;Censo <i class="icon-chevron-down icon-white"></i></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li><a href="index2.php?section=chavales&task=new">Insertar un nuevo chaval/a</a></li>
					<li><a href="index2.php?section=chavales">Realizar una búsqueda</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="page_item dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-briefcase icon-white"></i>&nbsp;Economia <i class="icon-chevron-down icon-white"></i></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li><a href="index2.php?section=economia&subsection=presupuestos">Presupuestos - Balance</a></li>
					<li><a href="index2.php?section=economia&subsection=librodiario">Libro diario - Ingresos y Gastos</a></li>
					<li><a href="index2.php?section=economia&subsection=pagoseeb">Pagos EEB</a></li>
					<li><a href="index2.php?section=economia&subsection=cuotas">Cuotas Familias</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="page_item dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-pencil icon-white"></i>&nbsp;Utilidades <i class="icon-chevron-down icon-white"></i></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li><a href="index2.php?section=exportar">Exportar datos</a></li>
					<li><a href="index2.php?section=circulares">Circulares</a></li>
					<li><a href="index2.php?section=notas">Notas</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="page_item dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-wrench icon-white"></i>&nbsp;Configuración <i class="icon-chevron-down icon-white"></i></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li><a href="index2.php?section=grupo">Configuración</a></li>
					<li><a href="index2.php?section=usuarios">Usuarios</a></li>
					<li><a href="index2.php?section=ramas">Ramas</a></li>
				</ul>
			</li>
			<?if ($_SESSION['val_rol']=='0'){?>
			<li class="dropdown">
				<a class="page_item dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-tasks icon-white"></i>&nbsp;Administración <i class="icon-chevron-down icon-white"></i></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li><a href="index2.php?section=admin_grupos">Grupos</a></li>
					<li><a href="index2.php?section=admin_privilegios">Privilegios</a></li>
				</ul>
			</li>
			<?}?>
			<li><a class="page_item" href="index2.php?section=logout">Salir&nbsp;<i class="icon-off icon-white"></i></a></li>
		</ul>
	</div>
		

        <script type="text/javascript" >
    		
		$(document).ready(function() {
			$('.dropdown-toggle').dropdown();
		});
	
	</script>
