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
    
    ?>
</head>
<body>

<H1>Editeaza Anunt<H1>
<H2>Categorie:
<form action="../Anunturi.php" method="POST">
<input type="hidden" name="actiune" value="edit">
<?php
    global $id_conexiune;
    $idAnunt = $_REQUEST['idAnunt'];
    $idAC = $_REQUEST['idAC'];
    
    $query = sprintf("SELECT * FROM anunturi WHERE idAnunt = '%d';", $idAnunt);
    $result = mysqli_query($id_conexiune, $query);

    $queryCategorii = sprintf("SELECT categorii.denumire FROM anunturicategorii
    INNER JOIN categorii
    ON anunturicategorii.idCategorie = categorii.idCategorie
    WHERE anunturicategorii.idAC = '%d';", $idAC);
    $resultCategorie = mysqli_query($id_conexiune, $queryCategorii);

    if($result)
    {
        if($resultCategorie)
        {
            $categorie_row = mysqli_fetch_array($resultCategorie);
            afiseazaOptiunileDeAnunturi($categorie_row['denumire']);
        }
        $row = mysqli_fetch_array($result);
   
    print("</H2>");
    ?>
<input type = "hidden" name = "idAnunt" value =<?php echo $idAnunt?>>
<input type = "hidden" name = "idAC" value =<?php echo $idAC?>>
<H2>Denumire:</H2>
<input style = "margin-left:0.5cm;" name = "denumire" value = "<?php echo $row['denumire'];?>">
<H2>Continut:</H2>
<input style = "margin-left:0.5cm;width:20cm; height:7cm; margin-bottom:0.5cm;font-size:20px;" name = "continut" value = "<?php echo $row['continut'];?>">
<br>
<input style = "width:4.5cm;margin-left:0.5cm;margin-bottom:5cm;"type = "submit" value = "Submite">
<form>

<?php 
    }
}
?>
        </body>
</html>