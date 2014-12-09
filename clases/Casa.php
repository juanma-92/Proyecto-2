<?php
/**
 * Class BaseDatos
 *
 * @version 0.2
 * @author Juan Manuel Olalla Campos
 * @license http://...
 * @copyright Juan Manuel Olalla Campos
 * Clase para las casas.
 * 
 */
class Casa {
    //orden de las variables en el orden de la tabla
    private $id;
    private $lugar;
    private $precio;
    private $tipo;
    private $foto;
    
    //orden igual que las variables, parametros por defecto null
    function __construct($id = null, $nombre = null, $apellidos = null, $tipo = null, $foto = null) {
        $this->id = $id;
        $this->lugar = $nombre;
        $this->precio = $apellidos;
        $this->tipo = $tipo;
        $this->foto = $foto;
    }
    
    //array de datos y posicion inicial
    function set($datos, $inicio=0){
        $this->id = $datos[0 + $inicio];
        $this->lugar = $datos[1 + $inicio];
        $this->precio = $datos[2 + $inicio];
        $this->tipo = $datos[3 + $inicio];
        $this->foto = $datos[4 + $inicio];
    }
    public function getId() {
        return $this->id;
    }

    public function getLugar() {
        return $this->lugar;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLugar($lugar) {
        $this->lugar = $lugar;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }


}
