<?php
    $ID;
    $count=0;
    session_start();
    $dalykas=$_SESSION['dalykai'];
    $bukle=$_SESSION['bukles'];
    echo $dalykas;
    echo $bukle;

    if(isset($_POST['submit'])){
    if(!empty($_POST['check_list'])) {
    $checked_count = count($_POST['check_list']);
    foreach($_POST['check_list'] as $selected) {
    $count++;
    $ID[$count]=$selected;
    }
    }
    else{
    echo "<b>Please Select Atleast One Option.</b>";
    header("Location: Administratorius.php?OK=success?filtered=success?q=0");
    }
    }
    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    $conn = new mysqli($servername, $username, $password, $dbname); 
    //echo $count;
    for($i=1;$i<=$count;$i=$i+1)
    {
        //echo $ID[$i]. "<br>";
   
        $sql = "UPDATE Uzklausimai SET Statusas='Neaktyvus' WHERE ID='$ID[$i]'";
        if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        }
    }
    
    if($bukle=="1" && $dalykas=="1")
    {
        //echo "1";
        $sql1 = "SELECT ID, Tema, Dalykas, SukureID, Statusas FROM Uzklausimai";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            // Užklausimų duomenų surašymas į masyvus
            $skaicius++;
            $ID[$skaicius]=$row['ID'];
            $theme[$skaicius]=$row['Tema'];
            $subject[$skaicius]=$row['Dalykas'];
            $created_by[$skaicius]=$row['SukureID'];
            $status[$skaicius]=$row['Statusas'];
            }
        } else {
        echo "0 results";
        }
    }
    else if($bukle=="1" && $dalykas!="1")
    {
        //echo "2";
        $sql2 = "SELECT ID, Tema, Dalykas, SukureID, Statusas FROM Uzklausimai WHERE Dalykas='$dalykas'";
        $result = $conn->query($sql2);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            // Užklausimų duomenų surašymas į masyvus
            $skaicius++;
            $ID[$skaicius]=$row['ID'];
            $theme[$skaicius]=$row['Tema'];
            $subject[$skaicius]=$row['Dalykas'];
            $created_by[$skaicius]=$row['SukureID'];
            $status[$skaicius]=$row['Statusas'];
            }
        } else {
        echo "0 results";
        }
    }
    else if($dalykas=="1" && $bukle!="1")
    {
        //echo "3";
        $sql3 = "SELECT ID, Tema, Dalykas, SukureID, Statusas FROM Uzklausimai WHERE Statusas='$bukle'";
        $result = $conn->query($sql3);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            // Užklausimų duomenų surašymas į masyvus
            $skaicius++;
            $ID[$skaicius]=$row['ID'];
            $theme[$skaicius]=$row['Tema'];
            $subject[$skaicius]=$row['Dalykas'];
            $created_by[$skaicius]=$row['SukureID'];
            $status[$skaicius]=$row['Statusas'];
            }
        } else {
        echo "0 results";
        }
    }
    else 
    {
        //echo "4";
        $sql4 = "SELECT ID, Tema, Dalykas, SukureID, Statusas FROM Uzklausimai WHERE Dalykas='$dalykas' && Statusas='$bukle'";
        $result = $conn->query($sql4);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            // Užklausimų duomenų surašymas į masyvus
            $skaicius++;
            $ID[$skaicius]=$row['ID'];
            $theme[$skaicius]=$row['Tema'];
            $subject[$skaicius]=$row['Dalykas'];
            $created_by[$skaicius]=$row['SukureID'];
            $status[$skaicius]=$row['Statusas'];
            }
        } else {
        echo "0 results";
        }
    }
    
    session_start();
    $_SESSION['question']=$skaicius;
    $_SESSION['question1']=$ID;
    $_SESSION['question2']=$theme;
    $_SESSION['question3']=$subject;
    $_SESSION['question4']=$created_by;
    $_SESSION['question5']=$status;
    header("Location: Administratorius.php?OK=success?filtered=success");
    $conn->close();
?>
