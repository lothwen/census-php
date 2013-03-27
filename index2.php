<?function logout(){

	session_start();
	include "conf.php";
	include "includes/cMysql.php";

	$db = new cMysql($ddbb_host, $ddbb_user, $ddbb_pass);
	$db-> select_db("census_general");

	// delete db session record corresponding to currently logged in user
	if ( isset( $_SESSION['session_id'] ) && $_SESSION['session_id'] != '' ) {
		$sql = "DELETE FROM session WHERE session_id = '".$_SESSION['session_id']."'";
		$db-> f_sql($sql);
	}
	
	// destroy PHP session
	session_destroy();

	// return to site homepage
	header( 'Location: index.php' );
}

// Set flag that this is a parent file
define( '_VALID_APP', 1 );

//ob_start("ob_gzhandler");
ob_start();

if($_GET['section']=='logout'){

	logout();

}else{

	include 'includes/html_heads.php';
	
	$include_file = 'components/com_'.$_GET['section'].'/'.$_GET['section'].'.php';
	
	if((substr($_GET['section'],0,6)!="admin_") || $_SESSION['val_rol']==0) {
		if(is_file($include_file)){
			include $include_file;
		} else {
			echo "FATAL ERROR: The controller named '".$_GET['section']."' not found";
		}
	}else{
		echo "FATAL ERROR: Permission denied to access controller '".$_GET['section']."'";
	}
}

include 'includes/footer.php';

ob_end_flush();

?>
