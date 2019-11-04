<?php

class Rsetting{
    private $con;
    private $usr;
    private $pss;
    function __construct($stringc, $usuario, $contraseña) {
        $this->con =$stringc;
        $this->usr = $usuario;
        $this->pss = $contraseña;
    }

    function C(){
        return $this->con;
    }
    function U(){
        return $this->usr;
    }
    function P(){
        return $this->pss;
    }
    

}