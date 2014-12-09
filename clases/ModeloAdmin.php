<?php
class ModeloAdmin {
    //Implementamos los métodos que necesitamos para trabajar con la persona
    private $bd = null;
    private $tabla = "admin";
    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }
    function add(Admin $objeto) {
        $sql = "insert into $this->tabla values (:login, :nombre, :clave, "
                . " :email, :isactivo);";
        $parametros["login"] = $objeto->getLogin();
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["clave"] = sha1($objeto->getClave());
        $parametros["email"] = $objeto->getEmail();
        $parametros["isactivo"] = $objeto->getIsactivo();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $r; //return 1 si se ha insertado     
    }
    function alta(Admin $objeto) {
        $sql = "insert into $this->tabla values (:login, :nombre, :clave, "
                . ":email, :isactivo);";
        $parametros["login"] = $objeto->getLogin();
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["clave"] = $objeto->getClave();
        $parametros["email"] = $objeto->getEmail();
        $parametros["isactivo"] = 0;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        //mandar correo
        return $r; //return 1 si se ha insertado     
    }
    function delete(Admin $objeto) {
        $sql = "delete from $this->tabla where login=:login;";
        $parametros["login"] = $objeto->getLogin();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
    function deletePorId($id) {
        return $this->delete(new Admin($id));
    }
    function editPK(Admin $objeto, $loginpk) {
        $sql = "update $this->tabla set login=:login, nombre=:nombre, clave=:clave"
                . ", email=:email, isactivo=:isactivo  where login=:loginpk;";
        $parametros["login"] = $objeto->getLogin();
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["clave"] = sha1($objeto->getClave());
        $parametros["email"] = $objeto->getEmail(); 
        $parametros["isactivo"] = $objeto->getIsactivo();
        $parametros["loginpk"] = $loginpk;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
    function editConClave(Admin $objeto, $loginpk, $claveold) {
        $asignacion = "login=:login, clave=:clave, "
                . "nombre=:nombre, "
                . "email=:email";
        $condicion = "login=:loginpk and clave=:claveold";
        $parametros["login"] = $objeto->getLogin();
        $parametros["clave"] = sha1($objeto->getClave());
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["email"] = $objeto->getEmail();
        $parametros["loginpk"] = $loginpk;
        $parametros["claveold"] = $claveold;
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }
    function editSinClave(Admin $objeto, $loginpk) {
        $asignacion = "login=:login, nombre=:nombre, email=:email";
        $condicion = "login=:loginpk";
        $parametros["login"] = $objeto->getLogin();
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["email"] = $objeto->getEmail();
        $parametros["loginpk"] = $loginpk;
        
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }
    function desactivar($loginpk) {
        $sql = "update $this->tabla set isactivo=0 where login=:login;";
        $parametros["login"] = $loginpk;
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
    function activa($id) {
        $sql = "update admin "
                . "set isactivo = 1 "
                . "where isactivo = 0 and md5(concat(email,'" . Configuracion::PEZARANA . "',login))=:id;";
        //si quiero poner al admin desactivado, pongo -1, no 0 si no se podria volver a dar de alta
        $parametros["id"] = $id;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
    function login($login, $clave) {
        $sql = "select login from admin where clave=:clave and isactivo=1;";
        $parametros["clave"] = sha1($clave);
        $r = $this->bd->setConsulta($sql, $parametros);
        $resultado = $this->bd->getFila();
        $loginEncontrado = $resultado[0];
        if ($login == $loginEncontrado) {
            return $this->get($loginEncontrado);
        }
        return false;
    }
    //le paso el id y me devuelve el objeto completo
    function get($login) {
        $sql = "select * from $this->tabla where login=:login;";
        $parametros["login"] = $login;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $admin = new Admin();
            $admin->set($this->bd->getFila());
            return $admin;
        }
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
    function getList($condicion = "1=1", $parametros = array(), $orderBy = "1") {
        $list = array(); //$list = [];
        $sql = "select * from $this->tabla where $condicion order by $orderBy";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $admin = new Admin();
                $admin->set($fila);
                $list[] = $admin;
            }
        } else {
            return null;
        }
        return $list;
    }
    function selectHtml($id, $condicion, $parametros, $orderBy = "1", $valorSeleccionado = "", $blanco = TRUE, $textoBlanco = "&nbsp") {
        $select = "<select name='name' id='id'>";
        if ($blanco) {
            $select .= "<option value=''>$textoBlanco</option>";
        }
        //while y añado todos los option que quiera (hacerlo con el getList)
        $lista = $this->getList($condicion, $parametros, $orderBy);
        foreach ($lista as $objeto) {
            $selected = "";
            if ($objeto->getId() == $valorSeleccionado) {
                $selected = "selected";
            }
            $select .= "<option $selected value='" . $objeto->getLogin() . "'>"
                    . $objeto->getNombre() . ", ". $objeto->getEmail() . ", "
                    . $objeto->getIsactivo() ."</option>";
        }
        $select .= "</select>";
        return $select;
    }
}