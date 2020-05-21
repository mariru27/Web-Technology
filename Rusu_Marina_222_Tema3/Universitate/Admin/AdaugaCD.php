
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
    
    $actiune = isset($_REQUEST['actiune'])? $_REQUEST['actiune']:"";
    switch($actiune)
    {
        case 'adauga':
        {
            global $id_conexiune;
    
            $valid = true;
            $nume = $_REQUEST['nume'];
            $mail = $_REQUEST['mail'];
            $telefon = $_REQUEST['telefon'];
            $fax = $_REQUEST['fax']; 
            $pagWeb = $_REQUEST['pagWeb'];
            $grad = $_REQUEST['grad'];
        
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
                    $telefonEroare ="Nu este un numar de telefon invalid, contine litere sau un numar prea mic de cifre(mai mic decat 5)";   
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
                    $faxEroare ="Nu este un numar de fax invalid, contine litere sau un numar prea mic de cifre(mai mic decat 5)";   
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
        
        
            if($valid)
            {
                $addQuery = sprintf("INSERT INTO profesor(nume,mail,telefon,fax,pagWeb,grad)
                VALUES ('%s','%s','%s','%s','%s','%s');",
                mysqli_real_escape_string($id_conexiune, $nume),
                mysqli_real_escape_string($id_conexiune, $mail),
                mysqli_real_escape_string($id_conexiune, $telefon),
                mysqli_real_escape_string($id_conexiune, $fax),
                mysqli_real_escape_string($id_conexiune, $pagWeb),
                mysqli_real_escape_string($id_conexiune, $grad));
                mysqli_query($id_conexiune, $addQuery);
                print("<H3>Cadru didactic adaugat cu succes</H3>");
                $nume = $mail = $telefon = $fax = $pagWeb = $grad = "";
            }

        }
        break;
    }


    ?>
</head>
<body>

<link rel="stylesheet" href="../Styles/adminCD.css">
<H1>Adauga Cadru Didactic</H1>
    <form action="AdaugaCD.php" method="GET">
    <input name="actiune" type="hidden" value="adauga" />
    <table id = "tab">
    <tr>
    <td>
        Nume:
    </td>
    <td>
        <input name="nume" type="text" value="<?php echo htmlspecialchars($nume); ?>" />
        <span id = "eroare"><?php echo $numeEroare; ?></span>
    </td>
    </tr>
    <tr>
    <td>
    Mail:
    </td>
    <td>
         <input name="mail" type="text" value="<?php echo htmlspecialchars($mail); ?>"/>
         <span id = "eroare"><?php echo $mailEroare; ?></span>

    </td>
    </tr>
    <tr>
    <td>
    Telefon:
    </td>
    <td>
        <input name="telefon" type="text" value="<?php echo htmlspecialchars($telefon); ?>"/>
        <span id = "eroare"><?php echo $telefonEroare; ?></span>
    </td>
    </tr>
    <tr>
    <td>
    Fax:
    </td>
    <td>
        <input name="fax" type="text" value="<?php echo htmlspecialchars($fax); ?>"/>
        <span id = "eroare"><?php echo $faxEroare; ?></span>
    </td>
    </tr>
    <tr>
    <td>
    pagWeb*:
    </td>
    <td>
        <input name="pagWeb" type="text" value="<?php echo htmlspecialchars($pagWeb); ?>"/>
        <span id = "eroare"><?php echo $pagWebEroare; ?></span>
    </td>
    </tr>
    <tr>
    <td>
    grad:
    </td>  
    <td>
        <input name="grad" type="text" value="<?php echo htmlspecialchars($grad); ?>"/>
        <span id = "eroare"><?php echo $gradEroare; ?></span>
    </td>     
    </tr>
</table>
<input style = "height:1cm;width: 20cm;  background-color: darkgreen;" type="submit" value="Adauga">
</form>

<?php
}
?>
        </body>
</html>