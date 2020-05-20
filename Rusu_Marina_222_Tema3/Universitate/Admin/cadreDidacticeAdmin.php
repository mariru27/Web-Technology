<?php
    session_start();
    include_once   "admin-functions.php";
    include_once    "../connect.php";
    include "index.php";
    include_once   "headerAdmin.php";
    if(isLogged())
    {
    


?>
<h1 align="center">Cadre Didactice Admin</h1>

<!-- <script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "http://localhost/Universitate/admin/cadreDidacticeAdmin.php");
    }
</script> -->
<link rel="stylesheet" href="../Styles/adminCD.css">

<?php
print("<table style=\"background-color: #6dcc66;
width: 40cm;
height: 1cm;
margin-top: 2cm;
\"><tr><td><center><a style=\"color: #09144d;\" href='AdaugaCD.php'>Adauga Cadru didactic</a></center></td></tr>></table>");

$actiune = isset($_REQUEST['actiune'])? $_REQUEST['actiune']:"";

if(!empty($actiune))
{
    switch($actiune)
    {
    case 'delete':
        $idProfesor = $_REQUEST['idProfesor'];
        stergeCadruDidactic($idProfesor);
    break;
    case 'adauga':
        adaugaCadreDidactice();
    break;
    case 'edit':
        editCadruDidactic();
    }
 
    // echo "<meta http-equiv='refresh' content='0'>";
}
AfiseazaCadreDidactice();

?>

<?php

    include_once   "footerAdmin.php";
}
?>
