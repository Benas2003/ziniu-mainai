<?php

$klase=$_POST['dalykas2'];
$id=0;
$vardas;
$pavarde;

echo $klase;

$skaicius;
$MID;
$Mvardas;
$Mpavarde;
$Mpastas;

require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
$conn = new mysqli($servername, $username, $password, $dbname); 
$sql = "SELECT ID, Vardas, Pavarde, Klase FROM Mokytojai WHERE Klase='$klase'";
$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $vardas=$row["Vardas"];
        $pavarde=$row["Pavarde"];
        $id=$row["ID"];
        }
    } else {
    echo "0 results";
    }
$sql1 = "SELECT ID, Vardas, Pavarde, MokytojoID, MokinioEL, Statusas FROM Mokiniai WHERE MokytojoID ='$id' && Statusas='Aktyvi'";
$result = $conn->query($sql1);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    $skaicius++;
    $MID[$skaicius] = $row["ID"];
    $Mvardas[$skaicius] = $row["Vardas"];
    $Mpavarde[$skaicius] = $row["Pavarde"];
    $mokytojoID[$skaicius]=$row["MokytojoID"];
    $Mpastas[$skaicius] = $row["MokinioEL"];
    
    }
} else {
echo "0 results";
}

$sql2 = "SELECT ID, Vardas, Pavarde, MokytojoID, MokinioEL, Statusas FROM Mokiniai WHERE MokytojoID ='$id' && Statusas='Neaktyvi'";
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    $skaicius1++;
    $MID1[$skaicius1] = $row["ID"];
    $Mvardas1[$skaicius1] = $row["Vardas"];
    $Mpavarde1[$skaicius1] = $row["Pavarde"];
    $Mpastas1[$skaicius1] = $row["MokinioEL"];
    $mokytojoID1[$skaicius1]=$row["MokytojoID"];
    
    }
} else {
echo "0 results";
}

// Aktyvus
session_start();
$_SESSION['klase1'] = $skaicius;
$_SESSION['klase2'] = $Mvardas;
$_SESSION['klase3'] = $Mpavarde;
$_SESSION['klase4'] = $Mpastas;
$_SESSION['klase5'] = $MID;
$_SESSION['klase6'] = $vardas;
$_SESSION['klase7'] = $pavarde;
$_SESSION['klase8'] = $klase;

// Neaktyvus
session_start();
$_SESSION['klase9'] = $skaicius1;
$_SESSION['klase10'] = $MID1;
$_SESSION['klase11'] = $Mvardas1;
$_SESSION['klase12'] = $Mpavarde1;
$_SESSION['klase13'] = $Mpastas1;

session_start();
//Aktyvus mokytojas
$_SESSION['klase14'] = $mokytojoID;
//Neaktyvus mokytojas
$_SESSION['klase15'] = $mokytojoID1;


if($klase!="Pasirinkite klasę / srautą"){
header("Location: Administratorius.php?OK=success?f=success");
} else{
    header("Location: Administratorius.php?OK=success?filter=success");
}
$conn->close();
?>