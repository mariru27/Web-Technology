<?php
    // session_start();
    // include_once $_SERVER["DOCUMENT_ROOT"]. "/Universitate/connect.php";
    include $_SERVER["DOCUMENT_ROOT"] . "/Universitate/Admin/index.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="Styles/MyStyle.css">
        <?php
        include 'header.php';
        require_once 'connect.php';
        ?>
        <H1>Director de departament</H1>
        <hr>
    </head>
    <html>
        <div class="homeTable">
            <table>
                <tr>
                    <td rowspan="5"><img src="Images/StoianGabriel.PNG"></td>
                    <th><b>Lect. Dr. Stoian Gabriel</b></th>
                </tr>
                <tr>
                    <td>Telefon de serviciu: <b>+40-251-413-728</b></td>
                </tr>
                <tr>
                    <td>Fax de servici: <b>+40-251-412.673</b></td>
                </tr>
                <tr>
                    <td>E-mail: <b>gstoian@yahoo.com</b></td>
                </tr>
                <tr>
                    <td>Pagina web:<a href="http://inf.ucv.ro/~gstoian/">
                        http://inf.ucv.ro/~gstoian/</a></td>
                </tr>
            </table>
        </div>

        <H1>Consiliul Departamentului</H1>
        <div class="homeTable">
        <table>
            <tr>
                <td rowspan="5"><img src="Images/CNicolae.PNG"></td>
                <th><b>Conf. Dr. Constantinescu Nicolae</b></th>
            </tr>
            <tr>
                <td>Telefon de serviciu: <b> 0351403141</b></td>
            </tr>
            <tr>
                <td>Fax de servici: <b>0351403152</b></td>
            </tr>
            <tr>
                <td>E-mail: <b>nikyc@central.ucv.ro</b></td>
            </tr>
            <tr>
                <td>Pagina web:<a href="http://inf.ucv.ro/~nikyc/">
                    http://inf.ucv.ro/~nikyc/</a></td>
            </tr>
        </table>
        </div>

        <div class="homeTable">
        <table>
            <tr>
                <td rowspan="5"><img src="Images/GMihai.PNG"></td>
                <th><b>Lect. Dr. Gabroveanu Mihai/b></th>
            </tr>
            <tr>
                <td>Telefon de serviciu: <b>+40.251.413728</b></td>
            </tr>
            <tr>
                <td>Fax de servici: <b>-</b></td>
            </tr>
            <tr>
                <td>E-mail: <b>mihaiug@central.ucv.ro</b></td>
            </tr>
            <tr>
                <td>Pagina web:<a href="http://inf.ucv.ro/~mihaiug/">
                    http://inf.ucv.ro/~mihaiug/</a></td>
            </tr>
        </table>
        </div>

        <div class="homeTable">
        <table>
            <tr>
                <td rowspan="5"><img src="Images/StoianGabriel.PNG"></td>
                <th><b>Lect. Dr. Stoian Gabriel</b></th>
            </tr>
            <tr>
                <td>Telefon de serviciu: <b>+40-251-413-728</b></td>
            </tr>
            <tr>
                <td>Fax de servici: <b>+40-251-412.673</b></td>
            </tr>
            <tr>
                <td>E-mail: <b>gstoian@yahoo.com</b></td>
            </tr>
            <tr>
                <td>Pagina web:<a href="http://inf.ucv.ro/~gstoian/">
                    http://inf.ucv.ro/~gstoian/</a></td>
            </tr>
        </table>
        </div>
    </html>
</html>