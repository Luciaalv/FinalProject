<?php
/*********Esta página buscará en la bd el número de proyectos nuevos del usuario conectado para mostrarlo en la barra de navegación******/
include "conexión.php";
session_start();
$user=$_SESSION['translator'];
$query="SELECT * FROM employees e INNER JOIN assigned_projects a ON e.id = a.id_employees INNER JOIN projects p ON p.id = a.id_project 
INNER JOIN managers m ON m.id = a.id_managers WHERE e.email = '$user' AND a.state IS NULL";
$result=mysqli_query($conexion, $query);
if($result){
    $total=$result->num_rows;
    echo $total;
}
?>