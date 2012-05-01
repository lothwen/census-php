<?
// no direct access
defined( '_VALID_APP' ) or die( 'Restricted access' );

require 'librodiario_html.php';
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

		case 'details':
			details( $_GET['id'] );
			break;
		
		case 'save':
			save( $_GET['id'] );
			break;

		case 'remove':
			remove( $_GET['id'] );
			break;

		case 'show':
		default:
			show( $_GET['id'] );
			break;
	}
}

function edit( $id ) {

	global $db;

	if ($id > 0 ){
		$row = current($db-> f_sql("SELECT * FROM censo WHERE ID=$id"));
	}
	
	HTML_librodiario::edit( $id, $row );
}

function details( $id ) {

	global $db;
	
	if ($id > 0 ){
		$query = "SELECT t1.COD_PARTIDA, t1.FECHA, t1.CONCEPTO, t1.IMPORTE, t1.TIPO FROM economia_IngresosGastos as t1 WHERE MONTH(FECHA)=$id";
		$result = $db-> f_sql($query);
	}
	
	HTML_librodiario::details( $id, $result );
}

function save( $id ) {

	global $db;

	if($id > 0){
		// Actualizo todos los datos.
		$sSql = ""; 
	
	}else{
		//Con esta sentencia SQL, insertamos los datos en la bbdd
		$sSql = "insert into economia_IngresosGastos (COD_PRESUPUESTO, COD_PARTIDA, FECHA, CONCEPTO, IMPORTE, TIPO) "
		 . "values ('$_POST[select_presupuesto]','$_POST[select_partida]',STR_TO_DATE('$_POST[fecha]', '%d/%m/%Y'), "
		 . "'$_POST[concepto]','$_POST[importe]','$_POST[tipo]')";	
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

function show( $id ) {

	global $db;

	// Configuro el locale para que salgan los nombres de los meses en castellano.
	$query  = "SET lc_time_names = 'es_ES'";
	$db-> f_sql($query);

	// Configure the where clause to use in querys.
	if($id>0)
		$where .= "where t1.COD_PRESUPUESTO='$id' ";
	else
		$where .= "where DATE(NOW()) between t1.FECHA_INICIO and t1.FECHA_FINAL ";
	
	$query = "select MONTH(FECHA) as MES, TIPO, SUM(IMPORTE) as TOTAL, t1.FECHA_INICIO, t1.FECHA_FINAL "
		."from economia_IngresosGastos as t2 left join economia_Presupuestos as t1 "
		."on t1.COD_PRESUPUESTO=t2.COD_PRESUPUESTO $where GROUP BY MES, TIPO";

	$partial = $db-> f_sql($query);
	
	$query = "select UNIX_TIMESTAMP(FECHA_INICIO) as INICIO, UNIX_TIMESTAMP(FECHA_FINAL) as FINAL from economia_Presupuestos as t1 $where";
	$fila = current($db-> f_sql($query));

	$date = $fila['INICIO'];

	$result = Array();
 
	while($date<$fila['FINAL']){

		$num_month = date('n',$date);
		$ingresos = 0.00;
		$gastos = 0.00;

		foreach($partial as $month_data){
			if($month_data['MES'] == $num_month){
				if($month_data['TIPO'] == 0) $ingresos = $month_data['TOTAL']; 
				if($month_data['TIPO'] == 1) $gastos = $month_data['TOTAL']; 
			}	
		}

		$result[] = Array("MES"=>$num_month, "INGRESOS"=>$ingresos, "GASTOS"=>$gastos);
		$date = strtotime("+1month",$date);
 	}
	
	HTML_librodiario::show($result);
}
?>

