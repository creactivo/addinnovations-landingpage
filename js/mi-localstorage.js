
//guardar_localstorage();
obtener_localstorage();


function obtener_localstorage () {
	if( localStorage.getItem("nombre")){

	let nombre = localStorage.getItem("nombre");
	let persona = JSON.parse(localStorage.getItem("persona"));



console.log( nombre );
console.log( persona );

}

}else{
	console.log("te jodiste");
}

function guardar_localstorage(){
	let persona = {
		nombre:"Fernando",
		edad: 31,
		correo:"xy@yyz.com",
		coords:{
			lat:10,
			lng: -10
		}
	};

	let nombre = "pedro";

	localStorage.setItem("nombre", nombre );
	localStorage.setItem("persona", JSON.stringify(persona));
}



//https://platzi.com/blog/local-storage-html5/ tuto