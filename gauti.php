<?php
    // Gaunamas klasės numeris (5-10)
    $klase=$_POST['uz_klase'];
    // Vietiniai parametrai
    $skaicius1=0;
    $temos1;
    $dalykai1;

    echo $klase;

    // Prisijungiama prie duomenų bazės
    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    $conn = new mysqli($servername, $username, $password, $dbname); 
    // Ieškoma vartotojų sukurtų užklausimų pagal gautą klasės numerį
    $sql = "SELECT ID, Tema, Dalykas, SukureID, Statusas FROM Uzklausimai WHERE Klase='$klase' && Statusas='Aktyvus'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        // Užklausimų duomenų surašymas į masyvus
        $skaicius1++;
        $temos1[$skaicius1]=$row["Tema"];
        $dalykai1[$skaicius1]=$row["Dalykas"];
        $ID[$skaicius1]=$row["ID"];
        $sukure[$skaicius1]=$row["SukureID"];
        }
    } else {
    echo "0 results";
    }
    // Užklausimų masyvų perdavimas
    session_start();
    $_SESSION['sk1']=$skaicius1;
    $_SESSION['temos1']=$temos1;
    $_SESSION['dalykai1']=$dalykai1;
    $_SESSION['ID2']=$ID;
    $_SESSION['sukure']=$sukure;
    $conn->close();

    // Grįžtama į Index.php aplinką
    header("Location: Index.php?status=success?request=success");
?>