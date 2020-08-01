function validarCat(){
    var nombre ;
    nombre = document.getElementById("cat").value;


    if(nombre === ""){
    alert("Es requerida una Categoria");
    return false;
    }

}
