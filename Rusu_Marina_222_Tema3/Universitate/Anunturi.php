<?php
session_start();
$myRoot = $_SERVER["DOCUMENT_ROOT"];
include_once $myRoot."/Universitate/Admin/admin-functions.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Anunturi</title>
        <link rel="stylesheet" href="Styles/MyStyle.css">
        <?php
        include 'header.php';
        ?>
        <H1 align="center">Anunturi Studenti</H1>
        <hr>
    </head>
    <body>
        <?php
        if(isLogged())
        {
            $actiune = isset($_REQUEST['actiune'])? $_REQUEST['actiune']:"";
            switch($actiune)
            {
                case 'sterge':
                    stergeAnunt();
                break;
            }
            
            print("<table style=\"background-color: #6dcc66;
            width: 40cm;
            height: 1cm;
            margin-top: 2cm;
            \"><tr><td><center><a style=\"color: #09144d;\" href='Admin/adaugaAnunt.php'>Adauga Anunt</a></center></td></tr>></table>");
        }
        afiseazaAnunturi();
    ?>
    </body>
</html>