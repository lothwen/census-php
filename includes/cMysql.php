<?		
/*
 * Mysql helper
 *
 */

//global $db;
class cMysql {

	var $host = "localhost";
	var $user = "";
	var $pw = "";

	var $dbname;

	function __construct(){
		if (!($this->link=mysql_connect($this->host,$this->user,$this->pw))) {
			echo "<script>alert('Error conectando a la base de datos');</script>";
			exit();
		}
	}

	function select_db($dbname){
		$this->dbname = $dbname;

		if (!mysql_select_db($dbname,$this->link)) {
			echo "<script>alert('Error seleccionando la base de datos.');</script>";
			exit();
		}
	}

	function get_dbname(){
		return $this-> dbname;
	}

	function f_sql_raw($sql){
		
		mysql_query("SET NAMES 'utf8'");
		mysql_query("SET CHARACTER SET 'utf8'");
	
		return mysql_query(mysql_real_escape_string($sql),$this->link);
	}

	function f_sql($sql){

		mysql_query("SET NAMES 'utf8'");
		mysql_query("SET CHARACTER SET 'utf8'");

		$consulta = mysql_query($sql,$this->link);
	
		if (mysql_errno() != "0"){
			$sql_ = ereg_replace("\"","\'",$sql);
			$error_ = ereg_replace("\"","\'",mysql_error());
			echo "<script>alert(\"$sql_: \\n $error_ \")</script>";
			}
	
		$sql_ = ereg_replace(" ","",$sql);
		$sql_ = strtolower($sql_);
		$action = substr($sql_,0,6);
		if ($action=="select") {
			$fila = mysql_fetch_array($consulta, MYSQL_ASSOC);
			$numFilas = mysql_num_rows($consulta);
			$files = array();
			for ($i=0; $i<$numFilas; $i++) {
				$files[] = $fila;
				$fila = mysql_fetch_array($consulta, MYSQL_ASSOC);
			}
			return $files;
		}
	}
}
?>
