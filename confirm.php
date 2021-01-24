<?php
    // Nurodoma kas bus naudojama email funkcijai
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Gaunami tam tikri failai
    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    require '/home/ziinai/domains/ziniumainai.lt/public_html/PHPMailer/src/Exception.php';
    require '/home/ziinai/domains/ziniumainai.lt/public_html/PHPMailer/src/PHPMailer.php';
    require '/home/ziinai/domains/ziniumainai.lt/public_html/PHPMailer/src/SMTP.php';

    
    
    session_start();
    $mokinio_ID=$_SESSION['mokinioID'];
    $kodas=$_POST['code2'];
    $action=$_POST['pat_action'];
    //echo $kodas;
    $count=0;

    echo $kodas;
    echo $mokinio_ID;
    echo $action;
   
    $conn = new mysqli($servername, $username, $password, $dbname); 

    if($action=="tvirtinu")
    {
        $sql2 = "UPDATE Patvirtinimai SET Statusas='Patvirtintas' WHERE ID='$kodas'";
        if ($conn->query($sql2) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        header("Location: Index.php?status=success?confirm=fail");
        }
        $sql = "SELECT ID, UzklausimoID, SukureID, PaaiskinoID, Statusas FROM Patvirtinimai WHERE PaaiskinoID='$mokinio_ID' && Statusas='Nepatvirtintas'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            // Užklausimų duomenų surašymas į masyvus
            $skaicius++;
            $count++;
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
        header("Location: aukletojas.php");
    }
    else {
       	$uzklausimo_ID;
        
        $sql = "UPDATE Patvirtinimai SET Statusas='Grąžintas' WHERE ID='$kodas'";
        if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        header("Location: Index.php?returned=fail");
        }

        $sql = "SELECT ID, UzklausimoID, SukureID, PaaiskinoID, Statusas FROM Patvirtinimai WHERE ID='$kodas' && Statusas='Grąžintas'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
            // Užklausimų duomenų surašymas į masyvus
            $uzklausimo_ID=$row['UzklausimoID'];
            $mokinio_ID1=$row['SukureID'];
            $paaiskino_ID1=$row['PaaiskinoID'];
        }
        } else {
        header("Location: Index.php?returned=fail");
        echo "0 results";
        }

        $sql = "SELECT MokinioEL FROM Mokiniai WHERE ID='$mokinio_ID1'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
            // Užklausimų duomenų surašymas į masyvus
            $pastas=$row['MokinioEL'];
        }
        } else {
        header("Location: Index.php?returned=fail");
        echo "0 results";
        }
        
        $sql = "SELECT Vardas, Pavarde FROM Mokiniai WHERE ID='$paaiskino_ID1'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
            // Užklausimų duomenų surašymas į masyvus
            $vardas=$row['Vardas'];
            $pavarde=$row['Pavarde'];
        }
        } else {
        header("Location: Index.php?returned=fail");
        echo "0 results";
        }

        $sql = "SELECT Tema, Dalykas FROM Uzklausimai WHERE ID='$uzklausimo_ID'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
            // Užklausimų duomenų surašymas į masyvus
            $tema=$row['Tema'];
            $dalykas=$row['Dalykas'];
        }
        } else {
        header("Location: Index.php?returned=fail");
        echo "0 results";
        }


        $sql = "UPDATE Uzklausimai SET Statusas='Aktyvus' WHERE ID='$uzklausimo_ID'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            } else {
            header("Location: Index.php?returned=fail");
            echo "Error updating record: " . $conn->error;
            }
        
        $sql = "SELECT ID, UzklausimoID, SukureID, PaaiskinoID, Statusas FROM Patvirtinimai WHERE PaaiskinoID='$mokinio_ID' && Statusas='Nepatvirtintas'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            // Užklausimų duomenų surašymas į masyvus
            $skaicius++;
            $count++;
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
        $mail             = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->IsSMTP();
        $mail->Host = $Host;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $SMTPSecure;
        $mail->Username = $EmailHostUsername;
        $mail->Password = $EmailHostPassword;
        $mail->Port = $EmailHostPort;   
        $mail->isHTML();             
                
        /* Set the mail sender. */
        $mail->setFrom('ziniu.mainai@ukg.lt', 'VDU UKG Žinių mainai');

        /* Add a recipient. */
        $mail->addAddress($pastas);

        /* Set the subject. */
        $mail->Subject = 'Jūsų užklausimas buvo grąžintas';

        /* Set the mail message body. */
        $mail->Body = "<html xmlns='http://www.w3.org/1999/xhtml'>
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <title>Demystifying Email Design</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
        </head>
        <body style='margin: 0; padding: 0;'>
            <table border='0' cellpadding='0' cellspacing='0' width='100%'> 
                <tr>
                    <td style='padding: 10px 0 30px 0;'>
                        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border: 1px solid #cccccc; border-collapse: collapse;'>
                            <tr>
                                <td align='center' bgcolor='#194341' style='padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;'>
                                    <img src='https://www.ziniumainai.lt/REIKALINGI/Pasto_pirmas.jpg' alt='VDU UKG Žinių mainai' width='524' height='354' style='display: block;' />
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor='#ffffff' style='padding: 40px 30px 40px 30px;'>
                                    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                        <tr>
                                            <td style='color: #153643; font-family: Arial, sans-serif; font-size: 15px;'>
                                                <b>Jūsų užklausimas $tema ($dalykas) buvo grąžintas į bendrąjį programos langą.<br> Mokinys/-ė $vardas $pavarde nebegali paaiškinti Jums.</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style='padding: 20px 0 30px 0; color: #153643; text-align:center; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
                                                <a style='text-decoration:none;' href='ziniumainai.lt'>Prisijunkite prie svetainės</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                                    <tr>
                                                        <td width='260' valign='top'>
                                                            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                                                <tr>
                                                                    <td style='padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
                                                                        Norėdami pamatyti savo sukurtus užklausimus, tai galite padaryti skiltyje „Mano“.
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td style='font-size: 0; line-height: 0;' width='20'>
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor='#194341' style='padding: 30px 30px 30px 30px;'>
                                    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                        <tr>
                                            <td style='color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;' width='75%'>
                                                © VDU UKG Žinių mainai, 2020<br/>
                                            </td>
                                            <td align='right' width='25%'>
                                                <table border='0' cellpadding='0' cellspacing='0'>
                                                    <tr>
                                                        <td style='font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;'>
                                                            <a href='https://www.facebook.com/UKG.lt/' style='color: #ffffff;'>
                                                                <img src='https://www.ziniumainai.lt/REIKALINGI/facebook.png' alt='Facebook' width='38' height='38' style='display: block;' border='0' />
                                                            </a>
                                                        </td>
                                                        <td style='margin-left:10px; font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;'>
                                                            <a href='https://ukg.vdu.lt/' style='color: #ffffff;'>
                                                                <img src='https://www.ziniumainai.lt/REIKALINGI/www.png' alt='UKG' width='38' height='38' style='display: block;' border='0' />
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>";

        if (!$mail->send()){
            echo $mail->ErrorInfo;
        }
        header("Location: Index.php?status=success?returned=success");
    }
    echo $count;
    session_start();
    $_SESSION['vnt']=$count;
    $_SESSION['confirms_count']=$skaicius;
    $_SESSION['confirm_ID']=$confirmID;
    $_SESSION['question_ID']=$questionID;
    $_SESSION['created_By_ID']=$createdByID;
    $_SESSION['question_subject']=$questionSubject;
    $_SESSION['question_Discipline']=$questionDiscipline;



    $conn->close();
?>