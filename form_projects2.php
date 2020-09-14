<?php
session_start();
?>

<!----------Segunda parte del formulario de creación de proyectos en la que se buscarán traductores para asignar------------>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Formulario proyectos</title>
    <?php 
    include "cabecera.php";
    if(!isset($_SESSION['manager'])){
      header('location:index.php');
    }
    include "var_proyectos.php";

    foreach ($_POST as $clave => $valor) {
      $_SESSION['form1'][$clave] = $valor;
    }
    ?> 
  </head>

<body>
  <div class="d-flex h-100">
    <div class="m-auto p-4">
      <form action="ajax_search.php" method="POST">
        <div class ="form-group row p-2 bg-dark text-white justify-content-center">
          <h4>Datos del proyecto</h4>
        </div>
        <div class="form-group row">
        <label for ="idp" class="col-sm-6 col-form-label">Identificador</label>
          <div class="col-sm-6">
           <input type="text" readonly class="form-control-plaintext" name="idp" id="idp" value="<?php echo $_POST['idp'];?>">
          </div>
        </div>

        <div class="form-group row">
        <label for ="name" class="col-sm-6 col-form-label">Nombre</label>
          <div class="col-sm-6">
           <input type="text" readonly class="form-control-plaintext" name="name" id="name" maxlenght="50" value="<?php echo $_POST['name'];?>">
          </div>
        </div>

        
        <div class="form-check p-1">
        <p>Elige los idiomas que se utilizarán en el proyecto:</p>
        <div class="row">
          <div class="col-sm text-center">
            <input type="checkbox" name="lang[]" id="spanish" value="spanish">
            <label class="checkbox" for="spanish">Español</label>
          </div>
          <div class="col-sm text-center">
            <input type="checkbox" name="lang[]" id="french" value="french">
            <label class="checkbox" for="french">Francés</label>
          </div>
        </div>
        <div class="row">
          <div class="col-sm text-center">
            <input type="checkbox" name="lang[]" id="german" value="german">
            <label for="german">Alemán</label>
          </div>
          <div class="col-sm text-center">
            <input type="checkbox" name="lang[]" id="italian" value="italian">
            <label for="italian">Italiano</label>
          </div>
        </div>
        </div>

        <div class="form-check p-1">
        <p>¿Qué necesitas?</p>
        <div class="row">
          <div class="col-sm text-center">
            <input type="checkbox" name="task[]" id="translators" value="Traductor">
            <label for="translator">Traductor</label>
          </div>
          <div class="col-sm text-center">
            <input type="checkbox" name="task[]" id="proofreaders" value="Revisor">
            <label for="proofreader">Revisor</label>
          </div>
          <div class="col-sm text-center">
            <input type="checkbox" name="task[]" id="testers" value="Tester">
            <label for="tester">Tester</label>
          </div>
        </div>
        </div>
        <div class="p-3 text-center">
          <p><input type="button" class="btn btn-dark" name="search" value="Buscar" onclick=searchLang();></p>
        </div>
      </form>
    </div>
  </div>
      <p id="answer"></p>
        
<!-----------Llamada al servidor para mostrar los datos especificados en el formulario anterior. Estos datos se envían a ajax_search.php------------>
  <script> 
    function searchLang(){
        var arr = new Array();
          $(':checkbox').each(function(){
              if($(this).is(':checked')){
                arr.push($(this).attr('id'));
              }
          });
        var jsonString = JSON.stringify(arr);
        $.ajax({
        type: "POST",
        data: {arr : jsonString},
        url: "ajax_search.php",
        cache: false,
        success: function(msg){
          $('#answer').html(msg);
        }
        });
        }
  </script>
</body>

</html>