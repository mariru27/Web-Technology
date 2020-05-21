<?php

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
            if(mysqli_num_rows($resultAnunturi))
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
                    <li style = \"margin-top:2cm;\">");
                    if(isLogged())
                    {
                    print("
                    <a id = \"a\" href=".$myRoot."'/Universitate/Anunturi.php?actiune=sterge&idAC=".$rowAnunturi['idAC']."&idAnunt=".$rowAnunturi['idAnunt'] ."'>Delete</a>
                    <br><a id = \"a\" href=".$myRoot."'/Universitate/Admin/editAnunt.php?idAC=".$rowAnunturi['idAC']."&idAnunt=".$rowAnunturi['idAnunt'] ."'>Edit</a>");
                    }
                    print("<p style =\"color:#029907;\">"
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


function afiseazaOptiunileDeAnunturi($categorie = 1)
{
    global $id_conexiune;

    $result = mysqli_query($id_conexiune, "SELECT * FROM categorii;");
    if($result)
    {
        print("<select  name = \"categorie\">");
        while($row = mysqli_fetch_array($result))
        {
            if($categorie == $row['idCategorie'])
                print("<option value =".$row['idCategorie']." selected>".$row['denumire']."</option>");
            else            
                print("<option value =".$row['idCategorie'].">".$row['denumire']."</option>");
           
            
        }
        print("</select>");

    }
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



function checkEmail($email) {
    $find1 = strpos($email, '@');
    $find2 = strpos($email, '.');
    return ($find1 !== false && $find2 !== false && $find2 > $find1);
 }
?>