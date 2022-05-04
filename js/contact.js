function sendEmail(name, subject, email, phone, message) {
    yourMessage = "Hola! El usuario con nombre "+name+", email "+email+" y numero telfonico de contacto "+phone+", ha enviado el siguiente mensaje: " + message;
	Email.send({
	    SecureToken: '29c7e436-2522-4305-9c44-bea9dd2032f5',
	    To: 'promoliderp@gmail.com',
	    From: 'silvi14499@gmail.com',
	    Subject: subject,
	    Body: yourMessage
	});
	Email.send({
	    SecureToken: '29c7e436-2522-4305-9c44-bea9dd2032f5',
	    To: email,
	    From: 'silvi14499@gmail.com',
	    Subject: "Sus datos han sido procesados.",
	    Body: "Bienvenido. Gracias por contactar a Promolider."
	});
	alert("Sus datos han sido procesados correctamente.");
}