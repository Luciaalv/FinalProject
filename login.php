<?php
session_start();
?>
<!----Formulario de acceso al sistema----->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inicio de sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  </head>

<body>
<form class="text-center border border-light p-5" action="" method="POST">
  <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
  <p class="h4 mb-5">Iniciar sesión</p>
    <div class="input-group mb-5">
      <div class="input-group-prepend">
        <span class="input-group-text bg-transparent border-right-0 border"><i class="far fa-user"></i></span>
      </div>
        <input type="text" class="form-control border-left-0 border" name="email" id="user" placeholder ="Correo electrónico" required>
    </div>

    <div class="input-group mb-5">
      <div class="input-group-prepend">
        <span class="input-group-text bg-transparent border-right-0 border"><i class="fas fa-lock"></i></span>
      </div>
      <input type="password" class="form-control border-left-0 border" name="password" id="pass" placeholder ="Contraseña" required>
    </div>
      <input class="btn btn-dark" type="reset" value="Borrar todo">
      <input class="btn btn-light" type="submit" name="login" value="Iniciar sesión">
  </div>
</form>

<?php    
    if(isset($_POST['login'])){
      login();
    }

 /********Función de inicio de sesión ********/
 function login(){
  include "conexión.php";
     $email= mysqli_real_escape_string($conexion,$_POST['email']);
     $password=$_POST['password'];
     $query="SELECT * FROM managers WHERE email='$email'AND BINARY password='$password'";
     $resultado=mysqli_query($conexion, $query);
      if($email==null||$password==null){
        echo "<script type='text/javascript'>alert('Introduce tu nombre de usuario y tu contraseña.');
        window.location.href='login.php';
        </script>";
      }
      if (mysqli_num_rows($resultado)==0){
        $query ="SELECT * FROM employees WHERE email='$email' AND BINARY password='$password'";
        $resultado=mysqli_query($conexion, $query);
         if (mysqli_num_rows($resultado)==0){
         echo "<script type='text/javascript'>alert('El usuario no existe.');
         window.location.href='login.php';
         </script>";
        }
        else{
          $_SESSION['translator'] = $email;
          echo "<script type='text/javascript'>alert('Bienvenido/a a tu cuenta de traductor.');
          window.location.href='index.php';
           </script>";
        }  
      }
      else{
        if($email=='master@admin.com' && $password=='adminDAW'){
          $_SESSION['admin'] = $email;
          echo "<script type='text/javascript'>alert('Bienvenido/a a tu cuenta de adminstrador.');
          window.location.href='index.php';
          </script>";
        }else{
          $_SESSION['manager'] = $email;
          echo "<script type='text/javascript'>alert('Bienvenido/a a tu cuenta de PM.');
          window.location.href='index.php';
          </script>";
        }
      }
      
   mysqli_close($conexion);
 }
 if(isset($_POST['desconectar'])){
   session_destroy();
   header('location:login.php');
 }

?>

   </body>

</html>