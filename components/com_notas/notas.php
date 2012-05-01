<?
// no direct access
defined( '_VALID_APP' ) or die( 'Restricted access' );

require 'notas_html.php';
require 'includes/Census.php';

controller($_GET['task']);

function controller($task=null) {

	switch ( $task ) {
		case 'new':
			edit( 0 );
			break;
		case 'edit':
			edit( $_GET['id'] );
			break;

		case 'save':
			save( $_GET['id'] );
			break;

		case 'remove':
			remove( $_GET['id'] );
			break;

		case 'show':
		default:
			show();
			break;
	}
}

function edit( $id ) {

	global $db;

	if ($id > 0 ){
		$row = current($db-> f_sql("SELECT ID, TITULO, CONTENIDO FROM notas WHERE ID=$id"));
	}
	
	HTML_notas::edit( $id, $row );
}

function save( $id ) {

	global $db;

	if($id > 0){
		// Actualizo todos los datos.
		$sSql = "UPDATE notas set TITULO='$_POST[titulo]', CONTENIDO='$_POST[contenido]' where ID=$id"; 
	
	}else{
		//Con esta sentencia SQL, insertamos los datos en la bbdd
		$sSql = "INSERT INTO notas (TITULO, CONTENIDO) values ('$_POST[titulo]','$_POST[contenido]')";
	
	}
	
	$db-> f_sql($sSql);
	
	controller(); // Call to controller without params to show the default option.
}

function remove( $id ) {

	global $db;

	//Con esta sentencia SQL, borramos el registro de la bbdd
	$db-> f_sql("DELETE FROM notas WHERE ID=$id");
	
	controller(); // Call to controller without params to show the default option.
}

function show( ) {

	global $db;

	// Formo la query 
	$query  = "SELECT ID,TITULO from notas";

	$result = $db-> f_sql($query);
	
	HTML_notas::show($result);
}
?>

