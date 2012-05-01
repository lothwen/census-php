<?
/*
 * Subsection include controller.
 *
 */

$include_file = 'components/com_'.$_GET['section'].'/'.$_GET['subsection'].'.php';
	
if(is_file($include_file)){
	include $include_file;
} else {
	echo "FATAL ERROR: The controller named '".$_GET['subsection']."' not found";
}
?>

