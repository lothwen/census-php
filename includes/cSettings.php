<?		
/*
 * Census Settings class
 *
 */

require 'conf.php';

class cSettings {

	// Group specific preferences
	var $theme;
	var $max_filas;
	var $group_name;
	var $group_email;
	var $group_address;
	var $group_web;

	function __construct(){
	
		global $db;

		// Database configuration
		global $ddbb_host;
		global $ddbb_user;
		global $ddbb_pass;

		// Debugging options
		global $debug;

		global $version;

		$group_conf = current($db-> f_sql("select * from perfilGrupo"));

		$this-> theme = $group_conf['THEME'];
		$this-> max_filas = $group_conf['MAX_FILAS'];
		$this-> group_name = $group_conf['NOMBRE'];
		$this-> group_email = $group_conf['EMAIL'];
		$this-> group_address = $group_conf['DIRECCION'];
		$this-> group_web = $group_conf['WEB'];
	}

	function getSetting($setting){
		return $this->$setting;
	}
	
	function setSetting($setting, $value){
		$this->$setting = $value;
	}
}
?>
