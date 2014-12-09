<?php
require '../require/comun.php';
$bd = new BaseDatos();
$login = Leer::post("login");
$nombre = Leer::post("nombre");
$clave = Leer::post("clave");
$email = Leer::post("email");
$isactivo = Leer::post("isactivo");
echo $isactivo;
$loginpk = Leer::post("loginpk");
$admin = new Admin($login, $nombre, $clave, $email, $isactivo);
$modelo = new ModeloAdmin($bd);
$r = $modelo->editPK($admin, $loginpk); 
$bd->closeConexion();
header("Location: index.php?op=insert&r=$r");