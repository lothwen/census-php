<?
// no direct access
defined( '_VALID_APP' ) or die( 'Restricted access' );

require 'admin_grupos_html.php';
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
		$row = current($db-> f_sql("SELECT * FROM Grupos WHERE COD_GRUPO=$id"));
	}
	
	HTML_admin_grupos::edit( $id, $row );
}

function save( $id ) {

	global $db;

	if($id > 0){
		// Actualizo todos los datos.
		$sSql = "UPDATE Usuarios set NOMBRE='$_POST[nombre]', USUARIO='$_POST[usuario]', "
		. "CLAVE='$_POST[clave]' where COD_USUARIO=$id"; 
	
		$db-> f_sql($sSql);
	
	}else{
		$bbdd = str_replace(" ", "", $_POST['nombre_bbdd']);
		// Con esta sentencia SQL, insertamos los datos del grupo
		$sSql = "INSERT INTO Grupos (NOMBRE, NOMBRE_BBDD, FECHA_ALTA, ULT_FECHA, COD_ULT_USU) values "
		. "('$_POST[nombre]', '$bbdd', NOW(), NOW(), $_SESSION[val_cod_usu])";
		
		$db-> f_sql($sSql);
		
		// Con esta sentencia SQL, insertamos los datos del usuario => Nombre, Usuario y Clave igual que el nombre de la bbdd.
		$sSql = "INSERT INTO Usuarios (COD_GRUPO, NOMBRE, USUARIO, CLAVE, TIPO, FECHA_ALTA, ULT_FECHA, COD_ULT_USU) values "
		. "('".mysql_insert_id()."','$bbdd', '$bbdd', '$bbdd', '1', NOW(), NOW(), $_SESSION[val_cod_usu])";
		
		$db-> f_sql($sSql);

		// Creo la nueva base de datos
		$db-> f_sql("create database census_".$bbdd);
        	// Creo la estructura de la bbdd especifica.
        	$db-> select_db("census_".$bbdd);

        	// Leo el fichero y ejecuto las querys una a una.
        	// MUCHO CUIDADO CON CAMPOS CON ';'
        	$fp = fopen('sql/data.sql', 'r');
        	while(!feof($fp)){
        	        $line = fgets($fp, 2048);
        	        if(substr($line,0,2)=="--") continue;
        	        $query .= $line;

        	        if(strpos($line,";")){
        	                $db-> f_sql($query);
        	                $query = "";
        	        }
        	}
        	fclose($fp);

		// Inserto la linea de conf. por defecto para el grupo
		$sql = "INSERT INTO `perfilGrupo` (`COD_GRUPO`, `NOMBRE`, `THEME`, `MAX_FILAS`) VALUES ";
		$sql.= "(0, '$_POST[nombre]', 'glossy', 15)";
		$db-> f_sql($sql);
        
		// Vuelvo a la base de datos general
		$db-> select_db("census_general");
	}
	
	controller(); // Call to controller without params to show the default option.
}

function remove( $id ) {

	global $db;

	// Con esta sentencia SQL, borramos el registro de la tabla de grupos
	$db-> f_sql("DELETE FROM Grupos WHERE COD_GRUPO=$id");
	
	// Con esta sentencia SQL, borramos el registro de la tabla de usuarios
	$db-> f_sql("DELETE FROM Usuarios WHERE COD_GRUPO=$id");
	
	controller(); // Call to controller without params to show the default option.
}

function show( ) {

	global $db;

	// Formo la query 
	$query  = "SELECT COD_GRUPO, NOMBRE, NOMBRE_BBDD from Grupos";

	$result = $db-> f_sql($query);
	
	HTML_admin_grupos::show($result);
}
?>
