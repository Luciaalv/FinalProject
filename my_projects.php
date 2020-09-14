<?php 
if(!isset($_SESSION['translator'])){
    session_start();
}
?>
<!---------Aquí se mostrarán los proyectos del encargado o traductor que esté conectado al sistema---------->

<!DOCTYPE html>
<html>
    <head>
    <?php 
    include "cabecera.php"; 
    include "var_proyectos.php";
    include "conexión.php";
    
    $query="SELECT p.name AS project, p.id AS idp, p.length AS length, p.deadline AS deadline, e.id AS ide, e.name AS employee, e.email AS email, a.task AS task,
    a.state AS state, m.name AS manager, l.language AS language FROM employees e INNER JOIN assigned_projects a ON e.id = a.id_employees 
    INNER JOIN projects p ON p.id = a.id_project INNER JOIN managers m ON m.id = a.id_managers 
    INNER JOIN (SELECT * FROM translators UNION SELECT * FROM proofreaders UNION SELECT * FROM testers) l ON e.id=l.id WHERE $var.email = '$user'";
    $result=mysqli_query($conexion, $query);
    if($result){
        if($result->num_rows==0){
            echo "<div class='d-flex h-100'>
            <div class='m-auto p-4'><h4>En este momento no tienes proyectos.</h4></div></div>";
        }
    }
    else echo "Se ha producido un error.";
    
    ?>

<script>
    $(document).ready(function() {      
        $('body').on('click.modal.data-api', '[data-toggle="modal"]', function() {
        $($(this).data("target") + ' .modal-content').load($(this).attr('data-remote'));
        });
    });
</script>
    </head>
    <body>
    <?php if($result->num_rows > 0){
        $assoc = mysqli_fetch_all($result, MYSQLI_ASSOC);?>
        <table class="table">
        <thead class="thead-dark">
        <tr>
        <th>Proyecto</th>

        <?php if(isset($_SESSION['translator'])):?>
        <th>Encargado</th>
        <?php endif;?>

        <?php if(isset($_SESSION['manager'])):?>
        <th>Empleado</th>
        <?php endif;?>

        <th>Tarea</th>
        <th>Idioma</th>
        <th>Asignado</th>
        <th>Estado</th>
        <th>Fecha de entrega</th>
        <?php if(isset($_SESSION['manager'])):?>
        <th>Enlaces</th>
        <th>Contacto</th>
        <th>Reasignar</th>
        <?php else:?>
        <th>Enlaces</th>
        <?php endif;?>
        </tr>
        </thead>
        <?php foreach ($assoc as $key=>$value):?>
            <form action='form_reassign.php' method='POST'>
            <tr><td><?php echo $value['project'];?></td>

            <?php if(isset($_SESSION['translator'])):?>
            <td><?php echo $value['manager'];?></td>
            <?php endif;

            if(isset($_SESSION['manager'])):?>
            <td><?php echo $value['employee'];?></td>
            <?php endif;?>

            <td><?php echo $value['task'];?></td>
            <td><?php echo $value['language'];?></td> 
            <td><?php echo $value['length'];?></td> 
            <?php if(isset($_SESSION['translator']) && $value['state']==null):?>
                <td>-</td>
            <?php else:?>
            <td><?php echo $value['state'];?></td>
            <?php endif;?>
            <td><?php echo $value['deadline'];?></td>
            <?php if(isset($_SESSION['manager'])):?>
             <td><a href='downloads.php?eachProject&id=<?php echo $value['idp']?>' class='btn btn-dark'>Archivos</a></td>
            <?php endif;

            if(isset($_SESSION['translator']) && $value['state']!=='rejected' && $value['state']!==null):?>
             <td><a href='downloads.php?eachProject&id=<?php echo $value['idp']?>&task=<?php echo $value['task']?>' class='btn btn-dark'>Archivos</a></td>
            <?php elseif(isset($_SESSION['translator']) && $value['state']==null):?>
            <td>-</td>
            <?php endif;

            if (isset($_SESSION['manager'])):?>
                <td><button type="button" data-remote="show_profile.php?showDetails&emp=<?php echo $value['email']?>" class="btn btn-light" data-toggle="modal" data-target="#myModal">
                <i class='fas fa-address-card'></i></button></td>
                <?php if($value['state']=='rejected' || $value['state']==null):?>
                <td><button class='btn btn-dark' type ='submit' name='reassign' value='Reasignar proyecto'>
                <i class='fas fa-undo'></i>
                </button></td></tr>
                <?php else:?>
                <td>-</td>
                <?php endif;
            endif;?>
            <input type='hidden' name='idp' value="<?php echo $value['idp'];?>">
            <input type='hidden' name='ide' value="<?php echo $value['ide'];?>">
            <input type='hidden' name='lang' value="<?php echo $value['language'];?>">
            <input type='hidden' name='task' value="<?php echo $value['task'];?>">
            </form>
        <?php endforeach; }?>
        </table>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

</body>
</html>

<?php mysqli_close($conexion);?>