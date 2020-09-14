<?php 
    session_start();
    if(!isset($_SESSION['manager'])){
    header('location:index.php');}
?> 
<!--------------//FORMULARIO DE CREACIÓN / ACTUALIZACIÓN DE USUARIOS--->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Formulario de usuarios</title>
    <?php include "cabecera.php";?>
    <script>
      $(document).ready(function(){
        $('#generate').click(function(e){
            password = randomPassword();
            $('#password').val(password);
          e.preventDefault();
        });
      });
    </script>
  </head>

<body>
  <div class="d-flex h-75">
  <div class="container my-4">
    <div class="m-auto col-sm-6">
    
    <form action="functions_user.php" method="POST">
        <div class ="form-group row pt-2 pb-2 pl-4 pr-4 bg-dark text-white justify-content-center">
        <h4>Introduce los datos del usuario:</h4>
        </div>
        <div class="md-form pb-2">
        <label for ="name" class="col-sm-6 col-form-label">Nombre</label>
          <div class="col-xs-4">
            <input type="text" class="form-control" name="nombre" id="name" maxlenght="50"  
            value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre']; else echo "";?>" required>
          </div>
        </div>
        <?php if(!isset($_POST['id'])):?>
        <div class="md-form pb-2">
          <div class="d-flex row-md-2">
            <label for ="password" class="col-sm-6 col-form-label flex-fill">Contraseña</label>
            <a href="#" class="col-sm-6 col-form-label d-flex justify-content-end" id="generate">Generar contraseña</a>
          </div>
          <div class="col-xs-4"> 
            <input type="password" class="form-control" name="password" id="password"  
            value="" required>
          </div>
        </div>
        <?php endif;?>
    
        <div class="md-form pb-2">
        <label for ="email" class="col-sm-6 col-form-label">E-mail</label>
          <div class="col-xs-4">
            <input type="text" class="form-control" name="email" id="email"  
            value="<?php if(isset($_POST['email'])) echo $_POST['email']; else echo "";?>" required>
          </div>
        </div>

        
        <div class="form-check p-4">
          <div class="row">
            <div class="col-sm text-center">
              <input type="checkbox" name="task[]" id="translator" value="translators">
              <label for="translator">Traductor</label>
            </div>
            <div class="col-sm text-center">
              <input type="checkbox" name="task[]" id="proofreader" value="proofreaders">
              <label for="proofreader">Revisor</label>
            </div>
            <div class="col-sm text-center">
              <input type="checkbox" name="task[]" id="tester" value="testers">
              <label for="tester">Tester</label>
            </div>
          </div>
        </div>
        

        <?php if(!isset($_POST['language']) ||$_POST['language']==null):?>
        <div class="md-form row pl-3 pb-4">
        <label for="language" class="col-sm-6 col-form-label">Idioma de trabajo: </label>
          <div class="col-sm-6 pl-0">
            <select id="language" name="language" class="form-control">
              <option value="spanish">Español</option>
              <option value="french">Francés</option>
              <option value="italian">Italiano</option>
              <option value="german">Alemán</option>
            </select>
          </div>
        </div>
        <?php else: echo "<input type='hidden' name='language' value='".$_POST['language']."'>"; 
        endif;?>
        <?php if(!isset($_POST['nombre'])):?>
          <div class="text-center p-3">
            <input type ="submit" value="Aceptar" id="insertar" name="insertar" class="btn btn-dark">
          </div>
        <?php ;else: ?>
          <div class="text-center p-3">
            <input type ="submit" value="Actualizar" id="actualizar" name="actualizar" class="btn btn-dark">
          </div>
        <?php ;endif;?>
     </form>
     </div>
  </div>
</div>

</body>

</html>