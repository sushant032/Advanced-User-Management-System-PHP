<?php
require_once('bootstrap/init.php');
$student = new Student();
$student->logout();
Redirect::to('index.php');
 ?>
