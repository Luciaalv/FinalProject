<?php
session_start();
include "conexión.php";
include "cabecera.php";
include "data_users.php";
 /********Código para descargar y subir los archivos a la ubicación que corresponda *******/

  /******Aquí se mostrarán todos los archivos originales del proyecto al que se acceda. Todos los usuarios implicados en el proyecto tienen acceso a ellos. ****/ 
if(isset($_GET['eachProject'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM original_files WHERE id_project = $id";
    $result = mysqli_query($conexion, $query);
    $table='originalFiles';
    $nameTable='Archivos originales';
    require "show_downloads.php";

  /*******Con este código los traductores subirán sus archivos a la tabla de traducidos. 
    Incluye un botón para avisar de que se ha comenzado a trabajar en el proyecto.*****/
    if(isset($_SESSION['translator']) && $_GET['task']=='translators'){
       $tableUpload='translatedFiles';
       include "form_uploads.php";
       echo "<div class='p-3 text-center'><button class='btn btn-dark' name='start' value='translating'>Comenzar proyecto</button></div>";
    }

    /*******Código para que los revisores accedan a los archivos traducidos, que se encontrarán en otra página al pulsar el enlace*****/
    if(isset($_SESSION['translator']) && $_GET['task']=='proofreaders'){
      echo "<p><a href='downloads.php?translatedFiles&id=".$id."' class='btn btn-dark'>Ver archivos traducidos</a></p>";
    }

    /*******Los testers no podrán subir archivos, solo avisar de que se ha comenzado a trabajar en el proyecto.*/
    if(isset($_SESSION['translator']) && $_GET['task']=='testers'){
      echo "<div class='p-3 text-center'><button class='btn btn-dark' name='start' value='testing'>Comenzar proyecto</button></div>";
   }

  /********Los managers también tendrán acceso a los archivos finales. *****/
    if(isset($_SESSION['manager'])){
      $table='finalFiles';
      $query = "SELECT * FROM final_files f INNER JOIN projects p ON f.id_project = p.id WHERE f.id_project = $id";
      $result = mysqli_query($conexion, $query);
      $nameTable='Archivos finales';
      include "show_downloads.php";
    }


}

    /*******Con este código los revisores podrán descargar los archivos traducidos y subir los revisados a la tabla de archivos finales. 
    Incluye un botón para avisar de que se ha comenzado a trabajar en el proyecto.*****/
    if(isset($_GET['translatedFiles'])){
      $id=$_GET['id'];
      $table='translatedFiles';
      $query = "SELECT * FROM translated_files t INNER JOIN projects p ON t.id_project = p.id WHERE t.id_project = $id";
      $result = mysqli_query($conexion, $query);
      $nameTable='Archivos traducidos';
      include "show_downloads.php";
      $tableUpload='finalFiles';
      include "form_uploads.php";
      echo "<div class='p-3 text-center'><button class='btn btn-dark' name='start' value='proofreading'>Comenzar proyecto</button></div>";
    }


  /********CÓDIGO DE DESCARGA DE ARCHIVOS******/
function download($path){
  set_time_limit(0);
  $filename = $_GET['file_id'];
  $filepath = $path.$filename;
  var_dump($filepath);
  $filetype=filetype($filepath);
  if (file_exists($filepath)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename= "'.basename($filepath).'"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($filepath));
      ob_clean();
      flush();
      readfile($filepath);
      exit;
  }
}

  /********Estas variables indican la tabla desde la cual se descargan los archivos********/
if (isset($_GET['file_id'])) {
  if($_GET['table']=='originalFiles'){
    $path='./originalFiles/';
  }
  elseif($_GET['table']=='translatedFiles'){
    $path='./translatedFiles/';
  }
  elseif($_GET['table']=='finalFiles'){
    $path='./finalFiles/';
  }
  download($path);
}
?>