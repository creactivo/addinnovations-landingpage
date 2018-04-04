
var camposList = [];

function addCamposSistem(aip,anombre,aapellido,adireccion,aemail) {

	var newCampos = {
		ip: aip,
		nombre: anombre,
		apellido: aapellido,
		direccion: adireccion,
		email:aemail
	};

camposList.push(newCampos);

localStorage.setItem("newCamposset", JSON.stringify(newCampos));


}

// var aEmail =[],
// 	aPassword =[],
// 	aAddress =[];



// 	if(localStorage.getItem('lemail')!= null){
// 		aEmail = JSON.parse(localStorage.getItem('lemail'));
// 		aPassword = JSON.parse(localStorage.getItem('lpassword'));
// 		aAddress = JSON.parse(localStorage.getItem('laddress'));
// 	}






// var elementoBotonRegistrar = document.querySelector('#btn-enviar');

// 	elementoBotonRegistrar.addEventListener('click', registrarLibro);


// function registrarLibro() {
// 	var bEmail = document.querySelector('#inputEmail4').value,
// 		bPassword = document.querySelector('#inputPassword4').value,
// 		bAddress = document.querySelector('#inputAddress').value;

// 	aEmail.push(bEmail);
// 	aPassword.push(bPassword);
// 	aAddress.push(bAddress);


// 	localStorage.setItem('lemail', JSON.stringify(aEmail));
// 	localStorage.setItem('lpassword', JSON.stringify(aPassword));
// 	localStorage.setItem('laddress', JSON.stringify(aAddress));



// };

