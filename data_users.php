<?php
/*********Estos datos se usarán para mostrar el perfil de cada usuario *******/

if(isset($_SESSION['manager'])){
    $user = $_SESSION['manager'];
    $rank = 'managers';
    $id_pm = getUserData($rank, $user);
}
if(isset($_SESSION['admin'])){
    $user = $_SESSION['admin'];
    $rank = 'managers';
    $id_pm = getUserData($rank, $user);
}
elseif(isset($_SESSION['translator'])){
    $user = $_SESSION['translator'];
    $rank = 'employees';
}

function getUserData($rank, $user){
    include "conexión.php";
    $query="SELECT * FROM $rank WHERE email = '$user'";
    $result=mysqli_query($conexion, $query);
    if($result){
        $assoc = mysqli_fetch_assoc($result);
        return $assoc;
    } 
    else echo "Se ha producido un error.";
    mysqli_close($conexion);
}

