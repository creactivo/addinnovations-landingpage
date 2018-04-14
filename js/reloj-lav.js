
// (function(){
// 	var contador = 0;
// 	var saludo = function(){
// 	contador++;
// 	console.log(contador);
	

// 	if (contador === 5){
// 		clearInterval(intervalo);
// 	}

// };

// var intervalo = setInterval(saludo, 1000);
// }())


$(function(){
	contenedor ()
})

var centesimas = 0;
var segundos = 0;
var minutos = 0;
var horas = 0;

function contenedor () {
	control = setInterval(cronometro,10);
	document.getElementById("contenedor").disabled= false;

}

function cronometro () {
	if (centesimas < 99) {
		centesimas++;
		if (centesimas < 10) { centesimas = "0"+centesimas }
		Centesimas.innerHTML = ":"+centesimas;
	}
	if (centesimas == 99) {
		centesimas = -1;
	}
	if (centesimas == 0) {
		segundos ++;
		if (segundos < 10) { segundos = "0"+segundos }
		Segundos.innerHTML = ":"+segundos;
	}
	if (segundos == 59) {
		segundos = -1;
	}
	if ( (centesimas == 0)&&(segundos == 0) ) {
		minutos++;
		if (minutos < 10) { minutos = "0"+minutos }
		Minutos.innerHTML = ":"+minutos;
	}
	if (minutos == 59) {
		minutos = -1;
	}
	if ( (centesimas == 0)&&(segundos == 0)&&(minutos == 0) ) {
		horas ++;
		if (horas < 10) { horas = "0"+horas }
		Horas.innerHTML = horas;
	}
	return getCrono(horas, minutos, segundos)
}

var getCrono = function(horas, minutos, segundos){
	return horas +":"+ minutos +":"+ segundos
}


var restarHoras = function (inicio,fin) {

var fechaInicio = new Date(inicio);

var fechaFin = new Date(fin);

var dif= fechaFin - fechaInicio; // diferencia en milisegundos

var difSeg = Math.floor(dif/1000); //diferencia en segundos

var segundos = difSeg % 60; //segundos

var difMin = Math.floor(difSeg/60); //diferencia en minutos

var minutos = difMin % 60; //minutos

var difHs = Math.floor(difMin/60); //diferencia en horas

var horas = difHs % 24; //horas

return horas+":"+minutos+":"+segundos; //armo el tiempo de diferencia

}

// document.write(contenedor);
//function trazadorTemporal = 