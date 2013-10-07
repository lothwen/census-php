<?
// no direct access
defined( '_VALID_APP' ) or die( 'Restricted access' );

require 'usuarios_html.php';
require 'includes/Census.php';

$db-> select_db("census_general");

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
		$row = current($db-> f_sql("SELECT * FROM Usuarios WHERE COD_USUARIO=$id"));
	}
	
	HTML_usuarios::edit( $id, $row );
}

function save( $id ) {

	global $db;

	if($id > 0){
		// Actualizo todos los datos.
		$sSql = "UPDATE Usuarios set NOMBRE='$_POST[nombre]', USUARIO='$_POST[usuario]', "
		. "CLAVE='$_POST[clave]' where COD_USUARIO=$id"; 
	
	}else{
		//Con esta sentencia SQL, insertamos los datos en la bbdd
		$sSql = "INSERT INTO Usuarios (NOMBRE, USUARIO, CLAVE, COD_GRUPO, FECHA_ALTA, ULT_FECHA, COD_ULT_USU) values "
		. "('$_POST[nombre]', '$_POST[usuario]', '$_POST[clave]', $_SESSION[val_cod_grupo], NOW(), NOW(), $_SESSION[val_cod_usu])";
	
	}
	
	$db-> f_sql($sSql);
	
	controller(); // Call to controller without params to show the default option.
}

// Called only from AJAX
function remove( $id ) {

	global $db;

	//Con esta sentencia SQL, borramos el registro de la bbdd
	$db-> f_sql("DELETE FROM Usuarios WHERE COD_USUARIO=$id");
}

function show( ) {

	global $db;

	// Formo la query con el where del buscador
	$query  = "SELECT COD_USUARIO, NOMBRE, USUARIO, CLAVE from Usuarios where COD_GRUPO=".$_SESSION['val_cod_grupo'];

	$result = $db-> f_sql($query);
	
	HTML_usuarios::show($result);
}
?>
