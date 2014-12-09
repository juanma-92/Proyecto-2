<?php
require '../require/comun.php';
$id = Leer::post("id");
$lugar = Leer::post("lugar");
$precio = Leer::post("precio");
$tipo = Leer::post("tipo");

$archivo=$_FILES['imagen']['tmp_name'];
$nombreArchivo=$_FILES['imagen']['name'];
move_uploaded_file($archivo,"imagenes/".$nombreArchivo);
$ruta="imagenes/".$nombreArchivo;

$casa = new Casa($id, $lugar, $precio, $tipo, $ruta);
$bd = new BaseDatos();
$modelo = new ModeloCasa($bd);
$cambioDeFoto = strlen($ruta)> 9;
if($cambioDeFoto){
    $r = $modelo->editConFoto($casa, $casa->getId(), $casa->getFoto());
} else {
    $r = $modelo->editSinFoto($casa, $casa->getId());
}
$bd->closeConexion();
header("Location: index.php?op=update&r=$r");