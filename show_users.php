<?php 
session_start();
if(!isset($_SESSION['manager'])){
    header('location:index.php');
}
include "conexión.php";
include "cabecera.php";

    $query="SELECT e.id, e.name, e.email, a.language FROM employees e LEFT JOIN
    (select *from translators union select * from proofreaders union select * from testers) a ON e.id=a.id ORDER BY e.id";
    $result=mysqli_query($conexion, $query);
    if($result){
        if($result->num_rows==0){
            echo "No hay usuarios registrados.";
        }
    }else echo "Se ha producido un error.";

?>
<!--------------Listado de todos los traductores de la base de datos---------------->
<!DOCTYPE html>
<html>
    <head>
        <script src="JS_functions.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
    <?php if($result->num_rows > 0){
        $assoc = mysqli_fetch_all($result, MYSQLI_ASSOC);?>
        <table class="table">
        <thead class="thead-dark">
        <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>E-mail</th>
        <th>Idioma</th>
        <th>Editar</th>
        <th>Eliminar</th>
        </tr>
        </thead>
        <?php foreach ($assoc as $key=>$value):?>
            <form action='form_users.php' method='POST'>
            <tr><td><?php echo $value['id'];?></td>
            <td><?php echo $value['name'];?></td>
            <td><?php echo $value['email'];?></td>
            <td><?php echo $value['language'];?></td>
            <td><button class='btn btn-light' type ='submit' name='actualizar' value='Modificar'>
                <i class='fas fa-user-edit'></i>
            </button></td>
            <td><button class='btn btn-dark' type ='submit' value='Eliminar' name='eliminar' formaction='functions_user.php' onclick='return confirmDelete()'>
                <i class='fas fa-trash-alt'></i>
            </button></td></tr>
            <input type='hidden' name='id' value='<?php echo $value['id'];?>'>
            <input type='hidden' name='nombre' value='<?php echo $value['name'];?>'>
            <input type='hidden' name='email' value='<?php echo $value['email'];?>'>
            <input type='hidden' name='language' value='<?php echo $value['language'];?>'>
            </form>
        <?php endforeach; }?>
        </table>

</body>
</html>

<?php mysqli_close($conexion);?>