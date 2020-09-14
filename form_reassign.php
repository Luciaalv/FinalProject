<?php
session_start();
?> 

<!----------Formulario de reasignación de proyectos. Recibe los datos de my_projects.php--------->
<!DOCTYPE html>
<html>
    <head>
      <?php include "cabecera.php";?>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <?php
        include "conexión.php";
            $task=$_POST['task'];
            $ide =$_POST['ide'];
            $lang =$_POST['lang'];
            $query="SELECT e.id AS ide, e.name AS employee, t.language AS language FROM employees e  
            INNER JOIN $task t ON e.id=t.id WHERE t.language ='$lang' AND NOT e.id=$ide";
            $result=mysqli_query($conexion, $query);
            if($result){
                if($result->num_rows==0){
                    echo "<div class='d-flex h-100'>
                    <div class='m-auto p-4'><h4>No hay empleados disponibles.</h4></div></div>";
                }
            }
            else echo "Se ha producido un error.";
        ?>
    </head>
    <body>
    <?php if($result->num_rows > 0):
        $assoc = mysqli_fetch_all($result, MYSQLI_ASSOC);?>
        <table class="table">
        <thead class="thead-dark">
        <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Idioma</th>
        <th></th>
        </tr>
        </thead>
        <?php foreach ($assoc as $key=>$value):?>
            <form action='var_proyectos.php' method='POST'>
            <td><?php echo $value['ide'];?></td>
            <td><?php echo $value['employee'];?></td>
            <td><?php echo $value['language'];?></td>
            <td><input type ='submit' name='reassign' value='Asignar' class='btn btn-dark'></td></tr>
            <input type='hidden' name='new_ide' value='<?php echo $value['ide'];?>'>
            <input type='hidden' name='name' value="<?php echo $value['employee'];?>">
            <input type='hidden' name='language' value="<?php echo $value['language'];?>">
            <input type='hidden' name='task' value="<?php echo $task?>">
            <input type='hidden' name='idp' value="<?php echo $_POST['idp'];?>">
            <input type='hidden' name='old_ide' value="<?php echo $_POST['ide'];?>">
            </form>
        <?php endforeach; 
        endif;?>
        </table>
</body>
</html>

<?php mysqli_close($conexion);?>