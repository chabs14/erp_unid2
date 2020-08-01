$(document).ready(function(){
    $('#btncatalogo').click(function(){
        let obj = {};
        obj.id = $('#id').val();
        obj.nombre = $('#nombre').val();
        obj.precio =$('#precio').val();
        obj.descripcion =$('#des').val();
        obj.fechaP=$('#fechaP').val();
        obj.telefono= $('#telefono').val();
        obj.id_categoria = $('#cat').val();
        obj.id_provedor = $('#id_pro').val();

        console.log(obj);
        let formData = new FormData();
        if(obj.img1 != ''){
            let imagen = $('#img1').prop("files")[0];
            
            formData.append("file", imagen);
            obj.img1 = $('#img1').val().replace(/C:\\fakepath\\/i, '');
        }
        if(obj.img2 != ''){
            let imagen2 = $('#img2').prop("files")[0];
            
            formData.append("file2", imagen2);
            obj.img2 = $('#img2').val().replace(/C:\\fakepath\\/i, '');
        }
        if(obj.img3 != ''){
            let imagen3 = $('#img3').prop("files")[0];
            
            formData.append("file3", imagen3);
            obj.img3 = $('#img3').val().replace(/C:\\fakepath\\/i, '');
        }
        $.ajax({
            url: './imagenes_cat.php',
            contentType: false,
            processData: false,
            data: formData,
            type: 'POST',
            success: (r) => {
                console.log('Subida de archivo exitosa');
            }
        });
        console.log(obj);
        $.post('funciones/editar_pro.php', obj, function(e){
            console.log(e);
        });
    });
});