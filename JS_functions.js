  /////FUNCIÓN PARA EVITAR QUE EL FORMULARIO SE ENVÍE SIN CUMPLIR CON LOS REQUISITOS DE SUBIDA DE ARCHIVOS
function required(){
    var file = document.getElementById("file");
    var extensions= ["txt","pdf","docx", "doc", "jpeg", "jpg", "png", "tmx", "xliff", "mqxliff", "sdlxliff"];
    if (file.files.length == 0){
      alert("Debes seleccionar un archivo.");
      return false;
    }
    else if (file.files.length > 5){
      alert("Solo puedes subir un máximo de 5 archivos por proyecto.");
      return false;
    }
    else{
    for (var i = 0; i < file.files.length; i++) {
        var split_ext = file.files[i].name.split('.').pop();
        var file_ext = split_ext.toLowerCase();
        if(file.files[i].size > 52428800){
          alert("El archivo "+file.files[i].name+" supera el tamaño permitido (5 MB).");
          return false;
        }
        if(extensions.includes(file_ext)=== false){
          alert("El archivo "+file.files[i].name+" tiene un formato no permitido. Elige un archivo con formato txt, pdf, doc, docx, jpeg, jpg, png, tmx, xliff, mqxliff o sdlxliff.");
          return false;
        }  
    }
    return true;
  }
}

  ///FUNCIÓN PARA CONFIRMAR QUE SE QUIERE ELIMINAR UN REGISTRO DE LA BASE DE DATOS

  function confirmDelete(){
    if (confirm("¿De verdad quieres eliminar este registro? Esta acción no se podrá deshacer.")){
      return true;
    }else{
      return false;
    }
  }

  ///FUNCIÓN PARA GENERAR UNA CONTRASEÑA ALEATORIA

  function randomPassword() {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < 8; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

  /////CÓDIGO JQUERY PARA RECORDAR MARCAR AL MENOS UNA CASILLA DE VERIFCACIÓN AL CREAR UN USUARIO

$(document).ready(function(){

  var taskGroup = $("input:checkbox[name='task[]']");
  taskGroup.prop('required', true);

  taskGroup.change(function(){
    var oneChecked = $("input:checkbox[name='task[]']:checked").length; 
    if(oneChecked == 0){
      taskGroup.prop('required', true);
    }
    if(oneChecked > 0){
      taskGroup.prop('required', false);
    }
});

});

