<?php

abstract class Conectar
{
    private $mysqli;
    public function conectar()
    {
        $this->mysqli = new mysqli('localhost', 'root', '','manosenelcodigo');
        return $this->mysqli;
        
    }
    public function setNames()
    {
        $this->mysqli->query("SET NAMES 'utf8'");
    }
} 
