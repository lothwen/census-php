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
	//$pdf->AddPage();
/*
// Formo la sentencia SQL
if ($_POST['todos']) {
	$where = "";
}else{ 
	$primero = false;
	
	if ($_POST['koskorrak']){
		$where = "WHERE RAMA=1";
		$primero = true;
	}
	
	if ($_POST['kaskondoak']){
		if (!$primero){
			$where = "WHERE RAMA=2";
			$primero = true;
		}else{
			$where .= " or RAMA=2";
		}
	}
	
	if ($_POST['oinarinak']){
		if (!$primero){
			$where = "WHERE RAMA=3";
			$primero = true;
		}else{
			$where .= " or RAMA=3";
		}
	}
	
	if ($_POST['azkarrak']){
		if (!$primero){
			$where = "WHERE RAMA=4";
			$primero = true;
		}else{
			$where .= " or RAMA=4";
		}
	}

	if ($_POST['trebeak']){
		if (!$primero){
			$where = "WHERE RAMA=5";
			$primero = true;
		}else{
			$where .= " or RAMA=5";
		}
	}
	
	if ($_POST['arduradunak']){
		if (!$primero){
			$where = "WHERE RAMA=6";
			$primero = true;
		}else{
			$where .= " or RAMA=6";
		}
	}
}
*/
$sSql = "SELECT NOMBRE,APELLIDOS,DIRECCION,PUEBLO FROM censo $where where RAMA!='7' and RAMA!='6' order by RAMA"; // todos menos monis y asabak

//Print labels
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

	for($rama=1;$rama<7;$rama++){

		$sql2 = "select NOMBRE from ramas where ID=".$rama;
		$fila2 = current($db-> f_sql($sql2));
		$nombre_rama = $fila2['NOMBRE']; ?>
	
		<br />
		<h3><?echo $nombre_rama?></h3>
		<table border=1 style="border-collapse:collapse" width="90%" align="center">
			<tr>	
				<td><b>NOMBRE</b></td>
				<td><b>APELLIDOS</b></td>
				<td><b>DIRECCION</b></td>
				<td><b>DNI</b></td>
			</tr>
	
		<?
		$sql = "select NOMBRE,APELLIDOS,DIRECCION,PUEBLO,DNI,DNI_AMA,DNI_AITA from censo where RAMA='".$rama."'";

		foreach($db-> f_sql($sql) as $fila){

			 switch(strtolower($fila['PUEBLO'])){
			 	case 'sestao':
					$cp = '48910';
					break;
			 	case 'portugalete':
					$cp = '48920';
					break;
			 	case 'baracaldo':
			 	case 'barakaldo':
					$cp = '48901';
					break;
			 }
			 
			 echo "<tr>";
		         echo "<td>".$fila['NOMBRE']."</td>";
			 echo "<td>".$fila['APELLIDOS']."</td>";
			 echo "<td>".$fila['DIRECCION']." ".$cp." ".$fila['PUEBLO']." Bizkaia</td>";
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
?>
<h2>Exportar datos</h2>

<div class="center">

<fieldset>
<legend>Impresión de etiquetas para sobres</legend>
<table border="0" align="center">
	<tr>
		<td>Todos</td>
		<td><input type="checkbox" name="todos"></td>
	</tr>
	<? 
	$sql = "select ID, NOMBRE from ramas";
	foreach($db-> f_sql($sql) as $rama){?>
		<tr>
			<td><?echo $rama['NOMBRE']?></td>
			<td><input type="checkbox" name="<?echo $rama['ID']?>"></td>
		</tr>
	<?}?>
</table>

<br/>
<input type="button" onCLick="javascript:window.location='index2.php?section=<?echo $_GET['section']?>&task=labels'" value="Impresión de etiquetas">
</fieldset>


<br />

<fieldset>
<legend>Exportar datos</legend>
        <a href="index2.php?section=<?echo $_GET['section']?>&task=pdf" ><img alt="Exportar Censo en formato pdf" src="<?echo $THEMEDIR?>/img/pdf-icon-big.gif" /></a>
	<br />
	<input type="button" onCLick="javascript:window.location='index2.php?section=<?echo $_GET['section']?>&task=html'" value="Exportar a html plano">
</fieldset>

<br><br>

<fieldset>
<legend>Total de chavales</legend>
<table border="0" align="center">
        <tr>
                <th>Rama</th>
                <th>Total</th>
        </tr>      
	<?
	$sSql = "SELECT ramas.NOMBRE, COUNT(censo.ID) as total FROM ramas "
		. "left join censo on ramas.ID = censo.RAMA GROUP BY ramas.ID";

	foreach($db-> f_sql($sSql) as $row){?>
	        <tr>
	                <td><?echo $row['NOMBRE']?></td>
	                <td><?echo $row['total']?></td>
	        </tr>   
	<?}?>
</table>
</fieldset>

</div>
<?
}
?>

