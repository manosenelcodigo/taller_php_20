<?php
require_once("conectar.php");
class Usuarios extends Conectar
{
    private $db;
    private $usuarios;
    
    public function __construct() 
    {
        $this->db=parent::conectar();
        parent::setNames();  
         
    }

    
    public function getDatos($sql)
    {
        $this->usuarios=null; 
        $this->usuarios=array(); 
        
        $datos = $this->db->query($sql);
        while($reg=$datos->fetch_object())
        {
            $this->usuarios[]=$reg;
        }
        return $this->usuarios;
    }
} 
