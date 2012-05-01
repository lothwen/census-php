<?php
$db-> select_db("census_general");

// restore some session variables
$id 		= $_SESSION['session_user_id'];
$username 	= $_SESSION['session_username'];
$session_id 	= $_SESSION['session_id'];
$logintime 	= $_SESSION['session_logintime'];

$past = time()-1800;

// check against db record of session
if ( $session_id == md5( $id . $username . $logintime ) ) {
	
	$sql = "SELECT * FROM session"
	. " WHERE session_id = '$session_id'"
	. " AND username = '$username'"
	. " AND userid = '$id'"
	. " AND time > '$past'";

	if (count($db-> f_sql($sql)) != 1) {
		Header("Location: index.php");
		exit();
	}
} else {
	Header("Location: index.php");
	exit();
}

// update session timestamp
$current_time = time();
$sql = "UPDATE session"
. " SET time = '$current_time'"
. " WHERE session_id = '$session_id'";
$db-> f_sql($sql);

// timeout old sessions
$sql = "DELETE FROM session"
. " WHERE time < '$past'";
$db-> f_sql($sql);

?>
