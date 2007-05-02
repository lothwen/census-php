<?
	include 'configuracion.php';

	function f_conectar(){
		if (!($link=mysql_connect($db_host,$username,$password)))
		{
			echo('<script>alert("Error conectando a la base de datos");</script>');
			exit();
		}

		if (!mysql_select_db($database,$link))
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
		mysql_db_query($database,$lsql);
	}

	function f_desconectar($link){
		mysql_close($link);
	}

	function f_error(){
		echo mysql_errno().": ".mysql_error()."<BR>";
	}
?>
