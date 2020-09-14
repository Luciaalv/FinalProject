<?php 
    function insertProject($id_proj,$nombre,$client, $length, $deadline){
        include "conexión.php";
         if(!empty($id_proj)&&!empty($nombre)):   
              $query="INSERT INTO projects (id, name, client, length, deadline) VALUES ('$id_proj','$nombre', '$client', '$length', '$deadline')";
              if(mysqli_query($conexion, $query)):
              return true;
              else: echo "<script type='text/javascript'>alert('Error al insertar datos en la tabla de proyectos.');
              window.location.href='form_projects.php'
              </script>";
              return false;
              endif;
         else:
            echo "<script type='text/javascript'>alert('Introduce los datos del proyecto.');
            window.location.href='form_projects.php';
            </script>";
         endif;
      mysqli_close($conexion);
    }
    
    function insertDocuments($id_proj, $file_name, $bd_table){
      include "conexión.php";
      $query="INSERT INTO $bd_table (id_project, document_name) VALUES ('$id_proj','$file_name')";
      if(mysqli_query($conexion, $query)===false):
         echo "<script type='text/javascript'>alert('Error al insertar los datos del documento. Vuelve a intentarlo.');
         window.location.href='form_projects.php';
         </script>";
      endif;
      mysqli_close($conexion);
    }

    function assignProject($id_proj, $id_pm, $id_emp, $task){
        include "conexión.php";
        $query="INSERT INTO assigned_projects (id_project, id_managers, id_employees, task) 
        VALUES ('$id_proj','$id_pm', '$id_emp', '$task')";
        if(mysqli_query($conexion, $query)):
           return true;
           else: 
           return false;
           endif;
        mysqli_close($conexion);
      }

      function uploadFiles($id_proj, $bd_table, $path, $folder){
         if(!empty($folder)){
              $count=0;
              foreach($folder['name'] as $eachfile){
                $errors= array();
                $file_name = $folder['name'][$count];  
                $file_size = $folder['size'][$count];  
                $file_tmp = $folder['tmp_name'][$count];    
                $file_type = $folder['type'][$count];
                $split_ext = explode('.',$file_name);
                $file_ext = strtolower(end($split_ext));
                $extensions= array("txt","pdf","docx", "doc", "jpeg", "jpg", "png", "tmx", "xliff", "mqxliff", "sdlxliff");
      
                if(in_array($file_ext,$extensions)=== false){
                   $errors[]="El formato de archivo no es válido.";
                }      
                if($file_size > 52428800) {
                   $errors[]="Los archivos no pueden superar los 5 MB";   ////Se ha modificado el apartado upload_max_filesize de php.ini
                }      
                if(empty($errors)==true) {
                   if(move_uploaded_file($file_tmp, $path.$file_name)){
                     insertDocuments($id_proj, $file_name, $bd_table);
                   }   
                   else{
                     echo "<script type='text/javascript'>alert('Se ha producido un error al subir los archivos. Vuelve a intentarlo.');
                     window.location.href='form_projects.php';
                     </script>";
                   }
                   $count++;
                }   
              }
            }       
      }

      function updateProject($id_proj, $name, $client, $length, $deadline){
         include "conexión.php";
         $query="UPDATE projects SET name='$name', client='$client', length='$length', deadline='$deadline' WHERE id= $id_proj";
         if(mysqli_query($conexion, $query)):
            echo "<script type='text/javascript'>alert('Proyecto modificado.');
            </script>";
            return true;
            else: echo "<script type='text/javascript'>alert('No se ha podido modificar el proyecto.');
            </script>";
            return false;
            endif;
         mysqli_close($conexion);

      }

      function deleteProject($id){
         include "conexión.php";
         $query="DELETE FROM projects WHERE id = $id";
         if(mysqli_query($conexion, $query)):
            return true;
            else: 
            return false;
            endif;
         mysqli_close($conexion);
      }

      function deleteFiles($id){
         include "conexión.php";
         $query="SELECT p.id, a.document_name AS name FROM projects p INNER JOIN
         (select *from original_files union select * from translated_files union select * from final_files) a ON p.id=a.id_project WHERE p.id=$id";
         $result=mysqli_query($conexion, $query);
         if($result->num_rows>0):
            $assoc = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($assoc as $key=>$value):
               $files = glob('*/'.$value['name']);
               foreach ($files as $file) {
                  unlink($file); 
                }
            endforeach;
         endif;
         mysqli_close($conexion);
      }

      function reassignProject($id_proj, $old_emp, $new_emp, $task){
         include "conexión.php";
         $query="UPDATE assigned_projects SET id_employees=$new_emp, state=null WHERE id_project= '$id_proj' AND id_employees =$old_emp AND task='$task'";
         if(mysqli_query($conexion, $query)):
            return true;
         else:
            return false;
         endif;
         mysqli_close($conexion);
       }


      function projectState($id, $state){
         include "conexión.php";
         $query="UPDATE projects SET state='$state' WHERE id= '$id'";
         if(mysqli_query($conexion, $query)):
            echo "Estado actualizado.";
         else: 
            echo "Error al actualizar el estado.";
         endif;
         mysqli_close($conexion);

      }


?>