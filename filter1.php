<?php

$dalykas=$_POST['dalykas1'];
$bukle=$_POST['bukle'];

session_start();
$_SESSION['dalykai']=$dalykas;
$_SESSION['bukles']=$bukle;
$skaicius=0;
$ID;
$subject;
$theme;
$status;
$created_by;

require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
$conn = new mysqli($servername, $username, $password, $dbname); 

if($bukle=="1" && $dalykas=="1")
{
    //echo "1";
    $sql = "SELECT ID, Tema, Dalykas, SukureID, Statusas FROM Uzklausimai";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        // Užklausimų duomenų surašymas į masyvus
        $skaicius++;
        $ID[$skaicius]=$row['ID'];
        $theme[$skaicius]=$row['Tema'];
        $subject[$skaicius]=$row['Dalykas'];
        $created_by[$skaicius]=$row['SukureID'];
        $status[$skaicius]=$row['Statusas'];
        }
    } else {
    echo "0 results";
    }
}
else if($bukle=="1" && $dalykas!="1")
{
    //echo "2";
    $sql = "SELECT ID, Tema, Dalykas, SukureID, Statusas FROM Uzklausimai WHERE Dalykas='$dalykas'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        // Užklausimų duomenų surašymas į masyvus
        $skaicius++;
        $ID[$skaicius]=$row['ID'];
        $theme[$skaicius]=$row['Tema'];
        $subject[$skaicius]=$row['Dalykas'];
        $created_by[$skaicius]=$row['SukureID'];
        $status[$skaicius]=$row['Statusas'];
        }
    } else {
    echo "0 results";
    }
}
else if($dalykas=="1" && $bukle!="1")
{
    //echo "3";
    $sql = "SELECT ID, Tema, Dalykas, SukureID, Statusas FROM Uzklausimai WHERE Statusas='$bukle'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        // Užklausimų duomenų surašymas į masyvus
        $skaicius++;
        $ID[$skaicius]=$row['ID'];
        $theme[$skaicius]=$row['Tema'];
        $subject[$skaicius]=$row['Dalykas'];
        $created_by[$skaicius]=$row['SukūrėID'];
        $status[$skaicius]=$row['Statusas'];
        }
    } else {
    echo "0 results";
    }
}
else 
{
    //echo "4";
    $sql = "SELECT ID, Tema, Dalykas, SukureID, Statusas FROM Uzklausimai WHERE Dalykas='$dalykas' && Statusas='$bukle'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        // Užklausimų duomenų surašymas į masyvus
        $skaicius++;
        $ID[$skaicius]=$row['ID'];
        $theme[$skaicius]=$row['Tema'];
        $subject[$skaicius]=$row['Dalykas'];
        $created_by[$skaicius]=$row['SukūrėID'];
        $status[$skaicius]=$row['Statusas'];
        }
    } else {
    echo "0 results";
    }
}

session_start();
$_SESSION['question']=$skaicius;
$_SESSION['question1']=$ID;
$_SESSION['question2']=$theme;
$_SESSION['question3']=$subject;
$_SESSION['question4']=$created_by;
$_SESSION['question5']=$status;
header("Location: Administratorius.php?OK=success?filtered=success");
$conn->close();
?>