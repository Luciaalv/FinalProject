<?php
session_start();

/////////FORMULARIO DE CREACIÓN / EDICIÓN DE PROYECTOS
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Formulario proyectos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include "cabecera.php";?>

<!-------Función para mostrar un calendario al elegir la fecha de entrega------>
<script>
    $(function() {
    $("#datepicker").datepicker();
  });
</script>
  </head>

    <body>
    <?php 
    
    include "conexión.php";
    if(!isset($_SESSION['manager'])){
    header('location:index.php');}


    ?> 
  <div class="d-flex h-100">
    <div class="m-auto p-4">
      <form action="form_projects2.php" method="POST" enctype="multipart/form-data" onsubmit="return required()">
        <div class ="form-group row p-2 bg-dark text-white justify-content-center">
        <h4>Introduce los datos del proyecto:</h4>
        </div>
        <?php if(!isset($_POST['idp'])):?>
        <div class="md-form">
        <label for ="idp" class="col-sm-6 col-form-label">Identificador</label>
          <div class="col-xs-4">
            <input type="text" class="form-control" name="idp" id="idp" value="" required>
          </div>
        </div>
        <?php else: ?>
        <input type="hidden" name="idp" id="idp" value="<?php echo $_POST['idp'];?>">
        <?php endif; ?>
       
        <div class="md-form">
        <label for ="name" class="col-sm-6 col-form-label">Nombre</label>
          <div class="col-xs-4">
            <input type="text" class="form-control" name="name" id="name" maxlenght="50" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo "";?>" required>
          </div>
        </div>

        <div class="md-form">
        <label for ="client" class="col-sm-6 col-form-label">Cliente</label>
          <div class="col-xs-4">
            <input type="text" class="form-control" name="client" id="client" maxlenght="50" value="<?php if(isset($_POST['client'])) echo $_POST['client']; else echo "";?>" required>
          </div>
        </div>

        <div class="md-form row pt-4 pl-3 pb-3">
        <label for ="length" class="col-sm-6 col-form-label">Nº de palabras</label>
          <div class="col-sm-6 pl-0">
            <input type="number" class="form-control" name="length" id="length" placeholder="0" value="<?php if(isset($_POST['length'])) echo $_POST['length']; else echo "";?>" required>
          </div>
        </div>

        <div class="md-form row pt-2 pl-3 pb-3" id="datepicker">
        <label for ="deadline" class="col-sm-6 col-form-label">Fecha de entrega</label>
          <div class="col-sm-6 pl-0">
            <input type="date" class="form-control" name="deadline" id="deadline" required>
          </div>
        </div>

        <div class="md-form row p-3">
        <label for="file" class="col-sm-6 col-form-label pl-0">Sube los archivos del proyecto:</label>
          <div class="col-sm-6 pl-2">
            <input type="file" name="originalFiles[]" id="file" multiple>
          </div>
        </div>
        <div class="md-form row p-4">
          <div class="col-sm-6 text-center">
        <a href='index.php' class="btn btn-dark">Volver</a>
          </div>
          <div class="col-sm-6 text-center">
        <?php if(!isset($_POST['idp'])):?>
          <input type="submit" name="submit" value="Siguiente" class="btn btn-light">
        <?php else: ?>
          <input type="submit" name="update" value="Modificar" formaction="var_proyectos.php" class="btn btn-light">
        <?php endif; ?>
          </div>
        </div>
      </form>
    </div>
  </div>
     


   
    </body>



</html>