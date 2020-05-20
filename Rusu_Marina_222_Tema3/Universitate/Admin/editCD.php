<?php
session_start();
include_once    "../admin/admin-functions.php";
include_once   "headerAdmin.php";

if(isLogged())
{

?>
<?php

$idProfesor = $_REQUEST['idProfesor'];

global $id_conexiune;

$querySelectAttributes = sprintf("SELECT nume, mail,telefon,fax,pagWeb,grad FROM profesor WHERE idProfesor = '%d'", $idProfesor);
$resultSelectedAttributes = mysqli_query($id_conexiune, $querySelectAttributes);

if($resultSelectedAttributes)
{

    $row = mysqli_fetch_array($resultSelectedAttributes);

    $nume = $row['nume'];
    $mail = $row['mail'];
    $telefon = $row['telefon'];
    $fax = $row['fax']; 
    $pagWeb = $row['pagWeb'];
    $grad = $row['grad'];



?>
        <link rel="stylesheet" href="../Styles/adminCD.css">

<center>
<H1>Edit Cadru Didactic</H1>
<form action="../cadreDidactice.php" mhetod="POST">
    <input name="actiune" type="hidden" value="edit" />
    <table id = "tab">
        <tr>
        <input name="idProfesor" type="hidden" value="<?php echo $idProfesor; ?>" />
    <td>
        Nume:
    </td>
    <td>
        <input name="nume" type="text" value="<?php echo $nume;?>" />
    </td>
    </tr>
    <tr>
    <td>
    Mail:
    </td>
    <td>
    <input name="mail" type="text" value="<?php echo $mail;?>" />
    </td>
    </tr>
    <tr>
    <td>
    Telefon:
    </td>
    <td>
    <input name="telefon" type="text" value="<?php echo $telefon;?>" />
    </td>
    </tr>
    <tr>
    <td>
    Fax:
    </td>
    <td>
    <input name="fax" type="text" value="<?php echo $fax;?>" />
    </td>
    </tr>
    <tr>
    <td>
    pagWeb:
    </td>
    <td>
    <input name="pagWeb" type="text" value="<?php echo $pagWeb;?>" />
    </td>
    </tr>
    <tr>
    <td>
    grad:
    </td>  
    <td>
    <input name="grad" type="text" value="<?php echo $grad;?>" />
    </td>     
    </tr>
</table>
    <input type="submit" value="submit" />
</form>
</center>


<?php
}
}
?>