<?php
session_start();
include "conexión.php";
include "data_users.php";
include "functions_project.php";

/*********Aquí se reciben los datos de la página ajax_search.php y se introducen los datos de las casillas marcadas en la bd. *******/

if(isset($_POST['send'])){
    foreach ($_POST as $clave => $valor) {
        $_SESSION['form2'][$clave] = $valor;
    }

    $id_pm=$id_pm['id'];
    $p=$_SESSION['form2']['assign'];


    foreach($p as $key => $value){
        $id_proj=$_SESSION['form1']['idp'];
        foreach ($value as $subkey => $subvalue){
        $id_emp= $subvalue;
        $task= $subkey;

            if(assignProject($id_proj, $id_pm, $id_emp, $task)){
                echo "<script type='text/javascript'>alert('Proyecto asignado.');
                window.location.href='index.php';
                </script>";
            }
            else{
                echo "<script type='text/javascript'>alert('No ha sido posible asignar el proyecto. Vuelve a intentarlo.');
                window.location.href='form_projects.php';
                </script>";
            }
        }
 
    }

    unset($_SESSION['form1']);
    unset($_SESSION['form2']);

}


?>