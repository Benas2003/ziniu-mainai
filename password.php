<?php

    $naujasPASS = $_POST['change_pass_2'];
    $mokinioID = $_POST['change_pass_1'];

    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    $conn = new mysqli($servername, $username, $password, $dbname); 
    $sql = "UPDATE Mokiniai SET Slaptazodis='$naujasPASS' WHERE ID='$mokinioID'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: Index.php?status=success?changed=success");
        session_start();
        $_SESSION['slp']=$naujasPASS;
    }
    else{
        header("Location: Index.php?status=success?changed=fail");
    }


?>