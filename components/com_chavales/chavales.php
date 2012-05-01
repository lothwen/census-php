<?
// no direct access
defined( '_VALID_APP' ) or die( 'Restricted access' );

require 'chavales_html.php';
require 'includes/Census.php';

controller($_GET['task']);

function controller($task=null) {

	switch ( $task ) {
		case 'new':
			edit_kid( 0 );
			break;
		case 'edit':
			edit_kid( $_GET['id'] );
			break;

		case 'save':
			save_kid( $_GET['id'] );
			break;

		case 'remove':
			remove_kid( $_GET['id'] );
			break;

		case 'show':
			show_kid();
			break;
	
		default:
			show_finder( );
			break;
	}
}

function edit_kid( $id ) {

	global $db;

	if ($id > 0 ){
		$row = current($db-> f_sql("SELECT * FROM censo WHERE ID=$id"));
	}
	
	HTML_kid::edit( $id, $row );
}

function save_kid( $id ) {

	global $db;

	if($id > 0){
		// Actualizo todos los datos.
		$sSql = "UPDATE censo SET NOMBRE='$_POST[nombre]', APELLIDOS='$_POST[apellidos]', " 
			. "RAMA='$_POST[rama]', DNI='$_POST[dni]', AMA='$_POST[ama]',"
			. "DNI_AMA='$_POST[dni_ama]', AITA='$_POST[aita]', DNI_AITA='$_POST[dni_aita]', "
			. "EMAIL='$_POST[email]', DIRECCION='$_POST[direccion]', PUEBLO='$_POST[pueblo]', "
			. "TELEFONO='$_POST[telefono]', MOVIL='$_POST[movil]' WHERE ID='$id'";
	
	}else{
		//Con esta sentencia SQL, insertamos los datos en la bbdd
		$sSql = "INSERT INTO censo VALUES(NULL,'{$_POST['nombre']}',"
        	       . "'{$_POST['apellidos']}','{$_POST['rama']}','{$_POST['direccion']}','{$_POST['pueblo']}',"
        	       . "'{$_POST['dni']}','{$_POST['ama']}','{$_POST['dni_ama']}','{$_POST['aita']}',"
        	       . "'{$_POST['dni_aita']}','{$_POST['email']}','{$_POST['telefono']}','{$_POST['movil']}')";
	
	}
	
	$db-> f_sql($sSql);
	
	controller(); // Call to controller without params to show the default option, finder.
}

function remove_kid( $id ) {

	global $db;

	//Con esta sentencia SQL, borramos el registro de la bbdd
	$db-> f_sql("DELETE FROM censo WHERE ID=$id");
	
	//HTML_kid::remove( );
}

function show_kid( ) {

	global $db, $conf;

	// Si no existe $page, es que es la pagina 1.
	// Sino, usamos la $page que viene dada por el parametro.
	if(!isset($_GET['page'])){
	    $page = 1;
	} else {
	    $page = $_GET['page'];
	}

	$max_results=$conf-> getSetting('max_filas');
	
	// Formo la query con el where del buscador
	$query  = "SELECT censo.ID, censo.NOMBRE, censo.APELLIDOS, censo.TELEFONO, censo.RAMA, "
		. "ramas.NOMBRE as NOMBRE_RAMA FROM censo, ramas WHERE censo.RAMA=ramas.ID ";

	if(!empty($_POST['nombre']))
		$query .= "and censo.NOMBRE like \"%" . trim(Census::getParam('nombre')) ."%\" ";
	
	if(!empty($_POST['apellidos']))
		$query .= "and censo.APELLIDOS like \"%" . trim(Census::getParam('apellidos')) ."%\" ";
	
	if(Census::getParam('rama') != '0')
		$query .= "and censo.RAMA=" . Census::getParam('rama');
		
	$query .= " order by censo.RAMA, censo.NOMBRE";

	//Cuento cuantas filas tiene la busqueda en total. Usado al generar el menu de navegacion.
	$total_results = count($db-> f_sql($query));
	
	// Calculo el limite para la query, basandome en la pagina en la que estoy
	$from = (($page * $max_results) - $max_results); 
	
	// Leo de la bbdd, solo los registros que forman esta pagina.
	$query = $query." LIMIT ".$from.",".$max_results;
	$result = $db-> f_sql($query);
	
	HTML_kid::show($result);
	
	// Muestro los botones de navegacion, si hacen falta.
	if ($total_results > $max_results){

		// Calculo el total de paginas que hacen falta. Redondeo usando ceil()
		$total_pages = ceil($total_results / $max_results);

		echo "<br><center>Selecciona una pagina<br>";

		// Enlace anterior
		if($page > 1){
	    		$prev = ($page - 1);
    			echo "<a href=".Census::build_url("index2.php", "page", $prev, $_POST).">Anterior</a> ";
		}
	
		for($i = 1; $i <= $total_pages; $i++){
	    		if(($page) == $i){
	        		echo "$i ";
	        	} else {
	            		echo "<a href=".Census::build_url("index2.php", "page", $i, $_POST).">$i</a> ";
	    		}
		}	
	
		// Enlace posterior
		if($page < $total_pages){
	    		$next = ($page + 1);
	    		echo "<a href=".Census::build_url("index2.php", "page", $next, $_POST).">Siguiente>></a>";
		}
		echo "</center>";
	}
}

function show_finder( ) {

	HTML_kid::finder();
}
?>

