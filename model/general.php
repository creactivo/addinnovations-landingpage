<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/addinnovations-landingpage/conexion/conexion.php';

class General extends Conexion{

	public function __construct()
    {
        $this->conexion = new Conexion();
        $this->data = array();
    }
    public function prueba(){
    	$rand_part = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid());
		return $rand_part;
    }

    public function getRealIP(){

	    if (isset($_SERVER["HTTP_CLIENT_IP"]))
	    {
	        return $_SERVER["HTTP_CLIENT_IP"];
	    }
	    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
	    {
	        return $_SERVER["HTTP_X_FORWARDED_FOR"];
	    }
	    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
	    {
	        return $_SERVER["HTTP_X_FORWARDED"];
	    }
	    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
	    {
	        return $_SERVER["HTTP_FORWARDED_FOR"];
	    }
	    elseif (isset($_SERVER["HTTP_FORWARDED"]))
	    {
	        return $_SERVER["HTTP_FORWARDED"];
	    }
	    else
	    {
	        return $_SERVER["REMOTE_ADDR"];
	    }
	    return rand(5, 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789');//$_SERVER["HTTP_CLIENT_IP"];//$_SERVER["REMOTE_ADDR"];
	} 
   
}



?>