<?php
require '../require/comun.php';
$sesion->autentificado("viewlogin.php");
$admin = $sesion->getAdmin();
$login = Leer::post("login");
$nombre = Leer::post("nombre");
$clave = Leer::post("clave");
$claveNueva = Leer::post("claveNueva");
$claveConfirmada = Leer::post("claveConfirmada");
$email = Leer::post("email");
$nuevoAdmin = new Admin($login, $nombre, $claveNueva, $email);
$bd = new BaseDatos();
$modelo = new ModeloAdmin($bd);
$cambioDeClave = strlen($claveNueva)> 0 && $claveNueva==$claveConfirmada ;
$cambioDeCorreo = $email!=$admin->getEmail();
if($cambioDeClave){
    $r = $modelo->editConClave($nuevoAdmin, $admin->getLogin(), $admin->getClave());
} else {
    $r = $modelo->editSinClave($nuevoAdmin, $admin->getLogin());
}
if($cambioDeCorreo && $r>0){
    $r = $modelo->desactivar($admin->getLogin());//implementar
    $id = md5($email.Configuracion::PEZARANA.$login);    
    $enlace = "Click aqui: <a href='".Entorno::getEnlaceCarpeta("phpconfirmar.php?id=$id")."'>Validar cuenta</a>";       
    $correo = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, "alta en web", $enlace, Configuracion::CLAVEGMAIL);  
    header("Location: phplogout.php");    
    exit();
}
$sesion->setAdmin($admin);
$bd->closeConexion();
//header("Location:viewprivado.php?r=$r");   