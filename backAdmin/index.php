<?php
require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloAdmin($bd);
$filas = $modelo->getList();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Administrador</title>
        <script src="../js/main.js"></script>
    </head>
    <body>Seccion 1: Listado<br/>        
        <table border="1">  
            <tr>
                <th>Login</th>
                <th>Nombre</th>
                <th>Clave</th>
                <th>Email</th>
                <th>is Activo</th>
                <th>Borrar</th>
                <th>Editar</th>
            </tr>
            <?php
            foreach ($filas as $indice => $objeto) {
                ?>
                <tr>
                    <td><?php echo $objeto->getLogin(); ?></td>
                    <td><?php echo $objeto->getNombre(); ?></td>
                    <td><?php echo $objeto->getClave(); ?></td>              
                    <td><?php echo $objeto->getEmail(); ?></td>
                    <td><?php echo $objeto->getIsactivo(); ?></td>   
                    <td><a data-id='<?php echo $objeto->getLogin(); ?>' 
                           class='borrar' href='phpDelete.php?login=<?php echo $objeto->getLogin(); ?>'>borrar</a></td>
                    <td><a data-login='<?php echo $objeto->getLogin(); ?>'
                           href='viewEditar.php?login=<?php echo $objeto->getLogin(); ?>'>editar</a></td>
                </tr>
                <?php
            }
            ?>        
        </table>
        <br/>
        <a href="viewEditar.php">Insertar</a>
        <form action="" method="POST" id="formulario">
            <input type="hidden" name="id" value="" id="idformulario"/>
        </form>
    </body>
</html>
<?php
$bd->closeConexion();
?>