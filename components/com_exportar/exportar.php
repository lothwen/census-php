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

	$sSql = "select * from censo where RAMA in (".implode(',',$_POST['ramas']).") order by RAMA, NOMBRE";

	$pdf = new PDF('L','pt','A4');
	$pdf->SetFont('Arial','',9);
	$pdf->AliasNbPages();
	$attr=array('titleFontSize'=>18,'titleText'=> $_SESSION['val_nombre_grupo']);
	$pdf->mysql_report($sSql,false,$attr);

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
	$sSql = "select NOMBRE,APELLIDOS,DIRECCION,MUNICIPIO,CODIGO_POSTAL,PROVINCIA 
		from censo where RAMA in (".implode(',',$_POST['ramas']).") order by RAMA, NOMBRE";

	foreach($db-> f_sql($sSql) as $fila) {
     	
		$label = $fila['NOMBRE']." ".$fila['APELLIDOS'];
		$label .= "\n";
		$label .= $fila['DIRECCION'];
 		$label .= "\n";
		$label .= $fila['CODIGO_POSTAL']." ".$fila['MUNICIPIO'];	
		$label .= "\n";
		$label .= $fila['PROVINCIA'];

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

	$sql = "select ID,NOMBRE from ramas where ID in (".implode(',',$_POST['ramas']).")";
	foreach($db-> f_sql($sql) as $fila){?>
		<br />
		<h3><?echo $fila['NOMBRE']?></h3>
		<table style="border-collapse:collapse" width="80%" align="center" class="table table-condensed">
			<tr>	
				<td><b>NOMBRE</b></td>
				<td><b>APELLIDOS</b></td>
				<td><b>DIRECCION</b></td>
				<td><b>FECHA NAC.</b></td>
				<td><b>DNI</b></td>
			</tr>
	
		<?
		$sql = "select NOMBRE,APELLIDOS,DNI,DNI_AMA,DNI_AITA,DIRECCION,FECHA_NACIMIENTO from censo where RAMA='".$fila['ID']."' order by NOMBRE";
		foreach($db-> f_sql($sql) as $fila){

		        $tr_class="";

			if ($fila['DNI']!="") $dni = $fila['DNI'];
			elseif($fila['DNI_AMA']) $dni = $fila['DNI_AMA']." (Ama)";
			elseif($fila['DNI_AITA']) $dni = $fila['DNI_AITA']." (Aita)";
		   	else {
				$tr_class = "error";
				$dni = "Faltan datos";
			}
			 
			echo "<tr class='".$tr_class."'>";
		        echo "<td>".$fila['NOMBRE']."</td>";
			echo "<td>".$fila['APELLIDOS']."</td>";
			echo "<td>".$fila['DIRECCION']."</td>";
			echo "<td>".$fila['FECHA_NACIMIENTO']."</td>";
			echo "<td>".$dni."</td>";

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

