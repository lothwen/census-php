<?
// no direct access
defined( '_VALID_APP' ) or die( 'Restricted access' );

require 'pagoseeb_html.php';
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
		$row = current($db-> f_sql("SELECT * FROM censo WHERE ID=$id"));
	}
	
	HTML_kid::edit( $id, $row );
}

function save( $id ) {

	global $db;

	if($id > 0){
		// Actualizo todos los datos.
		$sSql = ""; 
	
	}else{
		//Con esta sentencia SQL, insertamos los datos en la bbdd
		$sSql = "";
	
	}
	
	$db-> f_sql($sSql);
	
	controller(); // Call to controller without params to show the default option, finder.
}

function remove( $id ) {

	global $db;

	//Con esta sentencia SQL, borramos el registro de la bbdd
	$db-> f_sql("DELETE FROM censo WHERE ID=$id");
	
	//HTML_kid::remove( );
}

function show( ) {

	global $db;

	// Leo de la bbdd los gastos pendientes
	$query = "select COD_LINEA, COD_PRESUPUESTO, COD_PARTIDA, FECHA, CONCEPTO, IMPORTE, TIPO, PENDIENTE "
		. "from economia_IngresosGastos where TIPO=2";
	$result = $db-> f_sql($query);
	
	HTML_pagoseeb::show($result);	
}
?>

