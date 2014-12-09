<?php
require '../require/comun.php';
$login = Leer::post("login");
$nombre = Leer::post("nombre");
$clave = Leer::post("clave");
$claveConfirmada = Leer::post("claveConfirmada");
$email = Leer::post("email");
$bd = new BaseDatos();
$modelo = new ModeloAdmin($bd);
$admin = new Admin($login, $nombre, $clave, $email);
$r = $modelo->add($admin);
$bd->closeConexion();
if($r==1){
    $id = md5($email.Configuracion::PEZARANA.$login);
    $direccion = Entorno::getEnlaceCarpeta("phpconfirmar.php?id=$id");
    header ("Location: viewbienvenida.php?direccion=$direccion");
    exit;
}
header ("Location: viewalta.php?error=$r");