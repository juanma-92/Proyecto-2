<?php
class Sesion {
    private $nombre = array(), $valor = array();
    function __construct($nombre = "") {
        if ($nombre != "")
            $this->nombre[] = $nombre;
        session_start();
    }
    public function set($nombre, $valor) {
        if (!is_array($nombre) && !is_array($valor)) {
            if (isset($_SESSION[$nombre])) {
                $_SESSION[$nombre] = $valor;
            } else {
                for ($i = 0; $i < count($this->nombre); $i++) {
                    if (isset($_SESSION[$this->nombre[i]])) {
                        $this->valor[i] = $valor;
                        $existe = true;
                        return $existe;
                    } else
                        $existe = false;
                }
                if (isset($exite)) {
                    if (!$existe) {
                        $this->nombre[] = $nombre;
                        $this->valor[] = $valor;
                    }
                } else {
                    $_SESSION[$nombre] = $valor;
                }
            }
        }
    }
    public function get($nombre) {
        if (isset($_SESSION[$nombre]))
            return $_SESSION[$nombre];
        else
            return NULL;
    }
    public function getNombre() {
        $array = array();
        foreach ($_SESSION as $nombre => $valor) {
            $array[] = $nombre;
        }
        return $array;
    }
    public function delete($nombre = "") {
        if ($nombre == "")
            unset($_SESSION);
        else {
            if (isset($_SESSION[$nombre]))
                unset($_SESSION[$nombre]);
        }
    }
    public function deleteAll() {
        foreach ($_SESSION as $nombre => $valor) {
            $_SESSION[$nombre] = "";
        }
        //unset($_SESSION);
        //session_destroy();
    }
    public function destroy() {
        session_destroy();
    }
    public function isSesion() {
        if (count($_SESSION) > 0)
            return true;
        return false;
    }
    public function isAutentificado() {
        return isset($_SESSION["admin"]);
    }
    public function getAdmin() {
        return $_SESSION["admin"];
    }
    public function setAdmin($valor) {
        $_SESSION["admin"] = $valor;
    }
}
?>