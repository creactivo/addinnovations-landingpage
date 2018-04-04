
llenarTabla();


function llenarTabla() {
	var tbody = document.querySelector('#tblLibros tbody');
	tbody.innerHTML='';


	var aEmail = JSON.parse(localStorage.getItem('lemail')),
		aPassword = JSON.parse(localStorage.getItem('lpassword')),
		aAddress = JSON.parse(localStorage.getItem('laddress'));




		var nCanDatos = aEmail.length;

		for (var i = 0; i < nCanDatos; i++) {
			
			var fila = document.createElement('tr');


			var celdaemail = document.createElement('td'),
			 	celdapassword = document.createElement('td'),
			 	celdaaddress = document.createElement('td');

			 var nodetextemail=document.createTextNode(aEmail[i]);
			 	 nodetextpassword=document.createTextNode(aPassword[i]);
			 	 nodetextaddress=document.createTextNode(aAddress[i]);


			 	 celdaemail.appendChild(nodetextemail);
			 	 celdapassword.appendChild(nodetextpassword);
			 	 celdaaddress.appendChild(nodetextaddress);

			 	 fila.appendChild(celdaemail);
			 	 fila.appendChild(celdapassword);
			 	 fila.appendChild(celdaaddress);

			 	 tbody.appendChild(fila);


		}

};

