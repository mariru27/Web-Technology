<?php
session_start();
include_once    $_SERVER["DOCUMENT_ROOT"]."/Universitate/connect.php";
include_once    $_SERVER["DOCUMENT_ROOT"]."/Universitate/Admin/admin-functions.php";
// include_once    "headerAdmin.php";

?>


<?php
$comanda = isset($_REQUEST["comanda"]) ? $_REQUEST["comanda"]:NULL;



if(isset($comanda))
{
    switch($comanda)
    {
        case 'login':
            $user = $_REQUEST["nume"];
            $password = $_REQUEST["parola"];

            if(!doLogin($user, $password))
                
                echo "<b>Autentificare esuata</b>";
        break;
        case 'logout':
            doLogout();
            header("Location: ../Home.php");
        break;
    }
    // include_once   "footerAdmin.php";
}

?>

