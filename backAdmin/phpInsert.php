<?php
require '../require/comun.php';
$bd = new BaseDatos();
$login = Leer::post("login");
$nombre = Leer::post("nombre");
$clave = Leer::post("clave");
$email = Leer::post("email");
$isactivo = 0;
if(isset($_POST["isactivo"])){    
    $isactivo = 1;
}
$admin = new Admin($login, $nombre, $clave, $email, $isactivo);
$modelo = new ModeloAdmin($bd);
$r = $modelo->add($admin); 
$bd->closeConexion();
//header("Location: index.php?op=insert&r=$r");