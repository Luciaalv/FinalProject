<?php
include "functions_project.php";

   ////VARIABLES PARA LA INSERCIÓN EN LA BD DE ARCHIVOS ORIGINALES Y DATOS DEL PROYECTO
   if(!empty($_POST['idp']) && isset($_POST['submit'])){
      $id_proj=$_POST['idp'];
      $nombre=$_POST['name'];
      $client=$_POST['client'];
      $length=$_POST['length'];
      $deadline=$_POST['deadline'];
      $folder=$_FILES['originalFiles'];
      $bd_table='original_files';
      $path='./originalFiles/';
      if(insertProject($id_proj,$nombre,$client, $length,$deadline)){
         uploadFiles($id_proj,$bd_table, $path,$folder);
      }
   }
 
   ////VARIABLES PARA LA INSERCIÓN EN LA BD DE ARCHIVOS TRADUCIDOS
   if(isset($_FILES['translatedFiles'])){
      $folder=$_FILES['translatedFiles'];
      $id_proj=$_POST['id_project'];
      $bd_table='translated_files';
      $path='./translatedFiles/';
      uploadFiles($id_proj,$bd_table, $path,$folder);
      echo "<script type='text/javascript'>alert('Archivos enviados.');
      window.location.href='index.php';
      </script>";
   }

   ////VARIABLES PARA LA INSERCIÓN EN LA BD DE ARCHIVOS REVISADOS
   if(isset($_FILES['finalFiles'])){
      $folder=$_FILES['finalFiles'];
      $id_proj=$_POST['id_project'];
      $bd_table='final_files';
      $path='./finalFiles/';
      uploadFiles($id_proj,$bd_table, $path,$folder);
      echo "<script type='text/javascript'>alert('Archivos enviados.');
      window.location.href='index.php';
      </script>";
   }


   ////VARIABLES PARA ACTUALIZAR PROYECTOS
   if(isset($_POST['update'])){
      $id_proj=$_POST['idp'];
      $name=$_POST['name'];
      $client=$_POST['client'];
      $length=$_POST['length'];
      $deadline=$_POST['deadline'];
      $folder=$_FILES['originalFiles'];
      $bd_table='original_files';
      $path='./originalFiles/';
      if(updateProject($id_proj, $name, $client, $length, $deadline)){
         uploadFiles($id_proj,$bd_table, $path,$folder);
         echo "<script type='text/javascript'>window.location.href='index.php';</script>";
      }
   }

   ////LLAMADA A LA FUNCIÓN DE ELIMINACIÓN DE PROYECTOS
   if(isset($_POST['delete'])){
      $id = $_POST['idp'];
      deleteFiles($id);
      if(deleteProject($id)){   
         echo "<script type='text/javascript'>alert('Proyecto eliminado.');
         window.location.href='index.php';
         </script>";
      }else{
         echo "<script type='text/javascript'>alert('No se ha podido eliminar el proyecto.');
         window.location.href='index.php';
         </script>";
      }
   }

   ////VARIABLES PARA MOSTRAR MIS PROYECTOS
   if(isset($_SESSION['manager'])){
      $user = $_SESSION['manager'];
      $var = 'm';
  }
   if(isset($_SESSION['translator'])) {
      $user = $_SESSION['translator'];
      $var = 'e';
   }

   ////VARIABLES PARA REASIGNAR PROYECTOS A OTROS EMPLEADOS
   if(isset($_POST['reassign'])){
      $id_proj=$_POST['idp'];
      $old_emp=$_POST['old_ide'];
      $new_emp=$_POST['new_ide'];
      $task=$_POST['task'];
      if(reassignProject($id_proj, $old_emp, $new_emp ,$task)){
         echo "<script type='text/javascript'>alert('Proyecto reasignado.');
            window.location.href='my_projects.php';
            </script>";
      }
   }

   ////VARIABLES PARA ACTUALIZAR EL ESTADO DE LOS PROYECTOS
   if(isset($_GET['start'])){
      $id= $_POST['id'];
      $state= $_POST['state'];
      projectState($id, $state);
    }



?>