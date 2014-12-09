<?php
require '../require/comun.php';
$direccion = Leer::get("direccion");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Bienvenida</title>
    </head>
    <body>
        <a href="<?php echo $direccion; ?>"><?php echo $direccion; ?></a>
    </body>
</html>