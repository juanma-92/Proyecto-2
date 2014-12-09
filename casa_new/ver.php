<?php
require '../require/comun.php';
$bd = new BaseDatos();
$id = Leer::request("id");
$modelo = new ModeloCasa($bd);
$casa = $modelo->get($id);
$bd->closeConexion();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/ver.css" rel="stylesheet" type="text/css">
        <title></title>
</script>
    </head> 
    <body>
        <div id="contenedor">
            <div id="nombre1">Juan Manuel Olalla Campos</div>
            <div id="header">
                <div id="logo"><a href="../"><img  src="../images/logo_inmobiliaria.png" /></a></div>
                <div id="derecha"><img  src="../images/inmobiliaria.png" /></div>
            </div>
            <div id="izquierda">Editar Administrador:</div>
            <div id="centrar">
                <form action="phpUpdate.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"/>
                    <label for="lugar">Lugar</label><br/>
                    <input type="text" name="lugar" value="<?php echo $casa->getLugar(); ?>" id="lugar"/><br/>
                    <label for="precio">Precio</label><br/>
                    <input type="number" name="precio" value="<?php echo $casa->getPrecio(); ?>" id="precio"/><br/>
                    <label for="tipo">Tipo</label><br/>
                    <input type="text" name="tipo" value="<?php echo $casa->getTipo(); ?>" id="tipo"/><br/>
                    <label for="foto">Foto -> Antigua: <?php echo $casa->getFoto(); ?> </label><br/>
                    <input type="file" name="imagen" value="" id="imagen" placeholder="imagen"/><br/>
                    <input type="submit" value="Editar" />
                </form>
            </div>  
        </div>
    </body>
</html>