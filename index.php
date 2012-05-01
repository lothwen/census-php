<?php
if (isset( $_POST['submit'] )) {

	include "includes/cMysql.php";

	$db = new cMysql();
	$db-> select_db("census_general");

	$username 	= stripslashes( $_POST['username'] );
	$pass 		= stripslashes( $_POST['pass'] );

	if($pass == NULL) {
		Header("Location: index.php?errmsg=1");
		exit();
	}
	
	/* Selecionar el usuario y el grupo con sus datos*/
        $sql = "select Usuarios.COD_USUARIO, Usuarios.NOMBRE as NOMBRE_USUARIO, Usuarios.TIPO, Usuarios.COD_GRUPO,"
        . " Grupos.NOMBRE as NOMBRE_GRUPO, Grupos.NOMBRE_BBDD"
        . " from Usuarios, Grupos"
        . " where Usuarios.COD_GRUPO=Grupos.COD_GRUPO"
        . " and Usuarios.USUARIO='" . mysql_escape_string($username) . "'"
        . " and Usuarios.CLAVE='" . mysql_escape_string($pass) . "'";

	if(count(@$db-> f_sql($sql))==1){

		@$fila=current($db-> f_sql($sql));

		$id=$fila['COD_USUARIO'];
		$username=$fila['NOMBRE_USUARIO'];

		// construct Session ID
		$logintime	= time();
		$session_id 	= md5( $id . $username . $logintime );

		session_id( $session_id );
		session_start();

		// add Session ID entry to DB
		$sql = "INSERT INTO session SET time = '$logintime',"
		. " session_id = '$session_id', userid = '$id', username = '$username '";

		@$db-> f_sql($sql);

		$_SESSION['session_id'] 	= $session_id;
		$_SESSION['session_user_id'] 	= $id;
		$_SESSION['session_username'] 	= $username;
		$_SESSION['session_logintime'] 	= $logintime;
                
		$_SESSION['val_cod_usu']	=$fila['COD_USUARIO'];
                $_SESSION['val_nombre_usu']	=$fila['NOMBRE_USUARIO'];
                $_SESSION['val_rol']		=$fila['TIPO'];
                $_SESSION['val_nombre_grupo']	=$fila['NOMBRE_GRUPO'];
                $_SESSION['val_cod_grupo']	=$fila['COD_GRUPO'];
                $_SESSION['val_nombre_bbdd']	=$fila['NOMBRE_BBDD'];
	

		session_write_close();

		header("Location: portada.php");

		exit();

	} else {
		Header("Location: index.php?errmsg=2");
	}
}else{?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Census</title>
<link rel="stylesheet" href="themes/login/login.css" type="text/css" />

<meta http-equiv="Content-Type" content="text/html; charset:utf-8" />
<link rel="shortcut icon" href="themes/login/images/favicon.ico" />
</head>
<body>
<div id="wrapper">
	<div id="header">
		<!--	<div id="logo"><img src="themes/login/images/header_text.png" alt="Census Logo" /></div>-->
			<div id="logo"><h1 style="color:white; height: 38px; margin:0px">Census</h1></div>
	</div>
</div>
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td class="menubackgr" style="padding-left:5px;">Euskalerriko Eskautak Bizkaia</td>
</tr>
</table>

<br /><br /><br />

<?
if($errmsg==1){
	$errmsg="Por favor ponga una contraseña";
}elseif($errmsg==2)
	$errmsg="Nombre de usuario o Contraseña incorrecto.  Intentelo de nuevo";
?>

<div align="center" id="ctr">
	
	<?if(isset($errmsg)){?>
		<div class="message"><?echo $errmsg;?></div>
	<?}?>
	
	<div class="login">
		<div class="login-form">
			<img alt="Acceder" src="themes/login/images/login.gif"/>
			<form id="loginForm" name="loginForm" method="post" action="index.php">
			<div class="form-block">
				<br />
				<div class="inputlabel">Nombre de Usuario </div>
				<div><input type="text" size="15" class="inputbox" name="username"/></div>
				<div class="inputlabel">Contraseña</div>
				<div><input type="password" size="15" class="inputbox" name="pass"/></div>
				<div align="left"><input type="submit" value="Entrar" class="button" name="submit"/>
				</div>
			</div>
			</form>
	  	</div>
		<div class="login-text">
			<div class="ctr"><img height="64" width="64" alt="seguridad" src="themes/login/images/security.png"/></div>
			<p>Bienvenido a Census!</p>
			<p>Tienes que usar un Nombre de usuario y Contraseña validos para acceder .</p>
		</div>
		<div class="clr"></div>
	</div>
	<div id="break"></div>
	
	<div class="footer" align="center">
		<div align="center"> Census es software libre bajo licencia GNU/GPL.</div>
	</div>
</div>
</body>
</html>
<?}?>
