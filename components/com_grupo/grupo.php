<?
// no direct access
defined( '_VALID_APP' ) or die( 'Restricted access' );

require 'grupo_html.php';
require 'includes/Census.php';

controller($_GET['task']);

function controller($task=null) {

	switch ( $task ) {
		case 'save':
			save();
			break;

		case 'show':
		default:
			edit();
			break;
	}
}

function save() {

	global $db;

	// Actualizo todos los datos.
	$sSql = "UPDATE perfilGrupo set NOMBRE='$_POST[nombre]', DIRECCION='$_POST[direccion]', WEB='$_POST[web]', "
		. "EMAIL='$_POST[email]', THEME='$_POST[theme]', MAX_FILAS=$_POST[max_filas] where COD_GRUPO=0"; 
	
	$db-> f_sql($sSql);
	
	controller(); // Call to controller without params to show the default option.
}

function edit() {

	global $db;

	$query  = "SELECT * from perfilGrupo";

	$result = current($db-> f_sql($query));
	
	HTML_grupo::edit($result);
}
?>

