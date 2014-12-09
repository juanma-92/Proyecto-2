<?php
/**
 * Class BaseDatos
 *
 * @version 0.2
 * @author Juan Manuel Olalla Campos
 * @license http://...
 * @copyright Juan Manuel Olalla Campos
 * Clase para el Administrador.
 * 
 */
class Admin {
    //orden de las variables en el orden de la tabla
    private $login;
    private $nombre;
    private $clave;  
    private $email;
    private $isactivo;
    
    //orden igual que las variables, parametros por defecto null
    function __construct($login = null, $nombre = null, $clave = null, $email = null, 
            $isactivo = 0) {
        $this->login = $login;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->email = $email;
        $this->isactivo = $isactivo;
    }
    
    //array de datos y posicion inicial
    function set($datos, $inicio=0){
        $this->login = $datos[0 + $inicio];
        $this->nombre = $datos[1 + $inicio];
        $this->clave = $datos[2 + $inicio];
        $this->email = $datos[3 + $inicio];
        $this->isactivo = $datos[4 + $inicio];
    }
    public function getLogin() {
        return $this->login;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getIsactivo() {
        return $this->isactivo;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setIsactivo($isactivo) {
        $this->isactivo = $isactivo;
    }


}