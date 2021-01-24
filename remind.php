<?php

    

    // Nurodoma kas bus naudojama email funkcijai
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Gaunami tam tikri failai
    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    require '/home/ziinai/domains/ziniumainai.lt/public_html/PHPMailer/src/Exception.php';
    require '/home/ziinai/domains/ziniumainai.lt/public_html/PHPMailer/src/PHPMailer.php';
    require '/home/ziinai/domains/ziniumainai.lt/public_html/PHPMailer/src/SMTP.php';

    $conn = new mysqli($servername, $username, $password, $dbname);
    $skaicius=0;


    echo $pastas;
    $pastas=$_POST['remind_email'];
    
    $sql = "SELECT ID, Vardas, Pavarde, Slaptazodis FROM Mokiniai WHERE MokinioEL='$pastas'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $skaicius++;
        $slaptazodis=$row['Slaptazodis'];
        $vardas=$row['Vardas'];
        $pavarde=$row['Pavarde'];
    }
    } else {
    echo "0 results";
    }
    
    if($skaicius>=2){
        header("Location: Prisijungimas.php?remind=more");
    }
    else if($skaicius==0){
        header("Location: Prisijungimas.php?remind=no");
    }
    else{
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
    $mail->addAddress($pastas, "$vardas $pavarde");

    /* Set the subject. */
    $mail->Subject = 'Jūsų paskyros slaptažodis';

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
                                        <td style='color: #153643; font-family: Arial, sans-serif; font-size: 24px;'>
                                            <b>Jūsų paskyros slaptažodis: $slaptazodis</b>
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
                                                                    Norėdami pasikeisti slaptažodį į labiau įsimenamą, tai galite padaryti skiltyje „Paskyra“.
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
    }else{
    header("Location: Prisijungimas.php?sent");
    }
    }

?>
