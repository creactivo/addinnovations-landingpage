
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
	let horaInicio = inicio.split(":")
	let horaFin = fin.split(":")

	let t1 = new Date();
	let t2 = new Date();

	t1.setHours(horaInicio[0], horaInicio[1], horaInicio[2]);
	t2.setHours(horaFin[0], horaFin[1], horaFin[2]);

	t1.setHours(t1.getHours() - t2.getHours(), t1.getMinutes() - t2.getMinutes(), t1.getSeconds() - t2.getSeconds());

	return t1.getHours() + ":"+ t1.getMinutes() + ":" + t1.getSeconds();
}


