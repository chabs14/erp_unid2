function confirmar(e){
    if(confirm("Está seguro de eliminar este registro")){
        return true;
    }else{
        e.preventDefault();
    }
}

let linkDelete = document.querySelectorAll(".btn-shadow btn btn-danger");

for (var i = 0; i < linkDelete.length; i++) {
    linkDelete[i].addEventListener('click', confirmar);
}