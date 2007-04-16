<?session_start()?>
<?include 'lib/cabecera.inc'?>
<?
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

// Cojo los datos para la conexion
require 'configuracion.php';

//Conecto a la base de datos
mysql_select_db($database, mysql_pconnect($db_host,$user,$password)) or die (mysql_error());

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

// If current page number, use it
// if not, set one!
if(!isset($_GET['page'])){
    $page = 1;
} else {
    $page = $_GET['page'];
}

// Define the number of results per page
$max_results = 10;

// Figure out the limit for the query based
// on the current page number.
$from = (($page * $max_results) - $max_results); 

if(session_is_registered('query')){
	
	$query2 = $query." LIMIT ".$from.",".$max_results;
	$result = mysql_query($query2);
	if($debug) echo "Consulta Session: " . $query2;
}

//Si no hay ningun criterio seleccionado, ejecuta la sentencia sin where
elseif(empty($_POST['nombre_where']) && empty($_POST['apellidos_where']) && $_POST['rama_where'] == '6'){

	// Perform MySQL query on only the current page number's results
	$query = "SELECT ".$select."FROM census"; 
	if (!session_is_registered('query')){
		session_register('query');
	}
	$query2 = $query." LIMIT ".$from.",".$max_results;
	$result = mysql_query($query2);
	if($debug) echo "Consulta sin Where: " . $query2;
}else{
	if(!empty($_POST['nombre_where'])){
		$where = $where . "NOMBRE=\"" . trim($_POST['nombre_where']) ."\" ";
	}
	if(!empty($_POST['apellidos_where'])){
		$where = $where . "APELLIDOS=\"" . trim($_POST['apellidos_where']) ."\" ";
	}
	if(!$_POST['rama_where'] == '6'){	
		$where = $where . "RAMA=" . $_POST['rama_where'] . " ";
	}
	// Perform MySQL query on only the current page number's results
	$query  = "SELECT $select FROM census WHERE $where";
	if (!session_is_registered('query')){
		session_register('query');
	}
	$query2 = $query." LIMIT ".$from.",".$max_results;
	$result = mysql_query($query2);
	if($debug) echo "Consulta con Where: " . $query2;
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
		echo "<form action=exportar.php method=post>";
		echo "<input type=\"hidden\" value='".$query."'";
		echo "<th class=\"cab_tabla\"><input type=\"img\" name=\"sentencia\" src=\"images/pdf-icon.gif\" border=\"0\"/></th>";
		echo "</form>"
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

// Figure out the total number of results in DB:
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM census"),0);

// Figure out the total number of pages. Always round up using ceil()
$total_pages = ceil($total_results / $max_results);

// Build Page Number Hyperlinks
echo "<br><center>Selecciona una pagina<br>";

// Build Previous Link
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

// Build Next Link
if($page < $total_pages){
    $next = ($page + 1);
    echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\">Siguiente>></a>";
}
echo "</center>";
}
?>
<?include 'lib/footer.inc'?>
