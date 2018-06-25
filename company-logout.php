<?php
  require_once('bootstrap/init.php');
  $user = new Company();
  $user->logout();
  Redirect::to('index.php');
?>
