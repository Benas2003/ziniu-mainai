<?php
$klase;
$klase1;
$klase2;
// Gaunami perduodami duomenys
session_start();
$mokytojoID=$_SESSION['kl'];
$sukure=$_SESSION['slpa'];
$mokinioID=$_SESSION['mokinioID'];
// Iš formos gaunami duomenys
$tema=$_POST['tema'];
$dalykas=$_POST['dalykas'];

// Prisijungiama prie duomenų bazės
require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
$senas = $tema;
$tema = preg_replace('~[^\p{Cyrillic}a-z_ą-ž_ä-ü_à-ÿ_+_#_._"_ _,_0-9_\s-]+~ui','', $tema);

echo $tema;
echo "<br>";
echo $senas;
if($senas!=$tema)
{
    header("Location: Index.php?status=success?created=characters");
}
else if($dalykas=="Pasirinkite dalyką" || $dalykas=="" || $dalykas==" ")
{
    header("Location: Index.php?status=success?created=fail");
}
else if($tema=="" || $tema==" ")
{
    header("Location: Index.php?status=success?created=fail");
}
else{
    $conn = new mysqli($servername, $username, $password, $dbname); 
    // Naujo užklausimo sukūrimas
    $sql = "SELECT ID, Klase FROM Mokytojai WHERE ID='$mokytojoID'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $klase=$row['Klase'];
    }
    } else {
    echo "0 results";
    }
    preg_match("/([0-9]+)/", $klase, $klase1);
    $klase2 = $klase1[1];
    echo $klase2;

    date_default_timezone_set("Europe/Vilnius");
    $date=date("Y-m-d");

    if($tema!=" " && $dalykas!=" ")
    {
        $sql = "INSERT INTO Uzklausimai (Klase, Tema, Dalykas, SukureID, Iraso_data, Statusas) VALUES ('$klase2', '$tema', '$dalykas', '$mokinioID', '$date', 'Aktyvus');";
        if ($conn->multi_query($sql) === TRUE) {
           	header("Location: Index.php?status=success?created=success");
            echo "New records created successfully";
        } else {
            header("Location: Index.php?status=success?created=fail");
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else{
        header("Location: Index.php?status=success?created=fail");
    }
    $conn->close();
}
?>