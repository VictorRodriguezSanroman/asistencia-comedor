function comienzo(){
   
    document.getElementById("alta").addEventListener("click",validarDNI);
    document.getElementById("alta").addEventListener("click",validaCC); 
    }

//Función para la validación del campo DNI
function validarDNI(){
    //Capturamos el valor del campo de id "ni" en la variable valor
    valor = document.getElementById("dni").value;
    //Si nop cumple los requisitos de que tenga 8 caractacteres, un guión y una letra mayúscula de la A a la Z:
    if(!(/^\d{8}[A-Z]$/.test(valor))){
        alert('Formato DNI inválido (Ejemplo: 12345678A).');
        return false;
    }
    //Si es correcto:
    return true;
}

function validaCC(){
    let cuenta = document.getElementById('cuenta').value;
    if(!(/^\d{4}-\d{4}-\d{2}-\d{10}/.test(cuenta))){
        alert( 'Número de cuenta no válido. Ej válido: 0098-5098-76-9876754668');
        return false;
    }
    return true;
}


window.addEventListener('load', comienzo,false);