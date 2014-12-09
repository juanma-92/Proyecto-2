<?php
require '../require/comun.php';
$sesion->autentificado("viewlogin.php");
$admin = $sesion->getAdmin();
$error = Leer::get("error");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Editar Admin</title>
        <script src="../js/editarAdmin.js"></script>
        <link href="../css/vieweditar.css" rel="stylesheet" type="text/css">
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
                echo "Error al editar";
            }
            ?>
            <div id="izquierda">Nuevo Administrador:</div>
            <div id="centrar">
                <form action="phpEditar.php" method="POST">            
                    <label for="login">Login</label>                
                    <input type="text" name="login" value="<?php echo $admin->getLogin() ?>" id="login" required/>
                    <label for="nombre">Nombre</label>                
                    <input type="text" name="nombre" value="<?php echo $admin->getNombre() ?>" id="nombre" required/>
                    <label for="clave">Clave</label>
                    <input type="password" name="clave" value="" id="clave" />            
                    <label for="claveNueva">Clave Nueva</label>
                    <input type="password" name="claveNueva" value="" id="claveNueva"/>            
                    <label for="claveConfirmada">Confirmar Clave Nueva</label>
                    <input type="password" name="claveConfirmada" value="" id="claveConfirmada"/>
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php echo $admin->getEmail() ?>" id="email" required/>               
                    <!--comprobar por javascript los valores, que la clave coincida-->
                    <input type="submit" id="modificar" value="Modificar" />
                </form>
            </div>
        </div>
    </body>
</html>