function validarPro(){
    var nombre, precio, descripcion, fechaP, telefono, id_cat, 
    id_pro, img1, img2, img3 ;
    nombre = document.getElementById("nombre").value;
    precio = document.getElementById("precio").value;
    descripcion = document.getElementById("descripcion").value;
    fechaP = document.getElementById("fechaP").value;
    telefono = document.getElementById("telefono").value;
    id_cat = document.getElementById("id_cat").value;
    id_pro = document.getElementById("id_pro").value;
    img1 = document.getElementById("img1").value;
    img2 = document.getElementById("img2").value;
    img3 = document.getElementById("img3").value;


    if(nombre === ""){
    alert("El nombre es requerido");
    return false;
    }
    else if(isNaN(precio) || precio === ""){
        alert("El precio es requerido o no cumple con lo requerido");
        return false;
    }
    else if( descripcion === "" ){
        alert("La descripción es necesaria");
        return false;
    }
    else if(fechaP === ""){
        alert("La fecha es requerida");
        return false;
    }
    else if(isNaN(telefono) || (telefono === "" || telefono.length <10 || telefono.length >10)){
        alert("El telefono no cumple con los campos requeridos");
        return false;
    }     
    else if(id_cat === ""){
        alert("La categoria es requerida");
        return false;
    }
    else if(id_pro === ""){
        alert("El proveedor es requerido");
        return false;
    }
    else if(img1 === ""){
        alert("La imagen es requerida");
        return false;
    }
    else if(img2 === ""){
        alert("La imagen es requerida");
        return false;
    } 
    else if(img3 === ""){
        alert("La imagen es requerida");
        return false;
    }           
}
