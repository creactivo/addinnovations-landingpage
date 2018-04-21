<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/addinnovations-landingpage/conexion/conexion.php';

class General extends Conexion{

	public function __construct()
    {
        $this->conexion = new Conexion();
        $this->data = array();
    }
    public function generarToken(){
		list($usec, $sec) = explode(' ', microtime());
        return (int) $sec + ((int) $usec * 100000);
    }

    public function registrarToken($token){
    	$sql = " insert into sesiones (tiempo_i, tiempo_f, token) values (now(), now(), ?); ";
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
                    $stmt->execute();
                    //if($stmt->execute()){
                    $id_usuario = $this->conexion->lastInsertId();
                        /*
                         *ACTUALIZAR TABLA SESIONES
                         */
                            if(self::actualizarDiapo($id_usuario, $datos["token_r"])){
                                if(self::actualizarSesiones($id_usuario, $datos["token_r"])){
                                    return $id_usuario;
                                }
                            }else{
                                return false;
                            }
                        /*
                         *ACTUALIZAR TABLA USUARIOS DIAPO
                         */
                            //self::actualizarDiapo($id_usuario, $datos["token_r"]);
                            //return $id_usuario;
                    /*}else{
                        return false;// no se pudo registrar  en la tabla usuario
                    }*/
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

    public function actualizarSesiones($id_usuario, $token){
        $updateSesiones = " update sesiones set id_usuario = ? where token = ?; ";
        //echo $id_usuario." - ".$token;return;
        $dbh = $this->conexion->prepare($updateSesiones);
        $dbh->bindParam(1, $id_usuario);
        $dbh->bindParam(2, $token);
        if($dbh->execute()){
            return true;
        }else{
            return false;// no se pudo actualiza tabla sesiones
        }
    }
    
    public function actualizarDiapo($id_usuario, $token){
        $updateUsuariosDiapo = " update usuarios_diapo set id_usuario = ? where token = ?; ";
        $stmt = $this->conexion->prepare($updateUsuariosDiapo);
        $stmt->bindParam(1, $id_usuario);
        $stmt->bindParam(2, $token);
        if($stmt->execute()){
            return true;
        }else{
            return false;// no se pudo actualiza tabla usuarios_diapo
        }
    }

    public function actualizarUsuario($datos){
        if(!empty($datos["telefono"])){
            $sql = " update usuarios set empresa = ?, cargo = ?, telefono = ?, direccion = ? WHERE id = ?; ";
            $dbh = $this->conexion->prepare($sql);
            $dbh->bindParam(1, $datos["empresa"]);
            $dbh->bindParam(2, $datos["cargo"]);
            $dbh->bindParam(3, $datos["telefono"]);
            $dbh->bindParam(4, $datos["direccion"]);
            $dbh->bindParam(5, $datos["id"]);
            if($dbh->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return "tel_req";
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

    public function emailExiste($email){
        $sql = " select email from usuarios where email = ? ";
        $dbh = $this->conexion->prepare($sql);
        $dbh->bindParam(1, $email);
        $dbh->execute();
        $num = $dbh->rowCount();
        if($num==0){
            return true;
        }else{
            return false;
        }
    }
    public function usuarioIntoCompl($datos){
        //campos vacios
        if(!empty($datos["nombre"]) && !empty($datos["email"]) && !empty($datos["telefono"]) ){
            //validamos email
            if(filter_var($datos["email"], FILTER_VALIDATE_EMAIL)){
                if(self::emailExiste($datos["email"])){
                    //insertamos usuarios
                    $sql = " insert into usuarios (nombre, email, ip, empresa, cargo, telefono, direccion) values(?, ?, ?, ?, ?, ?, ?);  ";
                    $stmt = $this->conexion->prepare($sql);
                    $stmt->bindParam(1, $datos["nombre"]);
                    $stmt->bindParam(2, $datos["email"]);
                    $stmt->bindParam(3, $datos["ip"]);
                    $stmt->bindParam(4, $datos["empresa"]);
                    $stmt->bindParam(5, $datos["cargo"]);
                    $stmt->bindParam(6, $datos["telefono"]);
                    $stmt->bindParam(7, $datos["direccion"]);
                    if($stmt->execute()){
                        $id = $this->conexion->lastInsertId();
                        //actualizar sesiones
                        self::actualizarSesiones($id, $datos["token_re"]);
                        //actualizar diapos
                        self::actualizarDiapo($id, $datos["token_re"]);
                        //retornar id para localstorage
                        return $id;

                    }else{
                        return false;
                    }
                }else{
                    return 'email_regis';
                }
            }else{
                return 'error_mail';
            }
        }else{
            return 'nom_email_tel_req';
        }

    }

   
}



?>