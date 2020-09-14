
   <?php
   //CREACIÓN DE LA SESIÓN
   session_start();
   include "mail.php";
   $nombre=$_POST['nombre'];
   $email=$_POST['email'];

   //ESTRUCTURAS DE CONTROL QUE LLAMARÁN A SU FUNCIÓN SEGÚN EL BOTÓN QUE SE PULSE EN EL FORMULARIO

    if(isset($_POST['insertar'])){
      $task=$_POST['task'];
      $lang=$_POST['language'];
      $password=$_POST['password'];
      $id=insertUserData($nombre,$password,$email);
      insertTask($id, $task, $lang);
    }

    if(isset($_POST['eliminar'])){
      deleteUserData($nombre,$email);
    }

    if(isset($_POST['actualizar'])){ 
      $task=$_POST['task'];
      $lang=$_POST['language'];
      $id=updateUserData($nombre,$email);
      updateTask($id, $task, $lang);
    }

    
    //FUNCIÓN PARA INSERTAR DATOS EN LAS TABLAS DE TAREAS 

    function insertTask($id, $task, $lang){
      include "conexión.php";
      foreach ($task as $e):
        $query="INSERT INTO $e (id, language) VALUES ('$id','$lang')";
        if (mysqli_query($conexion, $query)===false):
        echo "<script type='text/javascript'>alert('Error al insertar datos en la tabla de tareas.');  
        window.location.href='form_users.php'  
        </script>";
        endif;
      endforeach;
      echo "<script type='text/javascript'>alert('Datos introducidos correctamente.');
      window.location.href='show_users.php';</script>";
      mysqli_close($conexion);
    }

    //FUNCIÓN PARA INSERTAR DATOS EN LA TABLA DE EMPLEADOS 

      function insertUserData($nombre,$password,$email){
        include "conexión.php";
        $query="INSERT INTO employees (name, email, password) VALUES ('$nombre','$email','$password')";
              if (mysqli_query($conexion, $query)):
                $query1="SELECT id FROM employees WHERE email='$email' AND name='$nombre'";
                if(mysqli_query($conexion, $query1)):
                $result=mysqli_query($conexion, $query1);
                  foreach($result as $id){
                    $id=$id['id'];
                  }
                  if(!sendMail($password, $email)){
                    echo "<script type='text/javascript'>alert('No se ha podido enviar el correo.'); 
                    window.location.href='form_users.php'
                    </script>";
                  }else
                  return $id;
                endif;
              else: echo "<script type='text/javascript'>alert('Error al insertar datos en la tabla de empleados.');
              window.location.href='form_users.php'
               </script>";
              endif;
          mysqli_close($conexion);
      }


    //FUNCIÓN PARA ACTUALIZAR DATOS EN LA TABLA DE EMPLEADOS

    function updateUserData($nombre,$email){
      include "conexión.php";
        $query="UPDATE employees SET name ='$nombre', email='$email' WHERE name='$nombre' OR email='$email'";
        if (mysqli_query($conexion, $query)){
          $query1="SELECT id FROM employees WHERE email='$email' AND name='$nombre'";
            if(mysqli_query($conexion, $query1)){
              $result=mysqli_query($conexion, $query1);
              foreach($result as $id){
                $id=$id['id'];
              }
              return $id;
            }
        }
        else { echo "<script type='text/javascript'>alert('Error al actualizar los datos.');
          window.location.href='form_users.php'
          </script>";}
        mysqli_close($conexion);  
    }
      function updateTask($id, $task, $lang){
        include "conexión.php";
        $tables=array("translators", "proofreaders", "testers");
        foreach($tables as $table){
          $delete= "DELETE FROM $table WHERE id='$id'";
          $result=mysqli_query($conexion, $delete);
        }
        insertTask($id, $task, $lang);
        mysqli_close($conexion);
      }


    //FUNCIÓN PARA ELIMINAR DATOS DE LA TABLA DE EMPLEADOS 

   function deleteUserData($nombre,$email){
    include "conexión.php";
        $query="DELETE FROM employees WHERE name='$nombre' AND email= '$email'";
        $resultado=mysqli_query($conexion, $query) or die ("Error al borrar datos.");

        if (mysqli_affected_rows($conexion)==0){
          echo "<script type='text/javascript'>alert('No hay registros que eliminar');
          window.location.href='show_users.php';
          </script>";
        }
        else{
          $i=mysqli_affected_rows($conexion);
          echo "<script type='text/javascript'>alert('Registros eliminados: ' +\"$i\");
          window.location.href='show_users.php';
          </script>";
        }
        mysqli_close($conexion);
    }
  
  


   ?>

