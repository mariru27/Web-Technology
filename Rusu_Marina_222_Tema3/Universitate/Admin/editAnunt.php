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
    if($actiune == 'edit')
    {
        global $id_conexiune;
    
        $categorie_id = $_REQUEST['categorie'];
        $denumire = $_REQUEST['denumire'];
        $continut = $_REQUEST['continut'];
        $idAnunt = $_REQUEST['idAnunt'];
        $idAC = $_REQUEST['idAC'];

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
            
            $queryEditAnunt = sprintf("UPDATE anunturi SET denumire = '%s', continut = '%s', dataPostarii = CURDATE() WHERE idAnunt = '%d'", 
            mysqli_real_escape_string($id_conexiune, $denumire),
            mysqli_real_escape_string($id_conexiune, $continut), $idAnunt);

            mysqli_query($id_conexiune, $queryEditAnunt);


            $queryEditCategorie = sprintf("UPDATE anunturicategorii SET idCategorie = '%d' WHERE idAC = '%d'", $categorie_id, $idAC);
            mysqli_query($id_conexiune, $queryEditCategorie);
            print("<H3>Anuntul a fost modificat cu succes</H3>");
            $continut = $denumire = "";

        }



    }
    ?>
</head>
<body>

<H1>Editeaza Anunt<H1>
<H2>Categorie:
<form action="editAnunt.php" method="POST">
<input type="hidden" name="actiune" value="edit">
<?php
    global $id_conexiune;
    $idAnunt = $_REQUEST['idAnunt'];
    $idAC = $_REQUEST['idAC'];
    
    $query = sprintf("SELECT * FROM anunturi WHERE idAnunt = '%d';", $idAnunt);
    $result = mysqli_query($id_conexiune, $query);

    $queryCategorii = sprintf("SELECT categorii.denumire, categorii.idCategorie FROM anunturicategorii
    INNER JOIN categorii
    ON anunturicategorii.idCategorie = categorii.idCategorie
    WHERE anunturicategorii.idAC = '%d';", $idAC);
    $resultCategorie = mysqli_query($id_conexiune, $queryCategorii);

    if($result)
    {
        if($resultCategorie)
        {
            $categorie_row = mysqli_fetch_array($resultCategorie);
            afiseazaOptiunileDeAnunturi($categorie_row['idCategorie']);
        }
        $row = mysqli_fetch_array($result);
   
    print("</H2>");
    ?>
<input type = "hidden" name = "idAnunt" value =<?php echo $idAnunt?>>
<input type = "hidden" name = "idAC" value =<?php echo $idAC?>>
<H2>Denumire:</H2>
<input style = "margin-left:0.5cm;" name = "denumire" value = "<?php echo htmlspecialchars($row['denumire']);?>">
<span id = "eroare"><?php echo $denumireEroare; ?></span>
<H2>Continut:</H2>
<textarea id="continut" name = "continut" rows="15" cols="150">
<?php echo htmlspecialchars($row['continut']);?>
</textarea>
<span id = "eroare"><?php echo $continutEroare; ?></span>
<br>
<input style = "width:4.5cm;margin-left:0.5cm;margin-bottom:5cm;"type = "submit" value = "Submite">
<form>

<?php 
    }
}
?>
        </body>
</html>