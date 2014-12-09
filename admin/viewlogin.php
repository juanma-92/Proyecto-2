<?php
require '../require/comun.php';
$error = Leer::get("error");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Login Admin</title>
        <link href="../css/viewlogin.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="contenedor">
            <div id="nombre1">Juan Manuel Olalla Campos</div>
            <div id="header">
                <div id="logo"><a href="../"><img  src="../images/logo_inmobiliaria.png" /></a></div>
                <div id="derecha"><img  src="../images/inmobiliaria.png" /></div>
            </div>
            <?php echo $error; ?>
            <div id="izquierda">Entrar como Administrador:</div>
            <div id="centrar">
                <form action="phplogin.php" method="POST">
                    <label for="claveConfirmada">Login</label><br/>
                    <input type="text" name="login" value="" id="login" required/><br/>
                    <label for="claveConfirmada">Clave</label><br/>
                    <input type="password" name="clave" value="" id="clave"  required/><br/>
                    <input type="submit" value="Login" />
                </form>
            </div>
        </div>
    </body>
</html>