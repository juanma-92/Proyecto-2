<?php
require '../require/comun.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $texto = $_GET["texto"];
        echo htmlspecialchars($texto) ."<br/>";
        //echo htmlentities($texto) ."<br/>";
        /*
        $textoURL= urlencode($texto);
        if(Validar::isCorreo($texto)){            
            echo "es un correo" . "<br/>";
        } else {
            echo "no es un correo" . "<br/>";
        }
        if(Validar::isCodigoPostal($texto)){
            echo "es un codigo postal <br/>";
        } else {
            echo "No es un codigo postal  <br/>";            
        }
        
        if(Validar::isTelefono($texto)){
            echo "es un Telefono  <br/>";
        } else {
            echo "No es un Telefono  <br/>";            
        }
        
        if(Validar::isFecha($texto)){
            echo "es una fecha  <br/>";
        } else {
            echo "No es una fecha  <br/>";            
        }
        
        */
        if(Validar::isDNI($texto)){
            echo "es un dni  <br/>";
        } else {
            echo "No es un dni  <br/>";            
        }
        /*
        $l= 20;
        if(Validar::isLongitudMinima($texto, $l)){
            echo "es mayor o igual de $l caracteres <br/>";
        } else {
            echo "es menor de $l caracteres <br/>";
        }
        
        $l = 5;
        if(Validar::isLongitudMaxima($texto, $l)){
            echo "es menor o igual de $l caracteres <br/>";
        } else {
            echo "es mayor de $l caracteres <br/>";
        }
        
        $lmax = 25;
        $lmin= 15;
        if(Validar::isLongitud($texto, $lmin, $lmax)){
            echo "esta entre $lmin y $lmax caracteres <br/>";
        } else {
            echo "No esta entre $lmin y $lmax caracteres <br/>";
        }
        
        */
        
        
        if(Validar::isScript($texto)){
            echo "es un script <br/>";
        } else {
            echo "No es un script <br/>";
        }
        
        //header("Location: index.php?t=$textoURL");
        ?>
    </body>
</html>