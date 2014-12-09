<?php
require '../require/comun.php';
$login = Leer::post("login");
$clave = Leer::post("clave");
$bd = new BaseDatos();
$modelo = new ModeloAdmin($bd);
$admin = $modelo->login($login, $clave);
$bd->closeConexion();
if($admin == false ){
    $sesion->cerrar();
    header("Location:viewlogin.php?error=Login incorrecto o admin inactivo");
} else {
    $sesion->setAdmin($admin);
    header("Location:../casa_new");
}