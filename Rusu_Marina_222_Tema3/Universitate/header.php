<?php
    include_once   $_SERVER["DOCUMENT_ROOT"] ."/Universitate/Admin/admin-functions.php";
    // include $_SERVER["DOCUMENT_ROOT"] . "/Universitate/Admin/index.php";

?>
<style>
    table{
        background-color: #314457;
        width: 40cm;
        height: 2cm;
        margin: 0cm;
    }
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

</style>
<H2>
<?php
if(isLogged())
{
    echo "Esti logat utilizator: " . getLoggedUser();
}
else
{
    echo "Nu esti logat";

}
?>
</H2>

<br>
<table id ="mytab" >
    <td> <a href="login.php" id ="aa">login</a></td>
    <td> <a href="<?php  $_SERVER["DOCUMENT_ROOT"];?>/Universitate/Admin/index.php?comanda=logout" id ="aa">logout</a></td>
</table>
 


<table>
    <tr>
        <td><a href="Home.php">Home</a></td>
        <td><a href="Admitere.php">Admitere</a></td>
        <td><a href="Anunturi.php">Anunturi</a></td>
        <td><a href="CadreDidactice.php">Cadre Didactice</a></td>
        <td><a href="Contact.php">Contact</a></td>
        <td><a href="ProgrameStudii.php">Programe de Studii</a></td>
    </tr>
</table>