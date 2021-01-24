<?php

    $mokytojoID=$_POST['teacher_ID'];
    $action=$_POST['teacher_action'];

    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    $conn = new mysqli($servername, $username, $password, $dbname); 
    
    if($action=="1")
    {
        $sql = "UPDATE Mokytojai SET Statusas='Neaktyvi' WHERE ID='$mokytojoID'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            
         } else {
            echo "Error updating record: " . $conn->error;
            
         }
         header("Location: Administratorius.php?OK=success");
         $sql1 = "SELECT ID, Vardas, Pavarde, Pastas, Klase, Statusas FROM Mokytojai";
         $result = $conn->query($sql1);
         if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
             $skaicius1++;
             $id1[$skaicius1]=$row['ID'];
             $vardas1[$skaicius1]=$row['Vardas'];
             $pavarde1[$skaicius1]=$row['Pavarde'];
             $emailas1[$skaicius1]=$row['Pastas'];
             $klase1[$skaicius1]=$row['Klase'];
             $statusas1[$skaicius1]=$row['Statusas'];
             }
         } else {
         echo "0 results";
         }
         echo $skaicius;
         session_start();
         $_SESSION['teacher1']=$skaicius1;
         $_SESSION['teacher2']=$id1;
         $_SESSION['teacher3']=$vardas1;
         $_SESSION['teacher4']=$pavarde1;
         $_SESSION['teacher5']=$emailas1;
         $_SESSION['teacher6']=$klase1;
         $_SESSION['teacher7']=$statusas1;
         header("Location: Administratorius.php?OK=success/teachers/success");
    }
    if($action=="2")
    {
        $sql = "UPDATE Mokytojai SET Statusas='Aktyvi' WHERE ID='$mokytojoID'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            
         } else {
            echo "Error updating record: " . $conn->error;
            
         }
         header("Location: Administratorius.php?OK=success");
         $sql1 = "SELECT ID, Vardas, Pavarde, Pastas, Klase, Statusas FROM Mokytojai";
         $result = $conn->query($sql1);
         if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
             $skaicius1++;
             $id1[$skaicius1]=$row['ID'];
             $vardas1[$skaicius1]=$row['Vardas'];
             $pavarde1[$skaicius1]=$row['Pavarde'];
             $emailas1[$skaicius1]=$row['Pastas'];
             $klase1[$skaicius1]=$row['Klase'];
             $statusas1[$skaicius1]=$row['Statusas'];
             }
         } else {
         echo "0 results";
         }
         echo $skaicius;
         session_start();
         $_SESSION['teacher1']=$skaicius1;
         $_SESSION['teacher2']=$id1;
         $_SESSION['teacher3']=$vardas1;
         $_SESSION['teacher4']=$pavarde1;
         $_SESSION['teacher5']=$emailas1;
         $_SESSION['teacher6']=$klase1;
         $_SESSION['teacher7']=$statusas1;
         header("Location: Administratorius.php?OK=success/teachers/success");
    }
    if($action=="3")
    {
        $sql = "SELECT ID, Vardas, Pavarde, Pastas, Klase, Statusas FROM Mokytojai WHERE ID='$mokytojoID'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $id=$row['ID'];
            $vardas=$row['Vardas'];
            $pavarde=$row['Pavarde'];
            $emailas=$row['Pastas'];
            $klase=$row['Klase'];
            header("Location: Administratorius.php?OK=success/teachers_action");
            }
        } else {
        echo "0 results";
        header("Location: Administratorius.php?OK=success/teachers/false");
        }
        session_start();
        $_SESSION['teacher8']=$id;
        $_SESSION['teacher9']=$vardas;
        $_SESSION['teacher10']=$pavarde;
        $_SESSION['teacher11']=$emailas;
        $_SESSION['teacher12']=$klase;
    }
    if($action=="4")
    {
        $mokytojoID=$_POST['identity'];
        $vardas=$_POST['vk'];
        $pavarde=$_POST['pv'];
        $emailas=$_POST['mail'];
        $klase=$_POST['kl'];
        $sql = "UPDATE Mokytojai SET Vardas='$vardas', Pavarde='$pavarde', Pastas='$emailas', Klase='$klase' WHERE ID='$mokytojoID'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            
         } else {
            echo "Error updating record: " . $conn->error;
            
        }
        $sql1 = "SELECT ID, Vardas, Pavarde, Pastas, Klase, Statusas FROM Mokytojai";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $skaicius1++;
            $id1[$skaicius1]=$row['ID'];
            $vardas1[$skaicius1]=$row['Vardas'];
            $pavarde1[$skaicius1]=$row['Pavarde'];
            $emailas1[$skaicius1]=$row['Pastas'];
            $klase1[$skaicius1]=$row['Klase'];
            $statusas1[$skaicius1]=$row['Statusas'];
            }
        } else {
        echo "0 results";
        }
        echo $skaicius;
        session_start();
        $_SESSION['teacher1']=$skaicius1;
        $_SESSION['teacher2']=$id1;
        $_SESSION['teacher3']=$vardas1;
        $_SESSION['teacher4']=$pavarde1;
        $_SESSION['teacher5']=$emailas1;
        $_SESSION['teacher6']=$klase1;
        $_SESSION['teacher7']=$statusas1;
        header("Location: Administratorius.php?OK=success/teachers/success");
    }

?>