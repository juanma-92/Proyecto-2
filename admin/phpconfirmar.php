<?php
require '../require/comun.php';
$id = Leer::get("id");
$bd = new BaseDatos();
$modelo = new ModeloAdmin($bd);
$r = $modelo->activa($id);
if ($r == 1) {
    header("Location:viewlogin.php");
} else {
    header("Location:viewerror.php");
}