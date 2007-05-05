<?
include 'configuracion.php';

function f_conectar(){
	if (!($link=mysql_connect($GLOBALS["db_host"],$GLOBALS["user"],$GLOBALS["password"])))
	{
		echo "Error conectando a la base de datos";
		exit();
	}

	if (!mysql_select_db($GLOBALS["database"],$link))
	{
		echo "Error seleccionando la base de datos.";
		exit();
	}
	return $link;
}

function f_leer($lsql){
	$link = f_conectar();
	$lreg = mysql_query($lsql,$link);
	return $lreg;
}

function f_ejecutar($lsql){
	$link = f_conectar();
	mysql_db_query($GLOBALS["database"],$lsql);
}

function f_desconectar($link){
	mysql_close($link);
}

function f_error(){
	echo mysql_errno().": ".mysql_error()."<BR>";
}
?>
