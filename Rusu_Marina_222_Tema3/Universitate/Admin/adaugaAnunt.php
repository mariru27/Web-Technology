<?php
session_start();
include_once    "../admin/admin-functions.php";
include_once   "headerAdmin.php";
if(isLogged())
{


?>
<H1>Adauga Anunt<H1>
<H2>Categorie:
<form action="../Anunturi.php" method="POST">
<input type="hidden" name="actiune" value="adauga">
<?php
afiseazaOptiunileDeAnunturi();
print("</H2>");
?>
<H2>Denumire*:</H2>
<input style = "margin-left:0.5cm;" name = "denumire">
<H2>Continut:</H2>
<input style = "margin-left:0.5cm;width:20cm; height:7cm; margin-bottom:0.5cm;font-size:20px;" name = "continut">
<br>
<input style = "width:4.5cm;margin-left:0.5cm;margin-bottom:5cm;"type = "submit" value = "Adauga">
<form>
<?php 
}
?>