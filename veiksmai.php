<?php
    // Iš formos gaunami duomenys
    $id=0;

    // Iš formos gaunami duomenys
    $vardas=$_POST['vr'];
    $pavarde=$_POST['pv'];
    $slaptazodis=$_POST['slp'];
    $klase=$_POST['kl'];
    $mokinioEL=$_POST['mokinio_pastas'];
    $mokytojoEL=$_POST['Mel'];

    // Iš formos gaunami duomenys
    $veiksmas=$_POST['su'];
    
    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    $slaptazodis = strtolower($slaptazodis);
    
    // Prisijungiama prie duomenų bazės
    $conn = new mysqli($servername, $username, $password, $dbname); 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } echo "Connected successfully";

    if($veiksmas=="1" && $vardas!="" && $pavarde!="" && $slaptazodis!="")
    {
        $sql1 = "SELECT ID, Klase FROM Mokytojai WHERE Klase ='$klase'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id=$row['ID'];
            }
        } 
        else {
        echo "0 results";
        }
        
    
            $sql = "INSERT INTO Mokiniai (Vardas, Pavarde, MokytojoID, MokinioEL, Slaptazodis, Statusas) VALUES ('$vardas', '$pavarde', '$id', '$mokinioEL', '$slaptazodis', 'Neaktyvi');";
            if ($conn->multi_query($sql) === TRUE) {
                echo "New records created successfully";
                header("Location: Administratorius.php?OK=success?q=1");
            } else {
                header("Location: Administratorius.php?OK=success?q=2");
            }
    }
    else if($veiksmas=="2" && $vardas!="" && $pavarde!="" && $mokytojoEL!="" && $klase!="")
    {
        $sql2 = "INSERT INTO Mokytojai (Vardas, Pavarde, Pastas, Klase, Statusas) VALUES ('$vardas', '$pavarde', '$mokytojoEL', '$klase', 'Aktyvi');";
            if ($conn->multi_query($sql2) === TRUE) {
                echo "New records created successfully";
                header("Location: Administratorius.php?OK=success?q=1");
            } else {
                header("Location: Administratorius.php?OK=success?q=2");
            }
    }
    else{
        header("Location: Administratorius.php?OK=success?q=9");
    }
    
    $conn->close();
?>