<?php
// session_start();
// require_once "../config.php";
$myRoot = $_SERVER["DOCUMENT_ROOT"];
include_once   $myRoot . "/Universitate/connect.php";

?>
<?php

function doLogin($user,$password)
{
    global $id_conexiune;

    $logat = FALSE;
    if(isLogged())
        doLogout();
    $sql = sprintf("SELECT * FROM admin WHERE user='%s' AND parola=md5('%s')",
            mysqli_real_escape_string($id_conexiune, $user),
            mysqli_real_escape_string($id_conexiune, $password));
    $result = mysqli_query($id_conexiune,$sql);
    if(!$result)
    {
        echo('Error: ' . mysqli_query($id_conexiune));
    }
    if($row = mysqli_fetch_array($result))
    {
        $logat = TRUE;
        $_SESSION['user'] = $user;
        $_SESSION['logat'] = TRUE;
    }
    return $logat;
    
}


function doLogout()
{
    session_destroy();
}

function isLogged()
{
    // <!-- isset — Determine if a variable is declared and is different than NULL -->
    return isset($_SESSION['logat']) && $_SESSION['logat'] == true;
}

function getLoggedUser()
{
    if(isset($_SESSION['user']))
    return $_SESSION['user'];
    else
    return NULL;
}



function AfiseazaCadreDidactice()
{
    global $id_conexiune;

    $query = sprintf("SELECT * FROM profesor");
    $result = mysqli_query($id_conexiune, $query);
    if(mysqli_num_rows($result))
    {
        while($row = mysqli_fetch_array($result))
        {
            if(isLogged())
            {
            print("<table id = \"mytable\">
            <tr>
            <td><a id = \"a\" href='". $myRoot . "/Universitate/cadreDidactice.php?actiune=delete&idProfesor=".$row['idProfesor']."'>Delete</a></td>
            <td><a id = \"a\" href='". $myRoot ."/Universitate/Admin/editCD.php?idProfesor=".$row['idProfesor']."'>Edit</a></td>
            </tr>
            </table>");
            }
            print("<table id = \"Ctable\">
            <tr>
                <th rowspan=\"3\" ><img src=".$myRoot. "/Universitate/Images/user.PNG></th>
                <td>Nume:<b>".$row['nume']."</b></td>
                <td>Telefon de serviciu: <b>" . $row["telefon"] . "</b></td>
            </tr>");
            print("<tr>
                <td >Grad: <b>Prof. Titlu:". $row['grad'] . "</b></td>
                <td>Fax de serviciu: <b>".$row['fax'] ."</b></td>
            </tr>");
            print("<tr>
            <td>Pagina web: <a href=\"".$row['pagWeb']."\">". $row['pagWeb'] ."</td>
            <td>E-mail: <b>".$row['mail']."</b></td>

            </tr>
            </table>");

        }
    }
    else
    {
        print("Agenda este goala");
    }
}

function stergeCadruDidactic($idCadruDidactic)
{
    global $id_conexiune;


    $query = sprintf("DELETE FROM profesor WHERE idProfesor='%d'", $idCadruDidactic);
    $result = mysqli_query($id_conexiune, $query);
}


function editCadruDidactic()
{
    global $id_conexiune;
    $idProfesor = $_REQUEST['idProfesor'];
    $nume = $_REQUEST['nume'];
    $mail = $_REQUEST['mail'];
    $telefon = $_REQUEST['telefon'];
    $fax = $_REQUEST['fax']; 
    $pagWeb = $_REQUEST['pagWeb'];
    $grad = $_REQUEST['grad'];

    $addQuery = sprintf("UPDATE profesor SET nume = '%s', mail = '%s', telefon = '%s', fax = '%s', pagWeb = '%s', grad = '%s' WHERE idProfesor = '%s'",
    mysqli_real_escape_string($id_conexiune, $nume),
    mysqli_real_escape_string($id_conexiune, $mail),
    mysqli_real_escape_string($id_conexiune, $telefon),
    mysqli_real_escape_string($id_conexiune, $fax),
    mysqli_real_escape_string($id_conexiune, $pagWeb),
    mysqli_real_escape_string($id_conexiune, $grad),
    mysqli_real_escape_string($id_conexiune, $idProfesor));
    mysqli_query($id_conexiune, $addQuery);
}

function adaugaCadreDidactice()
{
    global $id_conexiune;
    
    $nume = $_REQUEST['nume'];
    $mail = $_REQUEST['mail'];
    $telefon = $_REQUEST['telefon'];
    $fax = $_REQUEST['fax']; 
    $pagWeb = $_REQUEST['pagWeb'];
    $grad = $_REQUEST['grad'];

    $addQuery = sprintf("INSERT INTO profesor(nume,mail,telefon,fax,pagWeb,grad)
    VALUES ('%s','%s','%s','%s','%s','%s');",
    mysqli_real_escape_string($id_conexiune, $nume),
    mysqli_real_escape_string($id_conexiune, $mail),
    mysqli_real_escape_string($id_conexiune, $telefon),
    mysqli_real_escape_string($id_conexiune, $fax),
    mysqli_real_escape_string($id_conexiune, $pagWeb),
    mysqli_real_escape_string($id_conexiune, $grad));
    mysqli_query($id_conexiune, $addQuery);

}


function afiseazaAnunturi()
{
    global $id_conexiune;

    $query = "SELECT * FROM categorii;";
    $result = mysqli_query($id_conexiune, $query);
    if($result)
    {
        while($row = mysqli_fetch_array($result))
        {
            $queryAnunturi = sprintf("SELECT anunturi.denumire, anunturi.continut, anunturi.dataPostarii,anunturi.idAnunt,categorii.idCategorie,anunturicategorii.idAC FROM anunturicategorii
            INNER JOIN anunturi
            ON anunturicategorii.idAnunt = anunturi.idAnunt
            INNER JOIN categorii
            ON anunturicategorii.idCategorie = categorii.idCategorie
            WHERE categorii.denumire = '%s';",mysqli_real_escape_string($id_conexiune, $row['denumire']));
            $resultAnunturi = mysqli_query($id_conexiune, $queryAnunturi);
            if($resultAnunturi)
            {
                //categorie 
                print("<H1>Categorie Anunt:");
                print($row['denumire'] . "</H1><br>");
                while($rowAnunturi = mysqli_fetch_array($resultAnunturi))
                {
                    //lista anunturi
                    print("<ul>");
                    print("
                    <li style = \"margin-top:2cm;\">
                    <a id = \"a\" href=".$myRoot."'/Universitate/Anunturi.php?actiune=sterge&idAC=".$rowAnunturi['idAC']."&idAnunt=".$rowAnunturi['idAnunt'] ."'>Delete</a>
                    <br><a id = \"a\" href=".$myRoot."'/Universitate/Admin/editAnunt.php?idAC=".$rowAnunturi['idAC']."&idAnunt=".$rowAnunturi['idAnunt'] ."'>Edit</a>

                    <p style =\"color:#029907;\">"
                    . $rowAnunturi['denumire'] .
                    "<br>
                    Data publicarii: " . $rowAnunturi['dataPostarii'] . 
                    "</p>" . $rowAnunturi['continut'] .   
                    "</li>
                    ");
                    print("</ul>");
                }
            }
        }
    }
    else
    {
        echo "Nu mai sunt anunturi";
    }
}


function afiseazaOptiunileDeAnunturi($categorie = 'Stire')
{
    global $id_conexiune;

    $result = mysqli_query($id_conexiune, "SELECT * FROM categorii;");
    if($result)
    {
        print("<select  name = \"categorie\">");
        while($row = mysqli_fetch_array($result))
        {
            
            print("<option value =".$row['idCategorie'].">".$row['denumire']."</option>");
            
        }
        print("</select>");
    }
}

function adaugaAnunt()
{
    global $id_conexiune;
    
    $categorie_id = $_REQUEST['categorie'];
    $denumire = $_REQUEST['denumire'];
    $continut = $_REQUEST['continut'];

    $queryAddAnunt = sprintf("INSERT INTO anunturi(denumire,continut,dataPostarii)
    VALUES ('%s','%s',CURDATE());
    ",mysqli_real_escape_string($id_conexiune, $denumire),
      mysqli_real_escape_string($id_conexiune, $continut));
    mysqli_query($id_conexiune, $queryAddAnunt);
    $last_id_Anunt = mysqli_insert_id($id_conexiune);

    $queryAddAC = sprintf("INSERT INTO anunturicategorii(idAnunt ,idCategorie)
    VALUES ('%d', '%d');",$last_id_Anunt, $categorie_id);    
    mysqli_query($id_conexiune, $queryAddAC);
}

function stergeAnunt()
{
    global $id_conexiune;

    $idAC = $_REQUEST['idAC'];
    $idAnunt = $_REQUEST['idAnunt'];
    $queryStergeAC = sprintf("DELETE FROM anunturicategorii WHERE idAC='%d'",$idAC);
    mysqli_query($id_conexiune, $queryStergeAC);

    $query = sprintf("DELETE FROM anunturi WHERE idAnunt='%d'",$idAnunt);
    mysqli_query($id_conexiune, $query);
}



function editAnunt()
{
    global $id_conexiune;
    
    $categorie_id = $_REQUEST['categorie'];
    $denumire = $_REQUEST['denumire'];
    $continut = $_REQUEST['continut'];

    $idAnunt = $_REQUEST['idAnunt'];
    $idAC = $_REQUEST['idAC'];

    //am editat tot ce contine un anunt 
    $queryEditAnunt = sprintf("UPDATE anunturi SET denumire = '%s', continut = '%s', dataPostarii = CURDATE() WHERE idAnunt = '%d'", 
                    mysqli_real_escape_string($id_conexiune, $denumire),
                    mysqli_real_escape_string($id_conexiune, $continut), $idAnunt);

    mysqli_query($id_conexiune, $queryEditAnunt);


    $queryEditCategorie = sprintf("UPDATE anunturicategorii SET idCategorie = '%d' WHERE idAC = '%d'", $categorie_id, $idAC);
    mysqli_query($id_conexiune, $queryEditCategorie);

}

?>