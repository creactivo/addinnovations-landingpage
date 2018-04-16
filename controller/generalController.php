<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/addinnovations-landingpage/model/general.php';
/*if(isset($_POST['cerrarSesion']) && $_POST["cerrarSesion"]=="si"){
	$general = new General();
	$general->cerrarSesion();
    return true;
}*/

$general = new General();
$r = $general->prueba();
var_dump($r);

?>