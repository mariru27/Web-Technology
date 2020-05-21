<?php
    session_start();
    include_once   $_SERVER["DOCUMENT_ROOT"] ."/Universitate/Admin/admin-functions.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cadre didactice</title>
        <link rel="stylesheet" href="Styles/MyStyle.css">
        <?php
        include 'header.php';
        ?>
        <H1>Cadre didactice</H1>
        <hr>
        <link rel="stylesheet" href="Styles/adminCD.css">
    </head>
    <body>
    <?php
    if(isLogged())
    {
        print("<table style=\"background-color: #6dcc66;
        width: 40cm;
        height: 1cm;
        margin-top: 2cm;
        \"><tr><td><center><a style=\"color: #09144d;\" href='Admin/AdaugaCD.php'>Adauga Cadru didactic</a></center></td></tr>></table>");
    }

if(isLogged())
{
    $actiune = isset($_REQUEST['actiune'])? $_REQUEST['actiune']:"";

    if(!empty($actiune))
    {
        switch($actiune)
        {
        case 'delete':
            $idProfesor = $_REQUEST['idProfesor'];
            stergeCadruDidactic($idProfesor);
        break;
        }
    
    }
}
AfiseazaCadreDidactice();

?>
    </body>
</html>