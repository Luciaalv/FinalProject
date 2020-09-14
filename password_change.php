<?php 
session_start();
include "cabecera.php";
include "data_users.php";

if(!isset($_SESSION)){
    header('location:login.php');
}
if(isset($_POST['updatePass'])){
    $result= getUserData($rank, $user);
    $newPassword = $_POST['password'];
    $id = $result['id'];
    include "conexión.php";
    $query="UPDATE $rank SET password = '$newPassword' WHERE id = $id";
    if(mysqli_query($conexion, $query)):
        echo "<script type='text/javascript'>alert('Contraseña actualizada.');
        window.location.href='index.php';
        </script>";
        else: echo "<script type='text/javascript'>alert('No se ha podido actualizar la contraseña.');
        </script>";
    endif;
    mysqli_close($conexion);
}
?>
<!----------Formulario para cambiar de contraseña. Todos los usuarios pueden acceder a él------------>
<div class="d-flex h-75">
    <div class="mx-auto my-lg-5">
    <form action="" method="POST">
        <div class ="form-group p-4 border border-dark bg-light rounded justify-content-center">
            <div class="md-form">
            <h6><label for ="password" class="p-3 col-form-label">Introduce tu nueva contraseña:</label></h6>
                <div class="col-xs-4 p-3">
                    <input type="password" class="form-control" name="password" id="password" maxlenght="50" required>
                </div>
            </div>
        </div>

        <div class="p-3 text-center">
        <input type="submit" name="updatePass" value="Aceptar" class="btn btn-dark">
        </div>
    </form>
    </div>
</div>

