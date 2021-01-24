<?php
    session_start();
    $ID=$_SESSION['teacher100'];
    
    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    $conn = new mysqli($servername, $username, $password, $dbname); 
    $sql10 = "SELECT ID, Vardas, Pavarde, Klase FROM Mokytojai WHERE ID ='$ID'";
    $result = $conn->query($sql10);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $teacher_name = $row['Vardas'];
        $teacher_lastname = $row['Pavarde'];
        $teacher_class = $row['Klase'];
        }
    } else {
    echo "0 results";
    }


    $sql8 = "SELECT ID, Vardas, Pavarde, MokytojoID, MokinioEL, Statusas FROM Mokiniai WHERE MokytojoID ='$ID' && Statusas='Aktyvi'";
    $result = $conn->query($sql8);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $active_skaicius++;
        $MID[$active_skaicius] = $row["ID"];
        $Mvardas[$active_skaicius] = $row["Vardas"];
        $Mpavarde[$active_skaicius] = $row["Pavarde"];
        $mokytojoID[$active_skaicius]=$row["MokytojoID"];
        $Mpastas[$active_skaicius] = $row["MokinioEL"];
        }
    } else {
    echo "0 results";
    }

    $sql9 = "SELECT ID, Vardas, Pavarde, MokytojoID, MokinioEL, Statusas FROM Mokiniai WHERE MokytojoID ='$ID' && Statusas='Neaktyvi'";
    $result = $conn->query($sql9);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $deactive_skaicius1++;
        $MID1[$deactive_skaicius1] = $row["ID"];
        $Mvardas1[$deactive_skaicius1] = $row["Vardas"];
        $Mpavarde1[$deactive_skaicius1] = $row["Pavarde"];
        $Mpastas1[$deactive_skaicius1] = $row["MokinioEL"];
        $mokytojoID1[$deactive_skaicius1]=$row["MokytojoID"];
        
        }
    } else {
    echo "0 results";
    }
    echo $deactive_skaicius1;
    // Aktyvus
    session_start();
    $_SESSION['klase1'] = $active_skaicius;
    $_SESSION['klase2'] = $Mvardas;
    $_SESSION['klase3'] = $Mpavarde;
    $_SESSION['klase4'] = $Mpastas;
    $_SESSION['klase5'] = $MID;
    $_SESSION['klase6'] = $teacher_name;
    $_SESSION['klase7'] = $teacher_lastname;
    $_SESSION['klase8'] = $teacher_class;

    // Neaktyvus
    session_start();
    $_SESSION['klase9'] = $deactive_skaicius1;
    $_SESSION['klase10'] = $MID1;
    $_SESSION['klase11'] = $Mvardas1;
    $_SESSION['klase12'] = $Mpavarde1;
    $_SESSION['klase13'] = $Mpastas1;

    session_start();
    //Aktyvus mokytojas
    $_SESSION['klase14'] = $mokytojoID;
    //Neaktyvus mokytojas
    $_SESSION['klase15'] = $mokytojoID1;

    header("Location: Administratorius.php?OK=success?f=success1?q=5");
    $conn->close();
?>