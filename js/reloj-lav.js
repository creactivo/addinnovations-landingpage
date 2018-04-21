
$(function(){
	contenedor ()
})

var centesimas = 0;
var segundos = 0;
var minutos = 0;
var horas = 0;

function contenedor () {
	control = setInterval(cronometro,10);
	//document.getElementById("contenedor").disabled= false;
}

function cronometro () {
	if (centesimas < 99) {
		centesimas++;
		if (centesimas < 10) { centesimas = "0"+centesimas }
		//Centesimas.innerHTML = ":"+centesimas;
	}
	if (centesimas == 99) {
		centesimas = -1;
	}
	if (centesimas == 0) {
		segundos ++;
		if (segundos < 10) { segundos = "0"+segundos }
		//Segundos.innerHTML = ":"+segundos;
	}
	if (segundos == 59) {
		segundos = -1;
	}
	if ( (centesimas == 0)&&(segundos == 0) ) {
		minutos++;
		if (minutos < 10) { minutos = "0"+minutos }
		//Minutos.innerHTML = ":"+minutos;
	}
	if (minutos == 59) {
		minutos = -1;
	}
	if ( (centesimas == 0)&&(segundos == 0)&&(minutos == 0) ) {
		horas ++;
		if (horas < 10) { horas = "0"+horas }
		//Horas.innerHTML = horas;

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

var registrarDiapo = function(diapo, tiempo){
	var datos = new FormData();
		datos.append("token_i", localStorage.getItem("Token"));
		datos.append("id_diapo", diapo);
		datos.append("tiempo", tiempo);
		datos.append("ip", localStorage.getItem("textIp"));
		datos.append("id_usuario", localStorage.getItem("Usuario"));
        datos.append("trasa", "registrar");
        $.ajax({
          url: 'http://localhost/addinnovations-landingpage/controller/generalController.php', 
          type: 'POST',
          data: datos,
          cache: false,
          processData: false,
          contentType: false,
          success: function(respuesta){
            //console.log(respuesta)
          }
      });

}

var FormNormal = function(empresa, cargo, telefono, direccion){
	var datos = new FormData();
		datos.append("id", localStorage.getItem("Usuario"));
		datos.append("empresa", empresa);
		datos.append("cargo", cargo);
		datos.append("telefono", telefono);
		datos.append("direccion", direccion);
        datos.append("actualizarUsuario", "actualizarCom");
        $.ajax({
          url: 'http://localhost/addinnovations-landingpage/controller/generalController.php', 
          type: 'POST',
          data: datos,
          cache: false,
          processData: false,
          contentType: false,
          success: function(respuesta){
            //console.log(respuesta)
            var rpt = eval(respuesta)
            if(rpt=='tel_req'){
            	alert("al menos danos tu telefono")
            	return
            }
            if(rpt){
            	window.location=""//diapositiva a ubicar
            	return
            }
            if(!rpt){
            	alert("ocurrio un error al guardar tus datos")
            	return
            }
          }
      });
}

var FormCompl = function(nombre, email, empresa, cargo, telefono, direccion){
	//*alert("complemento")
	var datos = new FormData();
		datos.append("nombre", nombre);
		datos.append("email", email);
		datos.append("empresa", empresa);
		datos.append("cargo", cargo);
		datos.append("telefono", telefono);
		datos.append("direccion", direccion);
		datos.append("token_re", localStorage.getItem("Token"));
		datos.append("ip", localStorage.getItem("textIp"));
        datos.append("usuarioCompleto", "userCompleto");
        $.ajax({
          url: 'http://localhost/addinnovations-landingpage/controller/generalController.php', 
          type: 'POST',
          data: datos,
          cache: false,
          processData: false,
          contentType: false,
          success: function(respuesta){
            //onsole.log(respuesta);return;
            var rpt = eval(respuesta)
            if($.isNumeric(rpt)){
                localStorage.setItem("Usuario", rpt)
                localStorage.setItem('Nombre', JSON.stringify(nombre))
                //window.location = '#add-5'
                return;
            }
            if(rpt=='email_regis'){
            	alert('gracias ya tenemos guardado tus datos');
            	return;
            }
            if(rpt=='error_mail'){
            	alert("Correo electronico tiene formato no valido")
            	return
            }
            if(rpt=='nom_email_tel_req'){
            	alert("es necesario nombre, email y telefono para poder contactarte")
            	return
            }
            if(!rpt){
            	alert("ocurrio un error al guardar tus datos")
            	return
            }
          }
      });

}


