<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/addinnovations-landingpage/conexion/conexion.php';

class General extends Conexion{

	public function __construct()
    {
        $this->conexion = new Conexion();
        $this->data = array();
    }
    public function generarToken(){
		return strtotime(date("Y-m-d h:m:s"));
    }

    public function registrarToken($token){
    	$sql = " insert into sesiones (tiempo_i, tiempo_f, token, id_usuario) values (now(), now(), ?, 0); ";
    	$stmt = $this->conexion->prepare($sql);
    	$stmt->bindParam(1, $token);
    	if($stmt->execute()){
    		echo true;
    	}else{
    		echo false;
    	}
    }

    public function registrarDiapo($datos){
    	$sql = " insert into usuarios_diapo (token, id_diapo, tiempo, fecha, hora, ip, id_usuario) values (?, ?, ?, now(), now(), ?, ?); ";
    	$stmt = $this->conexion->prepare($sql);
    	$stmt->bindParam(1, $datos["token_i"]);
    	$stmt->bindParam(2, $datos["id_diapo"]);
    	$stmt->bindParam(3, $datos["tiempo"]);
    	$stmt->bindParam(4, $datos["ip"]);
        $stmt->bindParam(5, $datos["id_usuario"]);
    	if($stmt->execute()){
    		return true;
    	}else{
    		return false;
    	}

    }

    public function reistrarDatos($datos){
        /*
        *VALIDAMOS QUE EL EMAIL Y NOMBRE NO LLEGUEN VACIOS
        */
        //print_r($datos);echo "model";return;
        //echo $datos["nombre"];
        //echo $datos["email"];return;
        if(!empty($datos["nombre"]) && !empty($datos["email"]) ){
            /*
             *VALIDAMOS QUE EL EMAIL SEA CORRECTO
             */
            if (filter_var($datos["email"], FILTER_VALIDATE_EMAIL)) {
                /*
                 * BUSCAMOS CORREO
                 */
                $sql_email = " select * from usuarios where email = ? ";
                $stmt = $this->conexion->prepare($sql_email);
                $stmt->bindParam(1, $datos["email"]);
                $stmt->execute();
                $num = $stmt->rowCount();
                if($num == 0){
                    /*
                     *REGISTRAR EN LA TABLA USUARIOS
                     */
                    $insert = " insert into usuarios(nombre, email, ip) values(?, ?, ?); ";
                    $stmt = $this->conexion->prepare($insert);
                    $stmt->bindParam(1, $datos["nombre"]);
                    $stmt->bindParam(2, $datos["email"]);
                    $stmt->bindParam(3, $datos["ip"]);
                    if($stmt->execute()){
                        $id_usuario = $this->conexion->lastInsertId();
                        /*
                         *ACTUALIZAR TABLA SESIONES
                         */
                        $update = " update sesiones set id_usuario = ? where token = ?; ";
                        $stmt = $this->conexion->prepare($update);
                        $stmt->bindParam(1, $id_usuario);
                        $stmt->bindParam(2, $datos["token_r"]);
                        if($stmt->execute()){
                            /*
                             *ACTUALIZAR TABLA USUARIOS DIAPO
                             */
                            $updateUsuariosDiapo = " update usuarios_diapo set id_usuario = ? where token = ?; ";
                            $stmt = $this->conexion->prepare($updateUsuariosDiapo);
                            $stmt->bindParam(1, $id_usuario);
                            $stmt->bindParam(2, $datos["token_r"]);
                            if($stmt->execute()){
                                return $id_usuario;
                            }else{
                                return false;// no se pudo actualiza tabla usuarios_diapo
                            }

                        }else{
                            return false;// no se pudo actualizar tabla sesiones
                        }
                    }else{
                        return false;// no se pudo registrar  en la tabla usuario
                    }
                }else{
                    /*
                     *ACTUALIZAR TABLA SESIONES
                     */

                    /*
                     *ACTUALIZAR TABLA USUARIOS DIAPO
                     */

                    /*
                     *ACTUALIZAR ID USUARIO EN EL LOCAL STORAGE
                     */
                }                
            }else{
                return 'error_email';
            }
        }else{
            return "error_nombre_email";
        }
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