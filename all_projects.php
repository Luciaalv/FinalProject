<?php
/************ Esta página muestra la información de todos los proyectos de la base de datos. *********/

include "conexión.php";
    $query="SELECT * FROM projects";
    $result=mysqli_query($conexion, $query);
    if($result){
        $assoc = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else echo "Se ha producido un error.";
?>
    
<!DOCTYPE html>
<html>
    <head>
      <?php include "cabecera.php";?>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
        <table class="table">
        <thead class="thead-dark">
        <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Cliente</th>
        <th>Palabras</th>
        <th>Estado</th>
        <th>Editar</th>
        <th>Eliminar</th>
        </tr>
        </thead>
        <?php foreach ($assoc as $key=>$value):?>
            <form action='form_projects.php' id='projects' method='POST'>
            <td><?php echo $value['id'];?></td>
            <td><?php echo $value['name'];?></td>
            <td><?php echo $value['client'];?></td>
            <td><?php echo $value['length'];?></td>
            <td><?php echo $value['state'];?></td>
            <td><button class='btn btn-light' type ='submit' name='update'>
                <i class='fas fa-pencil-alt'></i>
            </button></td>
            <td><button class='btn btn-dark' type ='submit' name='delete' formaction='var_proyectos.php' onclick="return confirmDelete()">
                <i class='fas fa-trash-alt'></i>
            </button></td></tr>       
            <input type='hidden' name='idp' value='<?php echo $value['id'];?>'>
            <input type='hidden' name='name' value="<?php echo $value['name'];?>">
            <input type='hidden' name='client' value="<?php echo $value['client'];?>">
            <input type='hidden' name='length' value="<?php echo $value['length'];?>">
            <input type='hidden' name='state' value="<?php echo $value['state'];?>">  
            </form>
        <?php endforeach; ?>
        </table>


</body>
</html>

<?php mysqli_close($conexion);?>