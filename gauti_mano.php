<?php
    // Gaunamas mokinio ID
    session_start();
    $mokinioID=$_SESSION['mokinioID'];
    // Vietiniai parametrai
    $skaicius=0;
    $temos;
    $dalykai;
    $id;
    
    // Prisijungiama prie duomenų bazės
    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    $conn = new mysqli($servername, $username, $password, $dbname); 
    // Ieškoma vartotojo sukurtų užklausimų
    $sql = "SELECT ID, Tema, Dalykas, SukureID, Statusas FROM Uzklausimai WHERE SukureID='$mokinioID' && Statusas='Aktyvus'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        // Užklausimų duomenų surašymas į masyvus
        $skaicius++;
        $temos[$skaicius]=$row["Tema"];
        $dalykai[$skaicius]=$row["Dalykas"];
        $id[$skaicius]=$row["ID"];
        }
    } else {
    echo "0 results";
    }
    // Užklausimų masyvų perdavimas
    session_start();
    $_SESSION['sk']=$skaicius;
    $_SESSION['temos']=$temos;
    $_SESSION['dalykai']=$dalykai;
    $_SESSION['ID1']=$id;
    $conn->close();

// Grįžtama į Index.php aplinką
header("Location: Index.php?status=success?accepted=success");
?>