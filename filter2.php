<?php

$skaicius=0;
$klase;

require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
$conn = new mysqli($servername, $username, $password, $dbname); 
$sql = "SELECT Klase FROM Mokytojai WHERE Statusas='Aktyvi'";
$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        // Užklausimų duomenų surašymas į masyvus
        $skaicius++;
        $klase[$skaicius]=$row["Klase"];
        }
    } else {
    echo "0 results";
    }
natsort($klase);

session_start();
$_SESSION['skaicius4'] = $skaicius;
$_SESSION['klases'] = $klase;
header("Location: Administratorius.php?OK=success?filter=success");
$conn->close();
?>