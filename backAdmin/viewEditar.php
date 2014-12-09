<?php
require '../require/comun.php';
$bd = new BaseDatos();
$login = Leer::request("login");
$modelo = new ModeloAdmin($bd);
$admin = $modelo->get($login);
$bd->closeConexion();
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Insertar / Editar</title>
        <script src="../js/main.js"></script>
    </head>
    <body>
        <form action="<?php echo(isset($login) ? "phpUpdate.php" : "phpInsert.php"); ?>" method="POST">            
            <input type="hidden" name="loginpk" id="loginpk" value="<?php echo $admin->getLogin(); ?>"/>
            <input type="text" name="login" value="<?php echo $admin->getLogin() ?>" id="login" placeholder="login" required/>
            <input type="text" name="nombre" value="<?php echo $admin->getNombre() ?>" id="nombre" placeholder="nombre" required/>
            <input type="email" name="email" value="<?php echo $admin->getEmail() ?>" id="email" placeholder="email" required/>            
            <br/>
            <!--<input type="hidden" name="rol" value="usuario" id="rol" />-->
            <input type="submit" value="<?php echo(isset($login) ? "Editar" : "Alta"); ?>" />
        </form>
    </body>
</html>