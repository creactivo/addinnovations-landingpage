
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




var centesimas = 0;
var segundos = 0;
var minutos = 0;
var horas = 0;

function contenedor () {
	control = setInterval(cronometro,10);
	document.getElementById("contenedor").disabled= false;

}
contenedor ()
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
}

// document.write(contenedor);
//function trazadorTemporal = 