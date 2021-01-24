<?php
    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Nurodoma kas bus naudojama email funkcijai
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Gaunami tam tikri failai
    require '/home/ziinai/domains/ziniumainai.lt/public_html/PHPMailer/src/Exception.php';
    require '/home/ziinai/domains/ziniumainai.lt/public_html/PHPMailer/src/PHPMailer.php';
    require '/home/ziinai/domains/ziniumainai.lt/public_html/PHPMailer/src/SMTP.php';

    require '/home/ziinai/domains/ziniumainai.lt/public_html/Excel/src/SimpleXLSXGen.php';


    $vardas=$_POST['report1'];
    $pavarde=$_POST['report2'];

    $sql = "SELECT ID, Klase, Pastas FROM Mokytojai WHERE Vardas='$vardas' && Pavarde='$pavarde'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $mokytojoID=$row["ID"];
        $klasesNumeris=$row["Klase"];
        $pastas=$row["Pastas"];
    }
    } else {
    echo "0 results";
    }

    $skaicius=0;

    $sql = "SELECT ID, Vardas, Pavarde, MokinioEL, Slaptazodis, Statusas FROM Mokiniai WHERE MokytojoID='$mokytojoID'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $skaicius++;
        $identity[$skaicius]=$row['ID'];
        $name[$skaicius]=$row['Vardas'];
        $lastName[$skaicius]=$row['Pavarde'];
        $mail[$skaicius]=$row['MokinioEL'];
        $pass[$skaicius]=$row['Slaptazodis'];
        $status[$skaicius]=$row['Statusas'];
    }
    } else {
    echo "0 results";
    }
    
    $data = array(
        array("Mokinio ID", "Vardas", "Pavardė", "El. paštas", "Slaptažodis", "Paskyros statusas", "Sukurti užklausimai", "Paaiškinti užklausimai")
    );
    
    for($i=1;$i<=$skaicius;$i++){
        
        $uzklausimu_skaicius=0;
        $paaiskinimu_skaicius=0;
        
        $sql = "SELECT ID FROM Uzklausimai WHERE SukureID='$identity[$i]'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $uzklausimu_skaicius++;
        }
        } else {
        echo "0 results";
        }

        $sql = "SELECT ID FROM Patvirtinimai WHERE PaaiskinoID='$identity[$i]' && Statusas='Patvirtintas'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $paaiskinimu_skaicius++;
        }
        } else {
        echo "0 results";
        }

        $laikinas=array("$identity[$i]", "$name[$i]", "$lastName[$i]", "$mail[$i]", "$pass[$i]", "$status[$i]", "$uzklausimu_skaicius", "$paaiskinimu_skaicius");
        array_push($data,$laikinas);
    }

    $ataskaitos=0;
    
    $sql = "SELECT ID FROM Ataskaitos";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $ataskaitos++;
        }
        } else {
        echo "0 results";
    }
    $ataskaitos++;
    $failas="Ataskaitos/".$ataskaitos.".xlsx";
    $xlsx = SimpleXLSXGen::fromArray($data);
    $xlsx->saveAs($failas);

    $nuoroda="https://ziniumainai.lt/Ataskaitos/$ataskaitos.xlsx";
    echo $nuoroda;

    date_default_timezone_set("Europe/Vilnius");
    $date=date("Y-m-d");

    $sql = "INSERT INTO Ataskaitos (HTTPS, Israso_data) VALUES ('$nuoroda', '$date');";
    if ($conn->multi_query($sql) === TRUE) {
        echo "New records created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $email             = new PHPMailer();
    $email->CharSet = 'UTF-8';
    $email->IsSMTP();
    $email->Host = $Host;
    $email->SMTPAuth = true;
    $email->SMTPSecure = $SMTPSecure;
    $email->Username = $EmailHostUsername;
    $email->Password = $EmailHostPassword;
    $email->Port = $EmailHostPort;   
    $email->isHTML();                


    /* Set the mail sender. */
    $email->setFrom('ziniu.mainai@ukg.lt', 'VDU UKG Žinių mainai');

    /* Add a recipient. */
    $email->addAddress($pastas, "$vardas $pavarde");

    /* Set the subject. */
    $email->Subject = "$klasesNumeris klasės/srauto ataskaita";

    /* Set the mail message body. */
    $email->Body = "<html xmlns='http://www.w3.org/1999/xhtml'>
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
                                            <b>Administratorius suformavo Jūsų vadovaujamos $klasesNumeris klasės/srauto aktyvumo ataskaitą platformoje „VDU UKG Žinių mainai“</b>
                                        </td>
                                    </tr>
                                    <td style='padding: 20px 0 30px 0; color: #153643; text-align:center; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
                                            <a style='text-decoration:none;' href='$nuoroda'>Peržiūrėkite ir atsisiųskite</a>
                                    </td>
                                    <tr>
                                        <td>
                                            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                                <tr>
                                                    <td width='260' valign='top'>
                                                        <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                                            <tr>
                                                                <td style='padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
                                                                    Norėdami pamatyti savo klasės/srauto aktyvumo statistiką platformoje „VDU UKG Žinių mainai“, parašykite el. laišką administratoriui (<a style='text-decoration:none;' href='mailto:pagalba@bkworks.lt'>pagalba@bkworks.lt</a>).
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

    if (!$email->send()){
        echo $email->ErrorInfo;
        header("Location: Administratorius.php?OK=success?f=success?report=fail");
    } else {
        header("Location: Administratorius.php?OK=success?f=success?report=success");
    }
    $conn->close();
?>