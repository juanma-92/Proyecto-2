<?php
require '../require/comun.php';
$pagina = 0;
$sesion->autentificado("../admin/viewlogin.php");
if (Leer::get("pagina") != null) {
    $pagina = Leer::get("pagina");
}
$bd = new BaseDatos();
$modelo = new ModeloCasa($bd);
$filas = $modelo->getList($pagina);
$paginas = $modelo->getNumeroPaginas();
//$enlaces = Util::getEnlacesPaginacion($pagina, $paginas);
$total = $modelo->count();
$enlaces = Util::getEnlacesPaginacion2($pagina, $total[0]);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Casas</title>
        <script src="../js/main.js"></script>
        <link href="../css/casanew.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="contenedor">
            <div id="nombre">Juan Manuel Olalla Campos</div>
            <div id="header">
                <div id="logo"><a href="../"><img  src="../images/logo_inmobiliaria.png" /></a></div>
                <div id="derecha"><img  src="../images/inmobiliaria.png" /></div>
            </div>
            <br/>    
            <div class="datagrid">
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Lugar</th>
                            <th>Precio</th>
                            <th>Tipo</th>
                            <th>Foto</th>
                            <th>Borrar</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($filas as $indice => $objeto) {
                            if ($i%2==0) {
                                $i=1;
                                ?>
                                    <tr class="alt">
                                    <td><?php echo $objeto->getId(); ?></td>
                                    <td><?php echo $objeto->getLugar(); ?></td>
                                    <td><?php echo $objeto->getPrecio(); ?>€</td>
                                    <td><?php echo $objeto->getTipo(); ?></td>
                                    <td><img id="foto" src="<?php echo $objeto->getFoto(); ?>"></td>
                                    <td><a data-id='<?php echo $objeto->getId(); ?>' 
                                           data-lugar='<?php echo $objeto->getLugar() . " " . $objeto->getPrecio(); ?>' 
                                           class='borrar' href='phpDelete.php?id=<?php echo $objeto->getId(); ?>'>borrar</a></td>
                                    <td><a class='editar' data-id='<?php echo $objeto->getId(); ?>'
                                           href='phpUpdate.php?id=<?php echo $objeto->getId(); ?>'>editar</a></td>
                            </tr>
                                <?php
                            } else {
                                $i=4;
                                ?>
                                <tr>
                                    <tr>
                                    <td><?php echo $objeto->getId(); ?></td>
                                    <td><?php echo $objeto->getLugar(); ?></td>
                                    <td><?php echo $objeto->getPrecio(); ?>€</td>
                                    <td><?php echo $objeto->getTipo(); ?></td>
                                    <td><img id="foto" src="<?php echo $objeto->getFoto(); ?>"></td>
                                    <td><a data-id='<?php echo $objeto->getId(); ?>' 
                                           data-lugar='<?php echo $objeto->getLugar() . " " . $objeto->getPrecio(); ?>' 
                                           class='borrar' href='phpDelete.php?id=<?php echo $objeto->getId(); ?>'>borrar</a></td>
                                    <td><a class='editar' data-id='<?php echo $objeto->getId(); ?>'
                                           href='phpUpdate.php?id=<?php echo $objeto->getId(); ?>'>editar</a></td>
                                </tr>
                                <?php
                            } 
                        }
                        ?>
                    </tbody>
                        <tr>
                            <td colspan="5">                    
                                <?php echo $enlaces["inicio"]; ?>
                                <?php echo $enlaces["anterior"]; ?>
                                <?php echo $enlaces["primero"]; ?>
                                <?php echo $enlaces["segundo"]; ?>
                                <?php echo $enlaces["actual"]; ?>
                                <?php echo $enlaces["cuarto"]; ?>
                                <?php echo $enlaces["quinto"]; ?>
                                <?php echo $enlaces["siguiente"]; ?>
                                <?php echo $enlaces["ultimo"]; ?>
                            </td>
                        </tr>
                </table>

            </div>
            <br/>
            <div id="nueva">
            Nueva Casa:<br/><br/>
            <form action="phpInsert.php" method="POST" enctype="multipart/form-data">
                <label for="lugar">Lugar</label>
                <input type="text" name="lugar" value="" id="lugar" required/>
                <label for="precio">Precio</label>
                <input type="number" name="precio" value="" id="precio" required/>
                <label for="tipo">Tipo</label>
                <input type="text" name="tipo" value="" id="tipo" required/>
                <label for="foto">Foto</label>
                <input type="file" name="imagen" value="" id="imagen" placeholder="imagen" required/>
                <input type="submit" value="Añadir" />
            </form>
            <br/>
            <form action="" method="POST" id="formulario">
                <input type="hidden" name="id" value="" id="idformulario"/>
            </form>
            <div id="editar"><a href="../admin/vieweditar.php">Editar Administrador</a></div>
            </div>
    </body>
</html>
<?php
$bd->closeConexion();
