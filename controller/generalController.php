<?php
header('Access-Control-Allow-Origin: *'); 
require_once $_SERVER['DOCUMENT_ROOT'].'/addinnovations-landingpage/model/general.php';
$general = new General();

if(isset($_POST["token"]) && $_POST["token"]="generar"){
	$token = $general->generarToken();
	$r = $general->registrarToken($token);
	echo json_encode($token);
	return;
}

if(isset($_POST["trasa"]) && $_POST["trasa"]=="registrar"){
	$dato = array(
		"token_i" => $_POST["token_i"],
		"id_diapo" => $_POST["id_diapo"],
		"tiempo" => $_POST["tiempo"],
		"ip" => $_POST["ip"],
		"id_usuario" => $_POST["id_usuario"],
	);
	$trasa = $general->registrarDiapo($dato);
	echo json_encode($trasa);
	return;
}

if(isset($_POST["Usuario"]) && $_POST["Usuario"]=="registrarUser"){
	$datos = array(
		"nombre" => $_POST["nombre"],
		"email" => $_POST["email"],
		"token_r" => $_POST["token_r"],
		"ip" => $_POST["ip"],
	);
	$registrarUsuario = $general->reistrarDatos($datos);
	echo json_encode($registrarUsuario);return;
}

if(isset($_GET["id"]) && $_GET["id"]!=null){
	//echo "ok";return;
	$r = $general->actualizarSesiones($_GET["id"], $_GET["token"]);
	echo $r;
}
?>