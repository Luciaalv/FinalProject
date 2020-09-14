<?php
   //CREACIÓN DE LA SESIÓN
   session_start();
   include "mail.php";
   $name=$_POST['nombre'];
   $email=$_POST['email'];

   //ESTRUCTURAS DE CONTROL QUE LLAMARÁN A SU FUNCIÓN SEGÚN EL BOTÓN QUE SE PULSE EN EL FORMULARIO

    if(isset($_POST['insertar'])){
      $password=$_POST['password'];
      insertManagerData($name,$email,$password);
      if(sendMail($password, $email)){
        echo "<script type='text/javascript'>alert('Correo enviado.');
        window.location.href='index.php'
        </script>";
      } else{
        echo "<script type='text/javascript'>alert('No se ha podido enviar el correo.'); 
        window.location.href='index.php'
        </script>";
      }
    }

    if(isset($_POST['eliminar'])){
      deleteManagerData($name, $email);
    }

    if(isset($_POST['actualizar'])){ 
      updateManagerData($name,$email);
    }

    //FUNCIÓN PARA INSERTAR DATOS EN LA TABLA DE GESTORES

      function insertManagerData($name,$email,$password){
          include "conexión.php";
          $query="INSERT INTO managers (name, email, password) VALUES ('$name','$email','$password')";
                if (mysqli_query($conexion, $query)):
                 echo "<script type='text/javascript'>alert('Datos introducidos correctamente en la tabla de gestores.'); 
                 </script>";
                else: echo "<script type='text/javascript'>alert('Error al insertar datos en la tabla de gestores.');
                window.location.href='form_managers.php';
                 </script>";
                endif;
  
            mysqli_close($conexion);
        }
  
      //FUNCIÓN PARA ACTUALIZAR DATOS EN LA TABLA DE EMPLEADOS
  
      function updateManagerData($name,$email){
        include "conexión.php";
           $query="UPDATE managers SET name ='$name', email='$email' WHERE name ='$name' OR email='$email'";
          if (mysqli_query($conexion, $query)){
            echo "<script type='text/javascript'>alert('Datos actualizados correctamente.');
            window.location.href='index.php';
            </script>";
          }
          else { echo "<script type='text/javascript'>alert('Error al actualizar los datos.');
            window.location.href='form_managers.php';
            </script>";}
          mysqli_close($conexion);  
      }
  
      //FUNCIÓN PARA ELIMINAR DATOS DE LA TABLA DE EMPLEADOS 
  
     function deleteManagerData($name, $email){
      include "conexión.php";
          $query="DELETE FROM managers WHERE name= '$name' AND email= '$email'";
          $resultado=mysqli_query($conexion, $query) or die ("Error al borrar datos.");
          if (mysqli_affected_rows($conexion)==0){
            echo "<script type='text/javascript'>alert('No hay registros que eliminar');
            window.location.href='index.php';
            </script>";
          }
          else{
            $i=mysqli_affected_rows($conexion);
            echo "<script type='text/javascript'>alert('Registros eliminados: ' +\"$i\");
            window.location.href='index.php';
            </script>";
          }
          mysqli_close($conexion);
      }
    
    



?>