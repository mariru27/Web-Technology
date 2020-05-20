
<?php
session_start();
include_once    "../admin/admin-functions.php";

include_once   "headerAdmin.php";
if(isLogged())
{
?>
<link rel="stylesheet" href="../Styles/adminCD.css">
<center>
<H1>Adauga Cadru Didactic</H1>
    <form action="../cadreDidactice.php" method="POST">
    <input name="actiune" type="hidden" value="adauga" />
    <table id = "tab">
    <tr>
    <td>
        Nume:
    </td>
    <td>
        <input name="nume" type="text" />
    </td>
    </tr>
    <tr>
    <td>
    Mail:
    </td>
    <td>
    <input name="mail" type="text"/>
    </td>
    </tr>
    <tr>
    <td>
    Telefon:
    </td>
    <td>
    <input name="telefon" type="text"/>
    </td>
    </tr>
    <tr>
    <td>
    Fax:
    </td>
    <td>
    <input name="fax" type="text"/>
    </td>
    </tr>
    <tr>
    <td>
    pagWeb:
    </td>
    <td>
    <input name="pagWeb" type="text"/>
    </td>
    </tr>
    <tr>
    <td>
    grad:
    </td>  
    <td>
    <input name="grad" type="text"/>
    </td>     
    </tr>
</table>
<input type="submit" value="Adauga">
</form>
</center>

<?php
}
?>