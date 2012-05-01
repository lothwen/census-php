<?
// no direct access
defined( '_VALID_APP' ) or die( 'Restricted access' );

require 'includes/Census.php';

controller($_GET['task']);

function controller($task=null) {

	switch ( $task ) {
		case 'faq':
			faq();
			break;
		
		case 'tutorial':
			tutorial();
			break;

		default:
			tutorial();
			break;
	}
}

function tutorial(){
	include "tutorial.html";
}

function faq(){
	include "faq.html";
}
?>

