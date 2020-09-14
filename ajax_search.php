<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script> 
    /**********Función para deshabilitar las casillas con el mismo ID que las que se han marcado 
    y mostrar el botón de asignación solo cuando se haya marcado al menos una***********/

        $(document).ready(function(){
        $("input[name='send']").hide();
        $('input:checkbox[class="assign"]').change(function(){
          value = $(this).attr('value');
          id = $(this).attr('id');
            if($(this).is(':checked')){
              $('input:checkbox[value='+value+']:not(id='+id+')').attr('disabled',true);
              $(this).attr('disabled', false);
            }
            else {
              $('input:checkbox[value='+value+']:not(id='+id+')').attr('disabled',false);
            }

            oneChecked = $("input:checkbox[class='assign']:checked").length; 
              if(oneChecked == 0){
                $("input[name='send']").hide();
              }
              if(oneChecked > 0){
                $("input[name='send']").show();
              }
        });

        });
    </script>
  </head>
<body>
  <div class='container col-sm-6'>
    <form action='assign_project.php' method='POST'>
<?php
session_start();

if(!isset($_SESSION['manager'])){
  header('location:index.php');}
  
include "conexión.php";

  $arr = json_decode($_POST['arr']);
  $impArr = implode("','",$arr);

  /******Esta función muestra los resultados de la búsqueda especificada en el formulario form_projects2.php **********/

function getEmployees($var,$impArr){
  include "conexión.php";
  $query="SELECT e.id AS id, e.name AS name, e.email AS email, a.language AS language FROM employees e INNER JOIN $var a ON e.id = a.id WHERE a.language IN ('$impArr') ORDER BY language";
  $result=mysqli_query($conexion, $query) or die ("Error en la consulta.");
  if($result->num_rows > 0){
      if($var=='translators'){
        $es="Traductores";
      }
      if($var=='proofreaders'){
        $es="Revisores";
      }
      if($var=='testers'){
        $es="Testers";
      }
  echo "<table class ='table table-hover'>
  <thead class='thead-dark'>
  <tr><th class='title' colspan='5'>".$es."</th></tr>
  </tr></thead>
  <thead class='thead-light'>
  <tr>
  <th></th>
  <th>ID</th>
  <th>Nombre</th>
  <th>Email</th>
  <th>Idioma</th>
  </tr></thead>";
    while($row=mysqli_fetch_assoc($result)){
    echo "<tr><td><input type='checkbox' class='assign' name='assign[][".$var."]' value='".$row['id']."' id='".$var.".".$row['id']."')></td>";
    echo "<td><label for='".$var.".".$row['id']."' style='display:block'>" .$row['id']."</label></td>";
    echo "<td><label for='".$var.".".$row['id']."' style='display:block'>" .$row['name']."</label></td>";
    echo "<td><label for='".$var.".".$row['id']."' style='display:block'>" .$row['email']."</label></td>";
    echo "<td><label for='".$var.".".$row['id']."' style='display:block'>" .$row['language']."</label></td></tr>";
  }
  echo "</table>";      
  }
  else echo "";
  mysqli_close($conexion);
}

 /******Esta estructura decidirá qué tablas muestra según los datos enviados desde form_projects2.php *****/

foreach ($arr as $var){
  if($var=='translators'){
    getEmployees($var,$impArr);
  }
  if($var=='proofreaders'){
    getEmployees($var,$impArr);
  }
  if($var=='testers'){
    getEmployees($var,$impArr);
  }
}

?>
      <div class="p-3 text-center">
        <input type="submit" name="send" value="Asignar" class='btn btn-dark'>
      </div>
    </form>
  </div>
</body>

</html>