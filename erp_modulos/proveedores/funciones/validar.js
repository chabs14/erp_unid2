function validar(){
    var nombre, domicilio, cp, localidad, estado, pais, telefono, 
    email ;
    nombre = document.getElementById("nombre").value;
    domicilio = document.getElementById("domicilio").value;
    cp = document.getElementById("cp").value;
    localidad = document.getElementById("localidad").value;
    estado = document.getElementById("estado").value;
    pais = document.getElementById("pais").value;
    telefono = document.getElementById("telefono").value;
    email = document.getElementById("email").value;

    expresion = /\w+@\w+\.+[a-z]/;

    if(nombre === ""){
    alert("El nombre es requerido");
    return false;
    }
    else if(domicilio === ""){
        alert("El domicilio es requerido");
        return false;
    }
    else if(isNaN(cp) || cp === "" || cp.length <5 || cp.length >5){
        alert("El Codigo postal es requerido o es incorrecto");
        return false;
    }
    else if(localidad === ""){
        alert("La localidad o ciudad es requerida");
        return false;
    }
    else if(estado === ""){
        alert("El estado es requerido");
        return false;
    }
    else if(pais === ""){
        alert("El pais es requerido");
        return false;
    }
    else if(isNaN(telefono) || (telefono === "" || telefono.length <10 || telefono.length >10)){
        alert("El telefono no cumple con los campos requeridos");
        return false;
    }     
    else if(email === ""){
        alert("El email es requerido");
        return false;
    }
    else if(!expresion.test(email)){
        alert("El correo no es válido");
        return false;
    }          
}
