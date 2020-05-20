<?php
    include_once   "admin-functions.php";
    include_once    "../connect.php";
    // include_once   "headerAdmin.php";
?>


<!DOCTYPE html>
<html>
    <head>
        <style>
            #mytab{
            padding: 1vh;
            margin-bottom: 4vh;
            margin-left: 10vw;
            background-color: #54f542;
            width: 5cm;
            height: 2cm;
            }
            #aa{
                color:#253823;
            }
            #menu{

            background-color: #314457;
            width: 40cm;
            height: 2cm;
            }
            a{
                color: #3fd1a0;
            }
            H1{
                padding: 10px;
                color: #4cba55;
            }
            H2{
                padding: 10px;
                color: #659406;
            }
            body{
             background-color: #162029;
            }
        </style>
        
<?php
        if(isLogged()) 
           echo "<H2> user: ". getLoggedUser() . " </H2>";

?>
    <table id ="mytab" >
    <td> <a href="../Login.php" id ="aa">login</a></td>
    <td> <a href="index.php?comanda=logout" id ="aa">logout</a></td>
    </table>
 

<?php
if(isLogged())
{
?>
    <table id = "menu">
    <td> <a href="cadreDidacticeAdmin.php" >Cadre Didactice</a></td>
    <td> <a href="../Anunturi.php" >Anunturi</a></td>
    </table>
    </head>
    <body>
<?php
}
?>

