<?php
session_start();
include_once    "../admin/admin-functions.php";

if(isLogged())
{

?>
<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" href="<?php  $_SERVER["DOCUMENT_ROOT"];?>/Universitate/Styles/adminCD.css">
        <?php

    include_once  $_SERVER["DOCUMENT_ROOT"] . "/Universitate/header.php";
    global $id_conexiune;
    $idProfesor = $_REQUEST['idProfesor'];
    $nume = $_REQUEST['nume'];
    $mail = $_REQUEST['mail'];
    $telefon = $_REQUEST['telefon'];
    $fax = $_REQUEST['fax']; 
    $pagWeb = $_REQUEST['pagWeb'];
    $grad = $_REQUEST['grad'];
    $actiune = isset($_REQUEST['actiune'])? $_REQUEST['actiune']:"";
    $valid = true;
    if($actiune == 'edit')
    {
        if(empty($nume))
        {
            $valid = false;
            $numeEroare = "Campul nume trebuie completat";
        }
        else
        {
            if (!preg_match("/^[a-zA-Z -]+$/",$nume) || strlen($nume) < 2){
                $valid = false;
                $numeEroare = "Nume invalid, contine si alte caractere nepermise sau are o lungime mai mica decat 1";
            }
        }
        if(empty($mail))
        {
            $valid = false;
            $mailEroare = "Campul mail trebuie completat";   
        }
        else
        {
            if(!checkEmail($mail))
            {
                $valid = false;
                $mailEroare = "Mailul nu este valid";
            }
        }
        if(empty($telefon))
        {
            $valid = false;
            $telefonEroare ="Campul telefon trebuie completat";   
        }
        else
        {
            if(!is_numeric($telefon) || strlen($telefon) <= 5)
            {               
                $valid = false;
                $telefonEroare ="Nu este un numar de telefon valid, contine litere sau un numar prea mic de cifre(mai mic decat 5)";   
            }
        }
        if(empty($fax))
        {
            $valid = false;
            $faxEroare = "Campul fax trebuie completat";   
        }else
        {
            if(!is_numeric($fax) || strlen($fax) <= 5)
            {               
                $valid = false;
                $faxEroare ="Nu este un numar de fax valid, contine litere sau un numar prea mic de cifre(mai mic decat 5)";   
            }
        }

        if(empty($grad))
        {
            $valid = false;
            $gradEroare = "Campul grad trebuie completat";   
        }
        else
        {
            if(strlen($grad) < 1)
            {
                $valid = false;
                $gradEroare = "Contine prea putine caractere";   
            }
        }

        if($valid == true)
        {
            $addQuery = sprintf("UPDATE profesor SET nume = '%s', mail = '%s', telefon = '%s', fax = '%s', pagWeb = '%s', grad = '%s' WHERE idProfesor = '%s'",
            mysqli_real_escape_string($id_conexiune, $nume),
            mysqli_real_escape_string($id_conexiune, $mail),
            mysqli_real_escape_string($id_conexiune, $telefon),
            mysqli_real_escape_string($id_conexiune, $fax),
            mysqli_real_escape_string($id_conexiune, $pagWeb),
            mysqli_real_escape_string($id_conexiune, $grad),
            mysqli_real_escape_string($id_conexiune, $idProfesor));
            mysqli_query($id_conexiune, $addQuery);
            print("<H3>Cadru didactic modificat cu succes</H3>");

        }


    }
    ?>
</head>
<body>

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

<H1>Edit Cadru Didactic</H1>
<form action="editCD.php" mhetod="POST">
    <input name="actiune" type="hidden" value="edit" />
    <table id = "tab">
        <tr>
        <input name="idProfesor" type="hidden" value="<?php echo $idProfesor; ?>" />
     
    <td>
        Nume:
    </td>
    <td>
        <input name="nume" type="text" value="<?php echo $nume;?>" />
        <span id = "eroare"><?php echo $numeEroare; ?></span>
    </td>
    </tr>
    <tr>
    <td>
    Mail:
    </td>
    <td>
    <input name="mail" type="text" value="<?php echo $mail;?>" />
    <span id = "eroare"><?php echo $mailEroare; ?></span>
    </td>
    </tr>
    <tr>
    <td>
    Telefon:
    </td>
    <td>
    <input name="telefon" type="text" value="<?php echo $telefon;?>" />
    <span id = "eroare"><?php echo $telefonEroare; ?></span>
    </td>
    </tr>
    <tr>
    <td>
    Fax:
    </td>
    <td>
    <input name="fax" type="text" value="<?php echo $fax;?>" />
    <span id = "eroare"><?php echo $faxEroare; ?></span>

    </td>
    </tr>
    <tr>
    <td>
    pagWeb:
    </td>
    <td>
    <input name="pagWeb" type="text" value="<?php echo $pagWeb;?>" />
    <span id = "eroare"><?php echo $pagWebEroare; ?></span>
    </td>
    </tr>
    <tr>
    <td>
    grad:
    </td>  
    <td>
    <input name="grad" type="text" value="<?php echo $grad;?>" />
    <span id = "eroare"><?php echo $gradEroare; ?></span>
    </td>     
    </tr>
</table>
    <input style = "height:1cm;width: 20cm;  background-color: darkgreen;" type="submit" value="submit" />
</form>


<?php
}
}
?>
        </body>
</html>