<!--------------En esta página se mostrarán los archivos que se puedan descargar----------------->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Download files</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="style.css">
  <script>
  $(document).ready(function(){
    $('button[name="start"]').on( "click", function() {
      $.ajax({
      url: "var_proyectos.php?start",
      method: "POST",
      data: {id: $('td[name="id"]').attr('value'), state: $('button[name="start"]').attr('value')}
      }).done(function(res){
        alert(res);
      });
    });
  });
  </script>

</head>
<body>

<?php if($result->num_rows > 0):?>
<div class='container col-sm-6 p-4'>
<table class="table table-hover">
<thead class="thead-dark">
    <tr><th class='title' colspan='3'><?php echo $nameTable?></th></tr>
    <thead class='thead-light'>
    <tr>
    <th>Proyecto</th>
    <th>Documento</th>
    <th>Descargas</th>
    </tr>
    </thead>
</thead>
<tbody>
  <?php foreach ($result as $file): ?>
    <tr>
      <td name='id' value='<?php echo $file['id_project']; ?>'><?php echo $file['id_project']; ?></td>
      <td><?php echo $file['document_name']; ?></td>
      <td><a href="downloads.php?file_id=<?php echo $file['document_name'];?>&table=<?php echo $table?>" class="btn btn-dark"><i class='fas fa-download'></i></a></td>
    </tr>
  <?php endforeach;?>
</tbody>
</table>
</div>
<?php endif;?>

</body>
</html>