<?
// no direct access
defined( '_VALID_APP' ) or die( 'Restricted access' );

require 'exportar_html.php';
require 'includes/Census.php';

controller($_GET['task']);

function controller($task=null) {

	switch ( $task ) {
		case 'pdf':
			pdf( );
			break;
		
		case 'labels':
			labels( );
			break;
		
		case 'html':
			html( );
			break;

		case 'show':
		default:
			show();
			break;
	}
}

function pdf( ) {

	global $db;

	$ob = ob_get_clean(); // I store the output buffer to allow pdf header (and data) to out first.
	
	include 'pdf.php';

	$pdf = new PDF('L','pt','A4');
	$pdf->SetFont('Arial','',9);
	$pdf->AliasNbPages();
	$attr=array('titleFontSize'=>18,'titleText'=> $_SESSION['val_nombre_grupo']);
	$pdf->mysql_report("select * from censo",false,$attr);

	ob_flush(); // Output the pdf
	
	echo $ob; // Out the page

	controller();
}

function labels( ) {

	global $db;

	$ob = ob_get_clean(); // I store the output buffer to allow pdf header (and data) to out first.
	
	include 'pdf_cartas.php';
	
	/*-------------------------------------------------
	To create the object, 2 possibilities:
	either pass a custom format via an array
	or use a built-in AVERY name
	-------------------------------------------------*/

	// Example of custom format; we start at the second column
	$pdf = new PDF_Label(array('name'=>'2x8_censo', 'paper-size'=>'A4', 'marginLeft'=>1, 'marginTop'=>6, 'NX'=>3, 'NY'=>8, 'SpaceX'=>0, 'SpaceY'=>1, 'width'=>70, 'height'=>35, 'metric'=>'mm', 'font-size'=>10), 1, 1);
	// Standard format
	//$pdf = new PDF_Label('6083', 'mm', 1, 1);

	$pdf->Open();

	//Print labels
	$sSql = "SELECT NOMBRE,APELLIDOS,DIRECCION,PUEBLO FROM censo where RAMA in (".implode(',',$_POST['ramas']).")";
	foreach($db-> f_sql($sSql) as $fila) {
     	
		$label = $fila['NOMBRE']." ".$fila['APELLIDOS'];
		$label .= "\n";
		$label .= $fila['DIRECCION'];
 		$label .= "\n";
		if (trim(strtolower($fila['PUEBLO'])) == "sestao"){	
		$label .= "48910 Sestao";	
		}elseif (trim(strtolower($fila['PUEBLO'])) == "portugalete"){
			$label .= "48920 Portugalete";
		}elseif (trim(strtolower($fila['PUEBLO'])) == "baracaldo"){
			$label .= "48901 Barakaldo";
		}
	
		$label .= "\n";
		$label .= "Bizkaia";

		$pdf->Add_PDF_Label(iconv("utf-8", "iso-8859-1", $label));
}

$nombre = "etiquetas" . date("d-m-y") . ".pdf";
$pdf->Output($nombre,"D");

ob_flush(); // Output the pdf
	
echo $ob; // Out the page

controller();
}

function html( ) {

	global $db;

	$sql = "select ID,NOMBRE from ramas";
	foreach($db-> f_sql($sql) as $fila){?>
		<br />
		<h3><?echo $fila['NOMBRE']?></h3>
		<table border=1 style="border-collapse:collapse" width="80%" align="center">
			<tr>	
				<td><b>NOMBRE</b></td>
				<td><b>APELLIDOS</b></td>
				<td><b>DNI</b></td>
			</tr>
	
		<?
		$sql = "select NOMBRE,APELLIDOS,DNI,DNI_AMA,DNI_AITA from censo where RAMA='".$fila['ID']."'";

		foreach($db-> f_sql($sql) as $fila){

			 echo "<tr>";
		         echo "<td>".$fila['NOMBRE']."</td>";
			 echo "<td>".$fila['APELLIDOS']."</td>";
		         if ($fila['DNI']!="")
			         echo "<td>".$fila['DNI']."</td>";
			 elseif($fila['DNI_AMA'])
			         echo "<td>".$fila['DNI_AMA']." (Ama)</td>";
			 elseif($fila['DNI_AITA'])
			         echo "<td>".$fila['DNI_AITA']." (Aita)</td>";
		   	 else
				 echo "<td>Faltan datos</td>";

			 echo "</tr>";
		 } ?>
		</table>
	<?}
}

function show( ) {

	global $db, $THEMEDIR;
	
	HTML_exportar::show();
}
?>

