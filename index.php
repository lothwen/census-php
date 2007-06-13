<?
function auth (){
  Header("WWW-Authenticate: Basic realm=\"Census: Euskai Eskaut Taldea\"");
  Header("HTTP/1.0 401 Unauthorized");
  include("error.php"); 
  
  exit;
}

include('lib/conexionbd.php');

$now = getdate();
$storetime= $now["weekday"] . " " . $now["month"] ." " . $now["year"] ;
$storetime.=" Time : ";

if ($now["hours"] < 10) {
	$storetime.= "0" . $now["hours"];
} else {
	$storetime.= $now["hours"];
}

$storetime.= ":";
if ($now["minutes"]<10) {
	$storetime.= "0" . $now["minutes"];
} else {
	$storetime.= $now["minutes"];
}

$storetime.= ": ";
if ($now["seconds"] <10) {
	$storetime.= "0" . $now["seconds"];
} else {
	$storetime.= $now["seconds"];
}

if (isset($_COOKIE['data'])) {
	$counter=++$_COOKIE['data[l]'];
	setcookie("data[0]",$storetime,time() + (60*60*24));
	setcookie("data[l]", $counter,time() + (60*60*24)); 
	setcookie("data[2]",$username,time() + (60*60*24));
	Header("Location: portada.php");
} else {
	if (!isset($HTTP_SERVER_VARS['PHP_AUTH_USER']) || $HTTP_SERVER_VARS['PHP_AUTH_USER']==null) {
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
			auth();
		}else{  
			$counter=0;
  			setcookie("data[0]",$storetime,time() + (60*60*24));
  			setcookie("data[l]",$counter,time() + (60*60*24));
  			setcookie("data[2]",$username,time() + (60*60*24));
  			Header("Location: portada.php");
		}
	}
}	
?>
