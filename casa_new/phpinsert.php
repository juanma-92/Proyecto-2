<?php
require '../require/comun.php';
$bd = new BaseDatos();
$lugar = Leer::post("lugar");
$precio = Leer::post("precio");
$tipo = Leer::post("tipo");

$archivo=$_FILES['imagen']['tmp_name'];
$nombreArchivo=$_FILES['imagen']['name'];
move_uploaded_file($archivo,"imagenes/".$nombreArchivo);
$ruta="imagenes/".$nombreArchivo;

$casa = new Casa(null, $lugar, $precio, $tipo, $ruta);
$modelo = new ModeloCasa($bd);
$r = $modelo->add($casa); 
$bd->closeConexion();
header("Location: index.php?op=insert&r=$r");