<?
include('lib/conexionbd.php');

function auth (){
	//Register a 60 sec cookie to pass to second step of login process
	setcookie("logging", "login",time() + (60*60*24)); 
	Header("WWW-Authenticate: Basic realm=\"Census: Euskai Eskaut Taldea\"");
	Header("HTTP/1.0 401 Unauthorized");
	include("error.php"); 
  
  	exit;
}

/*
* Return a data and time string
*/
function storetime(){
	
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

	return $storetime;
}

if (isset($_COOKIE['sessionid'])) {
	$sSql = "select ID";
	$sSql .= " from auth";
	$sSql .=" where SESSIONID='".$_COOKIE['sessionid']."'";

	$consulta = f_leer($sSql);
	$fila=mysql_fetch_array($consulta);
	$numFilas=0;
	@$numFilas=mysql_num_rows($consulta);

	if ($numFilas > 0) {
		$sessionid = storetime();
		$sSql = "update from auth SET SESSIONID='".$sessionid."' where ID=".$fila['ID'];
		f_ejecutar($sSql);
		
		setcookie("sessionid",$sessionid,time() + (60*60*24));
		Header("Location: portada.php");
	}
} else {
	//First step of login process
	if (!isset($_COOKIE['logging'])){
		auth();

	} else {
		//Second step of login process
		
		//Remove login process cookie. At this moment, is not necesary.
		setcookie("logging","",0);
		
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
			$sessionid = storetime();
			$sSql = "update from auth SET SESSIONID='".$sessionid."' where ID=".$fila['ID'];
			f_ejecutar($sSql);
			
			setcookie("sessionid",$storetime,time() + (60*60*24));
			Header("Location: portada.php");
		}
	}
}	
?>
