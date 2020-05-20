<?php
  /* Detaliile de conectare la baza de date */
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'universitate_db');
  define('DB_USER', 'marina');
  define('DB_PASS', 'parola');

  /*Se reporteaza toate erorrile cu exceptia celor de tip NOTICE si DEPRECATED */
  error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
?>
