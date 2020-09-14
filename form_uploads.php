
<!----------Formulario para subir archivos. Según el perfil y la tarea 
            del usuario que los suba se almacenarán en una tabla u otra----------->
<div class='col-sm-6 m-auto p-4'>
<form action="var_proyectos.php" method="POST" enctype="multipart/form-data" onsubmit="return required()">
<label for="file">Selecciona los archivos de este proyecto que quieres enviar:</label>
<input type="file" name="<?php echo $tableUpload?>[]" id="file" multiple>
<input type="hidden" name="id_project" value="<?php echo $id?>">
<input type="submit" name="submit" value="Subir archivos">
</form>
</div>