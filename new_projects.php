<?php
session_start();
if(!isset($_SESSION['translator'])){
    header('location:index.php');
}
include "var_proyectos.php";
include "conexión.php";

function updateState($p, $e, $s){
    include "conexión.php";
    $query="UPDATE assigned_projects SET state = '$s' WHERE id_project = $p AND id_employees = $e";
    $result=mysqli_query($conexion, $query);
    if($result){
        echo "<script type='text/javascript'>alert('Project ".$s.".');
        window.location.href='index.php';
        </script>";
    }else echo "Se ha producido un error.";
    mysqli_close($conexion);
}

if(isset($_GET['accept'])){
    $p=$_GET['idp'];
    $e=$_GET['ide'];
    $s="accepted";
    updateState($p,$e,$s);
}
if(isset($_GET['reject'])){
    $p=$_GET['idp'];
    $e=$_GET['ide'];
    $s="rejected";
    updateState($p,$e,$s);
}
?>

<!-------Aquí se mostrarán los proyectos nuevos de los traductores, que podrán aceptarlos o rechazarlos-------->
<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
    include "cabecera.php";
    
    $query="SELECT p.name AS project, p.id AS idp, p.length AS length, e.id AS ide, e.name AS employee, a.task AS task, a.state AS state, m.name AS manager
    FROM employees e INNER JOIN assigned_projects a ON e.id = a.id_employees INNER JOIN projects p ON p.id = a.id_project 
    INNER JOIN managers m ON m.id = a.id_managers WHERE $var.email = '$user' AND a.state IS NULL";
    $result=mysqli_query($conexion, $query);
    if($result){
        if($result->num_rows==0){
            echo "<div class='d-flex h-100'>
            <div class='m-auto p-4'><h4>No hay nuevos proyectos.</h4></div></div>";
        }
    }
    else echo "Se ha producido un error.";

    ?>
    </head>
    <body>
    <?php if($result->num_rows > 0){
        $assoc = mysqli_fetch_all($result, MYSQLI_ASSOC);?>
        <table class="table">
        <thead class="thead-dark">
        <tr>
        <th>Proyecto</th>
        <th>Encargado</th>
        <th>Empleado</th>
        <th>Tarea</th>
        <th>Asignado</th>
        <th>Aceptar</th>
        <th>Rechazar</th>
        </tr>
        </thead>
        <?php foreach ($assoc as $key=>$value):?>
            <tr><td><?php echo $value['project'];?></td>
            <td><?php echo $value['manager'];?></td>
            <td><?php echo $value['employee'];?></td>
            <td><?php echo $value['task'];?></td>
            <td><?php echo $value['length'];?></td>    
            <td><a href='new_projects.php?accept&idp="<?php echo $value['idp'];?>"&ide="<?php echo $value['ide'];?>"' class="btn btn-dark">
            <img src='images/accept.png'>
            </a></td>
            <td><a href='new_projects.php?reject&idp="<?php echo $value['idp'];?>"&ide="<?php echo $value['ide'];?>"' class="btn btn-dark">
            <img src='images/reject.png'>
            </a></td>
            </tr>
        <?php endforeach; }?>
        
        </table>
</body>
</html>

<?php mysqli_close($conexion);?>