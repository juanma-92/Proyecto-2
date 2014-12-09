<?php
require '../require/comun.php';
$error = Leer::get("error");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Alta Admin</title>
        <link href="../css/viewalta.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="contenedor">
            <div id="nombre1">Juan Manuel Olalla Campos</div>
            <div id="header">
                <div id="logo"><a href="../"><img  src="../images/logo_inmobiliaria.png" /></a></div>
                <div id="derecha"><img  src="../images/inmobiliaria.png" /></div>
            </div>
            <?php
            if ($error == -1) {
                echo "Error al crear el admin";
            }
            ?>
            <div id="izquierda">Nuevo Administrador:</div>
            <div id="centrar">
                <form action="phpAlta.php" method="POST">
                    <label for="login">Login</label>       <br/>         
                    <input type="text" name="login" value="" id="login" required/><br/>
                    <label for="nombre">Nombre</label>        <br/>        
                    <input type="text" name="nombre" value="" id="nombre" required/><br/>
                    <label for="clave">Clave</label><br/>
                    <input type="password" name="clave" value="" id="clave" required/>  <br/>          
                    <label for="claveConfirmada">Confirmar clave</label><br/>
                    <input type="password" name="claveConfirmada" value="" id="claveConfirmada" required/><br/>
                    <label for="email">Email</label><br/>
                    <input type="email" name="email" value="" id="email" required/><br/>
                    <input type="reset" value="limpiar"/>
                    <input type="submit" value="Alta" />
                </form>
            </div>
        </div>
    </body>
</html>