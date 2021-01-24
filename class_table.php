<?php
    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    $action=$_POST['action'];
    $mokinioID=$_POST['inputas'];
    $mokytojoID=$_POST['inputas1'];
    
    $conn = new mysqli($servername, $username, $password, $dbname); 
    if($action == "1")
    {
        $sql = "UPDATE Mokiniai SET Statusas='Neaktyvi' WHERE ID='$mokinioID'";
        if ($conn->query($sql) === TRUE) {
           echo "Record updated successfully";
           //header("Location: Administratorius.php?OK=success?f=success1?q=7");   
        } else {
           echo "Error updating record: " . $conn->error;
           //header("Location: Administratorius.php?OK=success?f=success1?q=8");   
        }
    }
    else if($action == "2")
    {
	    echo "2";        
	    $sql1 = "SELECT ID, Vardas, Pavarde, MokytojoID, MokinioEL, Slaptazodis, Statusas FROM Mokiniai WHERE ID='$mokinioID'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0) {
         // output data of each row
        while($row = $result->fetch_assoc()) {
         $identification=$row["ID"];
	     $vardas=$row["Vardas"];
	     $pavarde=$row["Pavarde"];
         $mokytojoID=$row["MokytojoID"];
         $mokinioEL=$row["MokinioEL"];
         $slaptazodis=$row["Slaptazodis"];
         $statusas=$row["Statusas"];
        }
        } else {
        echo "0 results";
  
        }

        $sql2 = "SELECT ID, Klase FROM Mokytojai WHERE ID='$mokytojoID'";
        $result = $conn->query($sql2);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $klase=$row['Klase'];
            }
        }
         else {
        echo "0 results";
        }

        $sql3 = "SELECT ID, Klase FROM Mokytojai WHERE ID!='$mokytojoID'";
        $result = $conn->query($sql3);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $skaicius++;
                $klases[$skaicius] = $row['Klase'];
                header("Location: Administratorius.php?OK=success?q=3");
            }
        }
         else {
        echo "0 results";
        header("Location: Administratorius.php?OK=success?q=4");
        }
        natsort($klases);
    
        session_start();
        $_SESSION['first']=$identification;
        $_SESSION['second']=$vardas;
        $_SESSION['third']=$pavarde;
        $_SESSION['fourth']=$klase;
        $_SESSION['fifth']=$mokinioEL;
        $_SESSION['sixth']=$slaptazodis;
        $_SESSION['seventh']=$statusas;

        session_start();
        $_SESSION['eighth']=$skaicius;
        $_SESSION['ninth']=$klases;
    }
    else if ($action =="3")
    {
	    $mokinioID=$_POST['numeris'];
        $vardas=$_POST['vr'];
        $pavarde=$_POST['pv'];
        $klase=$_POST['dalykas3'];
        $mokinioEL=$_POST['mok'];
        $slaptazodis=$_POST['slp'];
        $statusas=$_POST['sta'];

        
        $sql4 = "SELECT ID,Vardas, Pavarde, Klase FROM Mokytojai WHERE Klase='$klase'";
        $result = $conn->query($sql4);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $mokytojoID=$row['ID'];
                $vardas1=$row["Vardas"];
                $pavarde1=$row["Pavarde"];
            }
        }
         else {
        echo "0 results";
        }
        /*echo $mokytojoID;
        echo $vardas1;
        echo $pavarde1;*/
        $sql5 = "UPDATE Mokiniai SET Vardas='$vardas', Pavarde='$pavarde', MokytojoID='$mokytojoID', MokinioEL='$mokinioEL', Slaptazodis='$slaptazodis', Statusas='$statusas' WHERE ID='$mokinioID'";
        if ($conn->query($sql5) === TRUE) {
            echo "Record updated successfully";
           // header("Location: Administratorius.php?OK=success?f=success1?q=5");           
         } else {
            echo "Error updating record: " . $conn->error;
            //header("Location: Administratorius.php?OK=success?f=success1?q=6");   
         }
    }
    else if($action=="4")
    {
        $sql7 = "UPDATE Mokiniai SET Statusas='Aktyvi' WHERE ID='$mokinioID'";
        if ($conn->query($sql7) === TRUE) {
           echo "Record updated successfully";
           //header("Location: Administratorius.php?OK=success?f=success1?q=5");           
        } else {
           echo "Error updating record: " . $conn->error;
           //header("Location: Administratorius.php?OK=success?f=success1?q=6");   
        }

    }
    if($action!="2")
    {
        //echo $mokytojoID;
        session_start();
        $_SESSION['teacher100']=$mokytojoID;
        header("Location: testas.php");        
    }
    $conn->close();
?>