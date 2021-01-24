<?php
   // Nurodoma kas bus naudojama email funkcijai
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;

      // Gaunami tam tikri failai
   require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
   require '/home/ziinai/domains/ziniumainai.lt/public_html/PHPMailer/src/Exception.php';
   require '/home/ziinai/domains/ziniumainai.lt/public_html/PHPMailer/src/PHPMailer.php';
   require '/home/ziinai/domains/ziniumainai.lt/public_html/PHPMailer/src/SMTP.php';

   date_default_timezone_set("Europe/Vilnius");
   $date=date("Y-m-d");

   // Gaunami parametrai
   $kodas=$_POST['code'];
   session_start();
   $aiskintojo_vardas=$_SESSION['aisV'];
   $aiskintojo_pavarde=$_SESSION['aisP'];
   $aiskintojo_ID=$_SESSION['aisID'];
   $aiskintojo_mokytojo_ID=$_SESSION['aismokID'];
   $pastas=$_SESSION['aisEL'];

   // Vietiniai parametrai
   $tema="";
   $dalykas="";
   $gavejasID="";
   $gavejas="";
   $count=0;

   $gavejas_mokytojo_ID="";
   $gavejo_klase="";
   $aiskintojo_klase="";

   // Prisijungiama prie duomenų bazės
   $conn = new mysqli($servername, $username, $password, $dbname); 
   // Imama aiškintojo klasė
   $sql = "SELECT ID, Klase FROM Mokytojai WHERE ID='$aiskintojo_mokytojo_ID'";
   $result = $conn->query($sql);
      if ($result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
            echo "Good1";
           	$aiskintojo_klase2=$row['Klase'];
         }
      } else {
      echo "0 results";
      }

   // Imami duomenys apie užklausimą
   $sql = "SELECT ID, Tema, Dalykas, SukureID FROM Uzklausimai WHERE ID='$kodas'";
   $result = $conn->query($sql);
      if ($result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
            echo "Good2";
            $tema=$row['Tema'];
            $dalykas=$row['Dalykas'];
            $gavejasID=$row['SukureID'];
         }
      } else {
      echo "0 results";
      }
   // Imamas pranešimo gavėjas
   $sql1 = "SELECT MokytojoID, MokinioEL FROM Mokiniai WHERE ID='$gavejasID'";
   $result = $conn->query($sql1);
      if ($result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
            echo "Good3";
            $gavejas=$row["MokinioEL"];
           	$gavejas_mokytojo_ID=$row["MokytojoID"];
         }
      } else {
      echo "0 results";
      }
	// Imama gavėjo klasė
   $sql = "SELECT ID, Klase FROM Mokytojai WHERE ID='$gavejas_mokytojo_ID'";
   $result = $conn->query($sql);
      if ($result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
            echo "Good4";
           	$gavejo_klase2=$row['Klase'];
         }
      } else {
      echo "0 results";
      }

   preg_match("/([0-9]+)/", $gavejo_klase2, $gavejo_klase1);
   $gavejo_klase = $gavejo_klase1[1];

   preg_match("/([0-9]+)/", $aiskintojo_klase2, $aiskintojo_klase1);
   $aiskintojo_klase = $aiskintojo_klase1[1];

   if($aiskintojo_klase < $gavejo_klase)
   {
     header("Location: Index.php?status=success?request=success?email=young");
   }
   // Tikrinimas ar vartotojas nepaaiškina savo užklausimo
   else if($gavejasID==$aiskintojo_ID)
   {
     header("Location: Index.php?status=success?request=success?email=my");
   }
   // El. pašto sukūrimas ir išsiuntimas
   else{
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
        $email->addAddress($gavejas);

        /* Set the subject. */
        $email->Subject = 'Pranešimas apie Jūsų sukurtą užklausimą';

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
                                                <b>Jūsų užklausimas $tema ($dalykas).<br> Gali būti paaiškintas mokinio/-ės: $aiskintojo_vardas $aiskintojo_pavarde.<br> JO/-S KONTAKTINIS EL. PAŠTAS - <a style='text-decoration:none;' href='mailto:$pastas'>$pastas</a></b>
                                            </td>
                                        </tr>
                                        <td style='padding: 20px 0 30px 0; color: #153643; text-align:center; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
                                                <a style='text-decoration:none;' href='ziniumainai.lt'>Prisijunkite prie svetainės</a>
                                        </td>
                                        <tr>
                                            <td>
                                                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                                    <tr>
                                                        <td width='260' valign='top'>
                                                            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                                                <tr>
                                                                    <td style='padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
                                                                        Norėdami patvirtinti savo paaiškinimus, tai galite padaryti skiltyje „Patvirtinti“.
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
            header("Location: Index.php?status=success?email=fail");
        }
        else{
        header("Location: Index.php?status=success?email=success");
        // Užklausimo deaktivavimas
        $sql2 = "UPDATE Uzklausimai SET Statusas='Neaktyvus' WHERE ID='$kodas'";
        if ($conn->query($sql2) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        }

        $sql3 = "INSERT INTO Patvirtinimai (UzklausimoID, SukureID, PaaiskinoID, Iraso_data, Statusas) VALUES ('$kodas', '$gavejasID', '$aiskintojo_ID', '$date', 'Nepatvirtintas');";
        if ($conn->multi_query($sql3) === TRUE) {
        echo "New records created successfully"; 
        $patvirtinimas="Created";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $sql4 = "SELECT PaaiskinoID, Statusas FROM Patvirtinimai WHERE PaaiskinoID='$aiskintojo_ID' && Statusas='Nepatvirtintas'";
        $result = $conn->query($sql4);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            $count++;
            }
        } else {
            echo "0 results";
        }
        session_start();      
        $_SESSION['vnt']=$count;
    }
        
   }
   $conn->close();

   ?>
