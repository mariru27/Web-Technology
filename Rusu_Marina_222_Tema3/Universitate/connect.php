<?php
  require_once "config.php";
  //Stabilim conexiunea cu serverul MySQL
  global $id_conexiune;
  $id_conexiune = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
  
  if (!$id_conexiune)  {
    die('Eroare conectare la MySQL: ' . mysqli_connect_error());
  }
	    
  mysqli_select_db($id_conexiune, DB_NAME) or die("Eroare la selectarea bazei de date " . mysqli_error($conexiune));  
?>