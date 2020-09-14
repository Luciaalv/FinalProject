<header>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="JS_functions.js"></script>
<script type="text/javascript">


/*******Función para mostrar el número de proyectos nuevos en la cabecera de la página *******/

  $(document).ready(function(){
     $.ajax({
      url:"notification.php",
      success:function(data){
        if(data > 0){
          $(".badge").show();
          $("#datacount").html(data);
        }
      }
    })

    $('body').on('click.modal.data-api', '[data-toggle="modal"]', function() {
        $($(this).data("target") + ' .modal-content').load($(this).attr('data-remote'));
    });

  });
</script>

  <?php
    if(isset($_SESSION['translator'])):
     ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item pl-4 pr-4"><h4><small><a class="nav-link" href="index.php">Inicio</a></small></h4></li>
        <li class="nav-item pl-4 pr-4"><h4><small><a class="nav-link" data-remote="show_profile.php" data-toggle="modal" data-target="#myModal">Mi perfil</a></small></h4></li>
        <li class="nav-item pl-4 pr-4"><h4><small><a class="nav-link" href="new_projects.php"><span class="badge badge-pill badge-dark" style="float:right;margin-top:-5px;display:none;"><div id="datacount"></div></span>Nuevos proyectos </a></small></h4></li>
      </ul>
    <form class="form-inline my-2 my-lg-0">
    <button type="submit" class="btn btn-danger my-2 my-sm-0" name="desconectar" formaction="login.php" formmethod="post">Cerrar sesión</button>
    </form>
      </div>
    </nav>

    <?php elseif(isset($_SESSION['admin'])): ?>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse">
      <ul class="navbar-nav mr-auto">
       <li class="nav-item pl-4 pr-4"><h4><small><a class="nav-link" href="index.php">Inicio</a></small></h4></li>
       <li class="nav-item pl-4 pr-4"><h4><small><a class="nav-link" href="form_managers.php">Nuevo gestor</a></small></h4></li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <button type="submit" class="btn btn-danger my-2 my-sm-0" name="desconectar" formaction="login.php" formmethod="post">Cerrar sesión</button>
      </form>
        </div>
      </nav>
    

    <?php elseif(isset($_SESSION['manager'])): ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item pl-4 pr-4"><h4><small><a class="nav-link" href="index.php">Inicio</a></small></h4></li>
    <li class="nav-item pl-4 pr-4"><h4><small><a class="nav-link" data-remote="show_profile.php" data-toggle="modal" data-target="#myModal">Mi perfil</a></small></h4></li>
    <li class="nav-item dropdown pl-4 pr-4">
    <h4><small><a class="nav-link dropdown-toggle" id="dropdownUsers" href="" data-toggle="dropdown">Usuarios</a>
        <div class="dropdown-menu pt-3" aria-labelledby="dropdownUsers">
          <h6><a class="dropdown-item" href="form_users.php">Nuevo usuario</a></h6>
          <h6><a class="dropdown-item" href="show_users.php">Ver usuarios</a></h6>
        </div></small></h4>
    </li>
    <li class="nav-item dropdown pl-4 pr-4">
    <h4><small><a class="nav-link dropdown-toggle" href="" data-toggle="dropdown">Proyectos</a>
        <div class="dropdown-menu pt-3">
          <h6><a class="dropdown-item" href="form_projects.php">Nuevo proyecto</a></h6>
          <h6><a class="dropdown-item" href="my_projects.php">Mis proyectos</a></h6>
        </div></small></h4>
    </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
    <button type="submit" class="btn btn-danger my-2 my-sm-0" name="desconectar" formaction="login.php" formmethod="post">Cerrar sesión</button>
    </form>
      </div>
    </nav>
    <?php endif;?>


  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
            </div>
        </div>
    </div>
  </div>

  </header>



