	<div id="menu">
		<ul id="nav">
			<li class="page_item"><a href="#" id="censo">Censo</a>
				<ul class="hidden">
					<li><ul>
					<li><a href="index2.php?section=chavales&task=new">Insertar un nuevo chaval/a</a></li>
					<li><a href="index2.php?section=chavales">Realizar una búsqueda</a></li>
					</li></ul>
				</ul>
			</li>
			<li class="page_item"><a href="#" id="economia">Economia</a>
				<ul class="hidden">
					<li><ul>
					<li><a href="index2.php?section=economia&subsection=presupuestos">Presupuestos - Balance</a></li>
					<li><a href="index2.php?section=economia&subsection=librodiario">Libro diario - Ingresos y Gastos</a></li>
					<li><a href="index2.php?section=economia&subsection=pagoseeb">Pagos EEB</a></li>
					<li><a href="index2.php?section=economia&subsection=cuotas">Cuotas Familias</a></li>
					</li></ul>
				</ul>
			</li>
			<li class="page_item"><a href="#" id="utilidades">Utilidades</a>
				<ul class="hidden">
					<li><ul>
					<li><a href="index2.php?section=exportar">Exportar datos</a></li>
					<li><a href="index2.php?section=circulares">Circulares</a></li>
					<li><a href="index2.php?section=notas">Notas</a></li>
					</li></ul>
				</ul>
			</li>
			<li class="page_item"><a href="#" id="configuracion">Configuración</a>
				<ul class="hidden">
					<li><ul>
					<li><a href="index2.php?section=grupo">Configuración</a></li>
					<li><a href="index2.php?section=usuarios">Usuarios</a></li>
					<li><a href="index2.php?section=ramas">Ramas</a></li>
					</li></ul>
				</ul>
			</li>
			<?if ($_SESSION['val_rol']=='0'){?>
			<li class="page_item"><a href="#" id="administracion">Administración</a>
				<ul class="hidden">
					<li><ul>
					<li><a href="index2.php?section=admin_grupos">Grupos</a></li>
					<li><a href="index2.php?section=admin_privilegios">Privilegios</a></li>
					</li></ul>
				</ul>
			</li>
			<?}?>
			<li class="page_item"><a href="index2.php?section=logout" id="salir">Salir</a></li>
		</ul>
	</div>
		

        <script type="text/javascript" >
    		
		$(document).ready(function() {
			// MENUS    	
			$("#censo").menu({ content: $("#censo").next().html(),flyOut: true, width:220});
			$("#economia").menu({ content: $("#economia").next().html(),flyOut: true, width:220});
			$("#utilidades").menu({ content: $("#utilidades").next().html(),flyOut: true, width:220});
			$("#configuracion").menu({ content: $("#configuracion").next().html(),flyOut: true, width:220});
			$("#administracion").menu({ content: $("#administracion").next().html(),flyOut: true, width:220});
		});
	
	</script>
