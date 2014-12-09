<?php
require '../require/comun.php';
$pagina = 0;
if (Leer::get("pagina") != null) {
    $pagina = Leer::get("pagina");
}
$bd = new BaseDatos();
$modelo = new ModeloCasa($bd);
$filas = $modelo->getList($pagina);
$paginas = $modelo->getNumeroPaginas();
$total = $modelo->count();
$enlaces = Util::getEnlacesPaginacion2($pagina, $total[0]);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Casas</title>
        <script src="../js/main.js"></script>
        <link href="../css/cliente.css" rel="stylesheet" type="text/css">
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
                            <th>Lugar</th>
                            <th>Precio</th>
                            <th>Tipo</th>
                            <th>Foto</th>
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
                                    <td><?php echo $objeto->getLugar(); ?></td>
                                    <td><?php echo $objeto->getPrecio(); ?>€</td>
                                    <td><?php echo $objeto->getTipo(); ?></td>
                                    <td><img id="foto" src="<?php echo $objeto->getFoto(); ?>"></td>
                                </tr>
                                <?php
                            } else {
                                $i=4;
                                ?>
                                <tr>
                                    <td><?php echo $objeto->getLugar(); ?></td>
                                    <td><?php echo $objeto->getPrecio(); ?>€</td>
                                    <td><?php echo $objeto->getTipo(); ?></td>
                                    <td><img id="foto" src="<?php echo $objeto->getFoto(); ?>"></td>
                                </tr>
                                <?php
                            } 
                        }
                        ?>
                    </tbody>
            </div>     
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
        </div>
    </body>
</html>
<?php
$bd->closeConexion();
