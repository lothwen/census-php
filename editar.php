<script>
function f_aceptar(){

	var formulario;	
	formulario = document.actualizar;

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
include 'lib/cabecera.php'
include 'lib/conexionbd.php';
	
if ($borrar){

	//Con esta sentencia SQL, borramos el registro de la bbdd
	f_ejecutar("DELETE FROM census WHERE ID=$borrar");

	if($debug){
		echo "Borrando el chaval : ".$borrar;
	}else{
		echo "<script>window.location=\"busqueda.php\"</script>";
	}
	
}elseif($_POST){

	// Actualizo todos los datos.
	$sSql = "UPDATE census SET NOMBRE='$nombre', APELLIDOS='$apellidos', RAMA='$rama', DNI='$dni', AMA='$ama',";
	$sSql .= "DNI_AMA='$dni_ama', AITA='$aita', DNI_AITA='$dni_aita', DIRECCION='$direccion', TELEFONO='$telefono', MOVIL='$movil' WHERE ID='$id'";
	f_ejecutar($sSql);
	
	if($debug){
		echo $sSql."<br>";
		echo "Actualizando el chaval : ".$id;
	}else{
		echo "<script>window.location=\"busqueda.php\"</script>";
	}
}else{ 

	//Recojo todos los datos del chaval a editar
	$result = f_leer("SELECT *  FROM census WHERE ID=".$id);

88
	$fila = mysql_fetch_array($result);
?>
<form name="actualizar" method="post" action="?id=<?echo $fila['ID']?>">

  <table width="60%" align="center">
	<tr>
	  <td>Nombre:</td>
	  <td><input type="text" name="nombre" value="<?echo $fila['NOMBRE']?>" size="10"></td>
	</tr>

	<tr>
	  <td>Apellidos: </td>
	  <td><input type="text" name="apellidos" value="<?echo $fila['APELLIDOS']?>" size="30"></td>
	</tr>

	<tr>
	  <td>Rama: </td>
	  <td><select size="1" name="rama">
	  <? switch ($fila['RAMA']){
	  	case 1:
			$rama1="selected";
			break;
		case 2:
			$rama2="selected";
			break;

		case 3:
			$rama3="selected";
			break;

		case 4:
			$rama4="selected";
			break;

		case 5:
			$rama5="selected";
			break;

		case 0:
			$rama0="selected";
			break;
	      }?>
		<option value="1" <?echo $rama1?>>Koskorrak</option>
		<option value="2" <?echo $rama2?>>Kaskondoak</option>
		<option value="3" <?echo $rama3?>>Oinarinak</option>
		<option value="4" <?echo $rama4?>>Azkarrak</option>
		<option value="5" <?echo $rama5?>>Trebeak</option>
		<option value="0" <?echo $rama0?>>Arduradunak</option>
	</select></td>
	</tr>

	<tr>
	  <td>DNI: </td>
	  <td><input type="text" name="dni" value="<?echo $fila['DNI']?>" size="11"></td>
	</tr>

	<tr>
	  <td>Ama: </td>
	  <td><input type="text" name="ama" value="<?echo $fila['AMA']?>" size="11"></td>
	</tr>

	<tr>
	  <td>DNI Ama: </td>
	  <td><input type="text" name="dni_ama" value="<?echo $fila['DNI_AMA']?>" size="11"></td>
	</tr>

	<tr>
	  <td>Aita: </td>
	  <td><input type="text" name="aita" value="<?echo $fila['AITA']?>" size="11"></td>
	</tr>

	<tr>
	  <td>DNI Aita: </td>
	  <td><input type="text" name="dni_aita" value="<?echo $fila['DNI_AITA']?>" size="11"></td>
	</tr>

	<tr>
	  <td>Dirección: </td>
	  <td><input type="text" name="direccion" value="<?echo $fila['DIRECCION']?>" size="11"></td>
	</tr>

	<tr>
	  <td>Teléfono: </td>
	  <td><input type="text" name="telefono" value="<?echo $fila['TELEFONO']?>" size="11"></td>
	</tr>

	<tr>
	  <td>Movil:</td>
	  <td><input type="text" name="movil" value="<?echo $fila['MOVIL']?>" size="11"></td>
	</tr>

	<tr>
	  <td><input type="button" onClick="f_aceptar()" value="Actualizar" name="enviar"></td>
	  <td><input type="reset" value="Restablecer" name="resetear"></td>
	</tr>

  </table>
	
</form>
<?
}
include 'lib/footer.php';
?>
