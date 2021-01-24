<?php
    $skaicius=0;
    
    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    $conn = new mysqli($servername, $username, $password, $dbname); 
    $sql = "SELECT ID, Vardas, Pavarde, Pastas, Klase, Statusas FROM Mokytojai";
    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $skaicius++;
            $id[$skaicius]=$row['ID'];
            $vardas[$skaicius]=$row['Vardas'];
            $pavarde[$skaicius]=$row['Pavarde'];
            $emailas[$skaicius]=$row['Pastas'];
            $klase[$skaicius]=$row['Klase'];
            $statusas[$skaicius]=$row['Statusas'];
            }
        } else {
        echo "0 results";
        }
    echo $skaicius;
    session_start();
    $_SESSION['teacher1']=$skaicius;
    $_SESSION['teacher2']=$id;
    $_SESSION['teacher3']=$vardas;
    $_SESSION['teacher4']=$pavarde;
    $_SESSION['teacher5']=$emailas;
    $_SESSION['teacher6']=$klase;
    $_SESSION['teacher7']=$statusas;

    header("Location: Administratorius.php?OK=success/teachers");
    $conn->close();
?>