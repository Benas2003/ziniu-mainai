<?php
    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    // Iš formos gaunami prisijungimo duomenys
    $elpastas=$_POST['pastas1'];
    $slaptazodis=$_POST['slap1'];

    $elpastas = trim($elpastas," '|', '+', '*', '/', ';', ','");
    $slaptazodis = trim($slaptazodis," '|', '+', '*', '/', '-', ';', ','");
    $slaptazodis = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $slaptazodis);

    // Prisijungiama prie duomenų bazės
    $conn = new mysqli($servername, $username, $password, $dbname); 
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} echo "Connected successfully";
    // Tikrinama pagal suvestus duomenis yra toks administratorius
    $sql = "SELECT Elpastas, Slaptazodis FROM Administratoriai WHERE Elpastas='$elpastas' && Slaptazodis='$slaptazodis'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    // Jei taip duomenys grąžinami ir yra įkeliama administratoriaus panelė
    // Duomenų perdavimas
    session_start();
    $_SESSION['adminoEL']=$elpastas;
    $_SESSION['adminoSLP']=$slaptazodis;
    
    while($row = $result->fetch_assoc()) {
        // Grįžtama į administratoriaus panelę
        header("Location: Administratorius.php?OK=success");
    }
    } else {
    // Jei ne programa meta alertą
    // Grįžtama į prisijungimo formą
    echo "Error: " . $sql . "<br>" . $conn->error;
    header("Location: Prisijungimas.php?OK=fail");
    }
    
    $conn->close();
?>