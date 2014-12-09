<?php
require '../require/comun.php';
$bd = new BaseDatos();
$id = Leer::request("id");
$modelo = new ModeloAdmin($bd);
$r = $modelo->deletePorId($id);
$bd->closeConexion();
header("Location: index.php?op=delete&r=$r");
