<?
// no direct access
defined( '_VALID_APP' ) or die( 'Restricted access' );

require 'presupuestos_html.php';
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
	
	HTML_presupuestos::edit( $id, $row );
}

function details( $id ) {

	global $db;

	if ($id > 0 ){
		$query = "SELECT t1.COD_LINEA, DATE_FORMAT(t1.FECHA,'%d/%m/%Y') as FECHA, t1.CONCEPTO, "
		      . "t1.IMPORTE, t2.NOMBRE, t2.IMPORTE as TOTAL "
		      . "FROM economia_IngresosGastos as t1 left join economia_Partidas as t2 "
		      . "on t1.COD_PARTIDA=t2.COD_PARTIDA WHERE t1.COD_PARTIDA=$id and t1.TIPO=1";
		$result = $db-> f_sql($query);
	}
	
	HTML_presupuestos::details( $result );
}

function save( $id ) {

	global $db;

	if($id > 0){
		// Actualizo todos los datos.
		$sSql = ""; 
		$db-> f_sql($sSql);
	
	}else{
		//Con esta sentencia SQL, insertamos los datos del presuspuesto en la bbdd
		$sSql = "insert into economia_Presupuestos (NOMBRE,FECHA_INICIO, FECHA_FINAL, FECHA_ALTA) "
		 . "values ('$_POST[nombre]',STR_TO_DATE('$_POST[fecha_inicio]','%d/%m/%Y'),STR_TO_DATE('$_POST[fecha_fin]','%d/%m/%Y'),NOW())";

		$db-> f_sql($sSql);

		$id = mysql_insert_id(); // Guardo el id del presupuesto recien metido en bbdd

		// Inserto cada uno de las partidas
		$aMerged = array_combine($_POST['nombre_partida'], $_POST['cantidad']);  
		foreach($aMerged as $key => $value){
			$sSql = "insert into economia_Partidas (COD_PRESUPUESTO, NOMBRE, IMPORTE) "
			 . "values ('$id','$key','$value')";

			$db-> f_sql($sSql);
		}
	}
	
	controller(); // Call to controller without params to show the default option, finder.
}

function remove( $id ) {

	global $db;

	// Con esta sentencia SQL, borramos el registro de la bbdd
	$db-> f_sql("DELETE FROM censo WHERE ID=$id");
	
	controller(); // Call to controller without params to show the default option, finder.
}

function show( $id ) {

	global $db;

	// Extraigo los datos del presupuesto actual
	$query = "select t1.COD_PRESUPUESTO, t1.NOMBRE as NOMBRE_PRESUPUESTO, t1.FECHA_INICIO, t1.FECHA_FINAL, "
		."t2.COD_PARTIDA, t2.NOMBRE as NOMBRE_PARTIDA, t2.IMPORTE as TOTAL, t2.TIPO as TIPO_PARTIDA,"
		."t3.BALANCE from economia_Presupuestos as t1 left join economia_Partidas as t2 "
		."on t1.COD_PRESUPUESTO=t2.COD_PRESUPUESTO left join (select t3.COD_PARTIDA, SUM(t3.IMPORTE) as BALANCE "
		."from economia_IngresosGastos as t3 where t3.TIPO=1 group by t3.COD_PARTIDA) as t3 on t2.COD_PARTIDA=t3.COD_PARTIDA "; 

	if($id>0)
		$query .= "where t1.COD_PRESUPUESTO='$id' ";
	else
		$query .= "where DATE(NOW()) between t1.FECHA_INICIO and t1.FECHA_FINAL ";

	$actual = $db-> f_sql($query);
	
	// Extraigo los datos de los presupuestos de años anteriores
	$query2  = "select COD_PRESUPUESTO, NOMBRE, FECHA_INICIO, FECHA_FINAL from economia_Presupuestos";
	$past = $db-> f_sql($query2);
	
	HTML_presupuestos::show($actual, $past);	
}
?>

