<script>
function f_aceptar(){

	var formulario;	
	formulario = document.insertar;

	if (formulario.nombre.value==""){	
		alert("Debe rellenar el campo nombre");
	}else{
		if (formulario.apellidos.value==""){	
			alert("Debe rellenar el campo apellidos")
		}else{
			if (formulario.direccion.value == ""){	
				alert("Debe rellenar el campo direccion");
			}else{
				if (formulario.telefono.value == ""){	
					alert("Debe rellenar el campo telefono");
				}else{

				formulario.submit();

				}
			}
		}
	}
}
</script>
<?
include 'lib/cabecera.php';

if($_POST){ 

	include 'lib/configuracion.php';
	

	//Si no hay campos vacios, comenzamos con la conexion a la bbdd
	$link = mysql_connect($db_host,$user,$password) 
		or die("No se puede realizar la conexion a la bbdd");
			
	mysql_select_db($database,$link);

	//Con esta sentencia SQL, insertamos los datos en la bbdd
	$sSql = "INSERT INTO census VALUES(NULL,'{$_POST['nombre']}',
		'{$_POST['apellidos']}','{$_POST['rama']}','{$_POST['direccion']}',
		'{$_POST['dni']}','{$_POST['ama']}','{$_POST['dni_ama']}','{$_POST['aita']}',
		'{$_POST['dni_aita']}','{$_POST['telefono']}','{$_POST['movil']}')";
	$result = mysql_query($sSql,$link);

	if (!$result) {
	
		die(' Query Invalida: '. mysql_error());
		
	}else{
			
		echo '<script>alert("Los datos han sido introducidos satisfactoriamente")</script>';
	}
}	

?>
<form name="insertar" method="post" action="">

  <table width="60%" align="center">
	<tr>
	  <td>Nombre:</td>
	  <td><input type="text" name="nombre" size="10"></td>
	</tr>

	<tr>
	  <td>Apellidos: </td>
	  <td><input type="text" name="apellidos" size="30"></td>
	</tr>

	<tr>
	  <td>Rama: </td>
	  <td><select size="1" name="rama">
		<option value="1">Koskorrak</option>
		<option value="2">Kaskondoak</option>
		<option value="3">Oinarinak</option>
		<option value="4">Azkarrak</option>
		<option value="5">Trebeak</option>
		<option value="0">Arduradunak</option>
	</select></td>
	</tr>

	<tr>
	  <td>DNI: </td>
	  <td><input type="text" name="dni" size="10" maxlength="10"></td>
	</tr>

	<tr>
	  <td>Ama: </td>
	  <td><input type="text" name="ama" size="11"></td>
	</tr>

	<tr>
	  <td>DNI Ama: </td>
	  <td><input type="text" name="dni_ama" size="10" maxlength="10"></td>
	</tr>

	<tr>
	  <td>Aita: </td>
	  <td><input type="text" name="aita" size="11"></td>
	</tr>

	<tr>
	  <td>DNI Aita: </td>
	  <td><input type="text" name="dni_aita" size="10" maxlength="10"></td>
	</tr>

	<tr>
	  <td>Dirección: </td>
	  <td><input type="text" name="direccion" size="11"></td>
	</tr>

	<tr>
	  <td>Teléfono: </td>
	  <td><input type="text" name="telefono" size="9" maxlength="9"></td>
	</tr>

	<tr>
	  <td>Movil:</td>
	  <td><input type="text" name="movil" size="9" maxlength="9"></td>
	</tr>

	<tr>
	  <td><input type="button" onClick="f_aceptar()" value="Insertar nuevo chaval/a" name="enviar"></td>
	  <td><input type="reset" value="Restablecer" name="resetear"></td>
	</tr>

  </table>
	
</form>

<?include 'lib/footer.php'?>
