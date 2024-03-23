<?php

  session_start();

  $name = $_GET['name'];
  $_SESSION['products'][$name]--;

  exit;


?>