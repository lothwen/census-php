<?

//Borro las cookies
setcookie("data[0]");
setcookie("data[l]"); 
setcookie("data[2]");

//Borro las variables (no funciona)
unset($_SERVER['PHP_AUTH_USER']);
unset($_SERVER['PHP_AUTH_PW']);

//Redirigo a la web principal
header("Location: index.php");

?>
