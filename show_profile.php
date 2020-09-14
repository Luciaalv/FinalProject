<?php
session_start();
include "data_users.php";
include "conexión.php";
if(isset($_GET['showDetails'])) {
    $user = $_GET['emp'];
    $rank = 'employees';
}

   $result= getUserData($rank, $user);?>

<div class="modal-body">
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>E-mail</th>
            </tr>
        </thead>
        <td><?php echo $result['id'];?></td>
        <td><?php echo $result['name'];?></td>
        <td><?php echo $result['email'];?></td></tr>
    </table>
    <?php  if(!isset($_GET['showDetails'])):?>
        <div class="modal-footer">
                <a href="password_change.php">Cambiar contraseña</p>
        </div>
    <?php endif;?>

</div>