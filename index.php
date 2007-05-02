<?
function auth (){
  Header("WWW-Authenticate: Basic realm=\"Census: Euskai Eskaut Taldea\"");
  Header("HTTP/1.0 401 Unauthorized");
  include("error.php"); 
  
  exit;
}

include('lib/conexionbd.php');

if(!isset($HTTP_SERVER_VARS['PHP_AUTH_USER'])||$HTTP_SERVER_VARS['PHP_AUTH_USER']==null) {
	$timeout = mktime(date(G),date(i)+10,0,date("m"),date("d"),date("Y"));
	auth();
} else {		
	
	$sSql = "select COD_USUARIO, NOMBRE, CLAVE, TIPO";
	$sSql .= " from auth";
	$sSql .= " where NOMBRE='" . $_SERVER['PHP_AUTH_USER'] . "'";
	$sSql .= " and CLAVE='" . $_SERVER['PHP_AUTH_PW'] . "'";

	$consulta = f_leer($sSql);
	$fila=mysql_fetch_array($consulta);
	$numFilas=0;
	@$numFilas=mysql_num_rows($consulta);	
  if ($numFilas == "0") {
		$timeout = mktime(date(G),date(i)+10,0,date("m"),date("d"),date("Y"));
		auth();
	}else{
		session_start();
		session_register('val_usuario');
		$val_usuario= $fila[COD_USUARIO];
		session_register('val_nombre');
		$val_nombre= $fila[NOMBRE];		
		session_register('val_tipo');
		$val_tipo=$fila[TIPO];
		session_register('val_validacion');
		$val_validacion="OK";
		session_register('val_solapas');
		include("portada.php");
		?>
	<?}?>
<?}?>
