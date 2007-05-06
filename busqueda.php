<?
include 'lib/conexionbd.php';
include 'lib/cab0.php';
?>
<title>Euskai Census v1.0 : Realizar una busqueda</title>
</head>
<? 
include 'lib/cab1.php';

if (!$_POST && !$page){

if(session_is_registered('query')){
	unset($_SESSION['query']);
}
?> 

<form method="post" action="">

	<table align="center" width="80%">
		<tr>
		  <th>DATOS</th>
		  <th>CRITERIO</th>
		</tr>

		<tr>
		  <td><input type="checkbox" name="todos">Todos</td>
		  <td>Nombre: <input type="text" name="nombre_where" size="10"></td>
		</tr>

		<tr>
		  <td><input type="checkbox" name="nombre">Nombre</td>
		  <td>Apellidos: <input type="text" name="apellidos_where" size="30"></td>
		</tr>

		<tr>
		  <td><input type="checkbox" name="apellidos">Apellidos</td>
		   <td>Rama: <select size="1" name="rama_where">
                        <option value="6">Todas</option>
			<option value="1">Koskorrak</option>
                	<option value="2">Kaskondoak</option>
                	<option value="3">Oinarinak</option>
                	<option value="4">Azkarrak</option>
                	<option value="5">Trebeak</option>
                	<option value="0">Arduradunak</option>
        	   </select></td>

		</tr>

		<tr>
		  <td><input type="checkbox" name="rama">Rama</td>
		  <td></td>
		</tr>

		<tr>
		  <td><input type="checkbox" name="dni">DNI</td>
		  <td></td>
		</tr>

		<tr>
		  <td><input type="checkbox" name="ama">Ama</td>
		  <td></td>
		</tr>

		<tr>
		  <td><input type="checkbox" name="dni_ama">DNI Ama</td>
		  <td></td>
		</tr>

		<tr>
		  <td><input type="checkbox" name="aita">Aita</td>
		  <td></td>
		</tr>

		<tr>
		  <td><input type="checkbox" name="dni_aita">DNI Aita</td>
		  <td></td>
		</tr>

		<tr>
		  <td><input type="checkbox" name="direccion">Dirección</td>
		  <td></td>
		</tr>

		<tr>
		  <td><input type="checkbox" name="telefono">Teléfono</td>
		  <td></td>
		</tr>

		<tr>
		  <td><input type="checkbox" name="movil">Móvil</td>
		  <td></td>
		</tr>

		<tr>
          	  <td align="right"><input type="submit" value="Buscar" name="enviar"></td>
          	  <td><input type="reset" value="Restablecer" name="resetear"></td>
        	</tr>

	</table>
</form>

<?
}else{ 

//Formo el select a partir de los datos que recojo de los chekbox
if($_POST['todos']){
	$select = '*';
}else{
	$select = $select. "ID,";
	if($_POST['nombre']){
		$select = $select . "NOMBRE,";
	}if($_POST['apellidos']){
		$select = $select . "APELLIDOS,";
	}if($_POST['rama']){
		$select = $select . "RAMA,";
	}if($_POST['dni']){
		$select = $select . "DNI,";
	}if($_POST['ama']){
		$select = $select . "AMA,";
	}if($_POST['dni_ama']){
		$select = $select . "DNI_AMA,";
	}if($_POST['aita']){
		$select = $select . "AITA,";
	}if($_POST['dni_aita']){
		$select = $select . "DNI_AITA,";
	}if($_POST['direccion']){
		$select = $select . "DIRECCION,";
	}if($_POST['telefono']){
		$select = $select . "TELEFONO,";
	}if($_POST['movil']){
		$select = $select . "MOVIL,";
	}if($select == 'ID,'){
		$select .= $select_default;
	}
	//Elimino la ultima coma del select
	$select = substr($select, 0, -1);
	$select .= " ";
}

// Si no existe $page, es que es la pagina 1.
// Sino, usamos la $page que viene dada por el parametro.
if(!isset($_GET['page'])){
    $page = 1;
} else {
    $page = $_GET['page'];
}

$max_results = 10;

// Calculo el limite para la query, basandome en la pagina en la que estoy
$from = (($page * $max_results) - $max_results); 

if(session_is_registered('query')){
	
	$query .= $query." LIMIT ".$from.",".$max_results;
	$result = f_leer($query);
	if($debug) echo "Consulta Session: " . $query;
}

//Si no hay ningun criterio seleccionado, ejecuta la sentencia sin where
elseif(empty($_POST['nombre_where']) && empty($_POST['apellidos_where']) && $_POST['rama_where'] == '6'){

	// Leo de la bbdd, solo los registros que forman esta pagina.
	$query = "SELECT ".$select."FROM census"; 
	if (!session_is_registered('query')){
		session_register('query');
	}
	$query .= $query." LIMIT ".$from.",".$max_results;
	$result = f_leer($query);
	if($debug) echo "Consulta sin Where: " . $query;
}else{
	if(!empty($_POST['nombre_where'])){
		$where = $where . "NOMBRE=\"" . trim($_POST['nombre_where']) ."\" ";
	}
	if(!empty($_POST['apellidos_where'])){
		$where .= $where . "APELLIDOS=\"" . trim($_POST['apellidos_where']) ."\" ";
	}
	if(!$_POST['rama_where'] == '6'){	
		$where .= $where . "RAMA=" . $_POST['rama_where'] . " ";
	}
	// Leo de la bbdd, solo los registros que forman esta pagina.
	$query  = "SELECT $select FROM census WHERE $where";
	if (!session_is_registered('query')){
		session_register('query');
	}
	$query .= $query." LIMIT ".$from.",".$max_results;
	$result = f_leer($query);
	if($debug) echo "Consulta con Where: " . $query;
}

//Muestro en forma de tabla la salida de la query
	if (@$row = mysql_fetch_array($result)){ 
		$numCampos = mysql_num_fields($result);
		$numFilas = mysql_num_rows($result);
		echo "<center><table id=\"mi_tabla\">";
		
		//Mostramos los nombres de las tablas
		echo "<tr>";
		mysql_field_seek($result,1);
		while ($field = mysql_fetch_field($result)){
			echo "<th class=\"cab_tabla\">".$field->name."</th>";
		}
		echo "<form action=pdf.php method=post>";
		echo "<input name='sentencia' type=hidden value='".$query."'>";
		echo "<th class=\"cab_tabla\"><input class=\"imagen\" type=\"image\" name=\"generar\" src=\"images/pdf-icon.gif\" /></th>";
		echo "</form>";
		echo "</tr>"; 
		
		for($i=0;$i<$numFilas;$i++){
			if($i%2 == 0){
				echo "<tr class=\"tr_par\">";
			}else{
				echo "<tr class=\"tr_impar\">";
			}
			for($j=1;$j<$numCampos;$j++){
				echo "<td>".$row[$j]."</td>";
			}
			
			echo "<td><a href=\"editar.php?borrar=$row[0]\"><img src=\"images/borrar.png\" border=0/></a>
					 <a href=\"editar.php?id=$row[0]\"><img src=\"images/editar.png\" border=0/></a>
			</td>";
			echo "</tr>";
			$row = mysql_fetch_array($result);
		}
		echo "</table></center>";
	} else { 
	echo "<script>alert(\"No se ha encontrado ningun registro !\")</script>";
	
} 

// Muestro los botones de navegacion, si hacen falta.
if ($numFilas > $max_results){

	// Cuento el total de registros en la bbdd
	$total_results = mysql_result(f_leer("SELECT COUNT(*) as Num FROM census"),0);

	// Calculo el total de paginas que hacen falta. Redondeo usando ceil()
	$total_pages = ceil($total_results / $max_results);

	echo "<br><center>Selecciona una pagina<br>";

	// Enlace anterior
	if($page > 1){
    		$prev = ($page - 1);
    		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\">Anterior</a> ";
	}

	for($i = 1; $i <= $total_pages; $i++){
    		if(($page) == $i){
        		echo "$i ";
        	} else {
            		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\">$i</a> ";
    		}
	}	

	// Enlace posterior
	if($page < $total_pages){
    		$next = ($page + 1);
    		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\">Siguiente>></a>";
	}
	echo "</center>";
}
}
?>
<?include 'lib/footer.php'?>
