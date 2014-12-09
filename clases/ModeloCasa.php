<?php
class ModeloCasa {
    //Implementamos los métodos que necesitamos para trabajar con la casa
    private $bd;
    private $tabla = "casa";
    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
    function add(Casa $objeto) {
        $sql = "insert into $this->tabla values (null, :lugar, :precio, :tipo, :foto);";
        $parametros["lugar"] = $objeto->getLugar();
        $parametros["precio"] = $objeto->getPrecio();
        $parametros["tipo"] = $objeto->getTipo();
        $parametros["foto"] = $objeto->getFoto();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico(); //return 0 si no fuera autonumerico        
    }
    function delete(Casa $objeto) {
        $sql = "delete from $this->tabla where id=:id;";
        $parametros["id"] = $objeto->getId();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
    function deletePorId($id) {
        return $this->delete(new Casa($id));
    }
    //clave principal autonumérica
    function edit(Casa $objeto) {
        $sql = "update $this->tabla set lugar=:lugar, "
                . "precio=:precio, tipo=:tipo, foto=:foto where id=:id;";
        $parametros["id"] = $objeto->getId();
        $parametros["lugar"] = $objeto->getLugar();
        $parametros["precio"] = $objeto->getPrecio();
        $parametros["tipo"] = $objeto->getTipo();
        $parametros["foto"] = $objeto->getFoto();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
    //clave principal no autonumérica
    function editPK(Casa $objetoOriginal, Casa $objetoNuevo) {
        $sql = "update $this->tabla set id=:id lugar=:lugar, "
                . "precio=:precio, tipo=:tipo, foto=:foto where id=:idpk;";
        $parametros["id"] = $objetoNuevo->getId();
        $parametros["lugar"] = $objetoNuevo->getLugar();
        $parametros["precio"] = $objetoNuevo->getPrecio();
        $parametros["tipo"] = $objeto->getTipo();
        $parametros["foto"] = $objeto->getFoto();
        $parametros["idpk"] = $objetoOriginal->getId();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
    function editConFoto(Casa $objeto) {
        $sql = "update $this->tabla set lugar=:lugar, "
                . "precio=:precio, tipo=:tipo, foto=:foto where id=:id;";
        $parametros["id"] = $objeto->getId();
        $parametros["lugar"] = $objeto->getLugar();
        $parametros["precio"] = $objeto->getPrecio();
        $parametros["tipo"] = $objeto->getTipo();
        $parametros["foto"] = $objeto->getFoto();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
    function editSinFoto(Casa $objeto) {
        $sql = "update $this->tabla set lugar=:lugar, "
                . "precio=:precio, tipo=:tipo where id=:id;";
        $parametros["id"] = $objeto->getId();
        $parametros["lugar"] = $objeto->getLugar();
        $parametros["precio"] = $objeto->getPrecio();
        $parametros["tipo"] = $objeto->getTipo();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
    function editConsulta($asignacion, $condicion = "1=1", $parametros = array()) {
        $sql = "update $this->tabla set $asignacion where $condicion"; 
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
    //le paso el id y me devuelve el objeto completo
    function get($id) {
        $sql = "select * from $this->tabla where id=:id;";
        $parametros["id"] = $id;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $casa = new Casa();
            $casa->set($this->bd->getFila());
            return $casa;
        }
        //return new Casa();
        return null;
    }
    function count($condicion = "1=1", $parametros = array()) {
        $sql = "select count(*) from $this->tabla where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            //return $this->bd->getFila()[0];
            return $this->bd->getFila();
        }
        return -1;
    }
    //poner en la clase util
    function getNumeroPaginas($rpp=Configuracion::RPP){
        $lista = $this->count();
        return (ceil($lista[0] / $rpp) - 1);
    }
            
    function getList($pagina=0,  $rp=10, $condicion = "1=1", $parametros = array(), $orderBy = "1") {
        $list = array(); //$list = [];
        $principio = $pagina * $rp;
        $sql = "select * from $this->tabla where $condicion order by $orderBy limit $principio, 10";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $casa = new Casa();
                $casa->set($fila);
                $list[] = $casa;
            }
        } else {
            return null;
        }
        return $list;
    }
    function selectHtml($id, $name, $valorSeleccionado = "", $parametros=array(), $condicion="1=1",  $orderBy = "1", 
             $blanco = TRUE, $textoBlanco = "&nbsp") {
        $select = "<select name='$name' id='$id'>";
        if ($blanco) {
            $select .= "<option value=''>$textoBlanco</option>";
        }
        //while y añado todos los option que quiera (hacerlo con el getList)
        $lista = $this->getList(null, null, $condicion, $parametros, $orderBy);
        foreach ($lista as $objeto) {
            $selected = "";
            if ($objeto->getId() == $valorSeleccionado) {
                $selected = "selected";
            }
            $select .= "<option $selected value='" . $objeto->getId() . "'>"
                    . $objeto->getPrecio() . ", " 
                    . $objeto->getTipo() .", ". $objeto->getFoto() ."</option>";
        }
        $select .= "</select>";
        return $select;
    }
}
?>