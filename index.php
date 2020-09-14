<?php
session_start();
  if(isset($_SESSION['translator'])){
  include "my_projects.php";
  }
  elseif(isset($_SESSION['manager'])){
  include "all_projects.php";
  }
  elseif(isset($_SESSION['admin'])){
  include "show_managers.php";
  }
  else{
    header('location:login.php');
  }
?>
