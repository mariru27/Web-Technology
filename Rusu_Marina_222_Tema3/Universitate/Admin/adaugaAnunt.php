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
    
    if($actiune == 'adauga')
    {
        global $id_conexiune;
    
        $categorie_id = $_REQUEST['categorie'];
        $denumire = $_REQUEST['denumire'];
        $continut = $_REQUEST['continut'];
        
        $valid = true;

        if(empty($denumire))
        {
            $valid = false;
            $denumireEroare = "Campul denumire trebuie completat";
        }
        else
        {
            if(strlen($denumire) < 1)
            {
                $valid = false;
                $gradEroare = "Contine prea putine caractere";   
            }
        }
        if(empty($continut))
        {
            $valid = false;
            $continutEroare = "Campul continut trebuie completat";
        }

        if($valid == true)
        {
            $queryAddAnunt = sprintf("INSERT INTO anunturi(denumire,continut,dataPostarii)
            VALUES ('%s','%s',CURDATE());
            ",mysqli_real_escape_string($id_conexiune, $denumire),
              mysqli_real_escape_string($id_conexiune, $continut));
            mysqli_query($id_conexiune, $queryAddAnunt);
            $last_id_Anunt = mysqli_insert_id($id_conexiune);
        
            $queryAddAC = sprintf("INSERT INTO anunturicategorii(idAnunt ,idCategorie)
            VALUES ('%d', '%d');",$last_id_Anunt, $categorie_id);    
            mysqli_query($id_conexiune, $queryAddAC);
            print("<H3>Anuntul a fost adaugat cu succes</H3>");
            $continut = $denumire = "";
            $categorie_id = 1;

        }
    }
    ?>
</head>
<body>

<H1>Adauga Anunt<H1>

<H2>Categorie:
<form action="adaugaAnunt.php" method="POST">
<input type="hidden" name="actiune" value="adauga">
<?php
afiseazaOptiunileDeAnunturi($categorie_id);
print("</H2>");
?>
<H2>Denumire:</H2>
<input style = "margin-left:0.5cm;" name = "denumire" value="<?php echo htmlspecialchars($denumire); ?>">
<span id = "eroare"><?php echo $denumireEroare; ?></span>
<H2>Continut:</H2>
<textarea id="continut" name = "continut" rows="15" cols="150">
<?php echo htmlspecialchars($continut); ?>
</textarea>
<span id = "eroare"><?php echo $continutEroare; ?></span>
<br>
<input style = "width:4.5cm;margin-left:0.5cm;margin-bottom:5cm;"type = "submit" value = "Adauga">
</form>
<?php 
}
?>
        
        </body>
</html>