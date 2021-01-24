<?php
    session_start();
    $mokinio_ID=$_SESSION['mokinioID'];
    $skaicius=0;

    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    $conn = new mysqli($servername, $username, $password, $dbname); 
    $sql = "SELECT ID, UzklausimoID, SukureID, PaaiskinoID, Statusas FROM Patvirtinimai WHERE PaaiskinoID='$mokinio_ID' && Statusas='Nepatvirtintas'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        // Užklausimų duomenų surašymas į masyvus
        $skaicius++;
        $confirmID[$skaicius]=$row["ID"];
        $questionID[$skaicius]=$row["UzklausimoID"];
        $createdByID[$skaicius]=$row["SukureID"];
        $status[$skaicius]=$row["Statusas"];
    }
    }
    else {
        echo "0 results";
    }
    for($i=1;$i<=$skaicius; $i=$i+1)
    {
        $sql1 = "SELECT ID, Tema, Dalykas, Statusas FROM Uzklausimai WHERE ID='$questionID[$i]' && Statusas='Neaktyvus'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            // Užklausimų duomenų surašymas į masyvus
            $questionSubject[$i]=$row["Tema"];
            $questionDiscipline[$i]=$row["Dalykas"];
            $status[$i]=$row["Statusas"];
        }
    }
        else {
            echo "0 results";
        }
    }

    session_start();
    $_SESSION['confirms_count']=$skaicius;
    $_SESSION['confirm_ID']=$confirmID;
    $_SESSION['question_ID']=$questionID;
    $_SESSION['created_By_ID']=$createdByID;
    $_SESSION['question_subject']=$questionSubject;
    $_SESSION['question_Discipline']=$questionDiscipline;
    header("Location: Index.php?status=success?confirm");
    $conn->close();

?>