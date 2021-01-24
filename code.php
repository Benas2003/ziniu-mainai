<?php
    require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
    $vardas;
    $pavarde;
    $klase;
    $mokytojoID;
    $count=0;
    // Iš formos gaunami prisijungimo duomenys
    $mokinio_pastas=$_POST['pastas'];
    $slaptazodis=$_POST['slap'];
     

    $mokinio_pastas = trim($mokinio_pastas," '|', '+', '*', '/', ';', ','");
    $slaptazodis = trim($slaptazodis," '|', '+', '*', '/', '-', ';', ','");
    $slaptazodis = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $slaptazodis);

    // Prisijungiama prie duomenų bazės
    $conn = new mysqli($servername, $username, $password, $dbname); 
     // Tikrinama pagal suvestus duomenis yra toks vartotojas
    $sql = "SELECT ID, Vardas, Pavarde, MokytojoID, MokinioEL, Slaptazodis, Statusas FROM Mokiniai WHERE MokinioEL='$mokinio_pastas' && Slaptazodis='$slaptazodis' && Statusas='Aktyvi'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         // Jei yra vyksta gavimas ir vartotojas nukeliamas į Index.php aplinką
         // Duomenų gavimas
         $identification=$row["ID"];
	     $vardas=$row["Vardas"];
	     $pavarde=$row["Pavarde"];
         $mokytojoID=$row["MokytojoID"];
         $mokinio_pastas=$row["MokinioEL"];
         header("Location: Index.php?status=success");
     }
    } else {
     echo "0 results";
      // Jei ne programa meta alertą
      // Grįžtama į prisijungimo formą
	  header("Location: Prisijungimas.php?status=fail");
    }
    $sql = "SELECT PaaiskinoID, Statusas FROM Patvirtinimai WHERE PaaiskinoID='$identification' && Statusas='Nepatvirtintas'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         // Jei yra vyksta gavimas ir vartotojas nukeliamas į Index.php aplinką
         // Duomenų gavimas
        $count++;
     }
    } else {
     echo "0 results";
    }


    $sql = "SELECT ID, Vardas, Pavarde FROM Mokytojai WHERE ID='$mokytojoID'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         $name=$row['Vardas'];
         $lastname=$row['Pavarde'];
     }
    } else {
     echo "0 results";
    }
    
    if($vardas!="")
    {
        
        // Duomenų perdavimas
        session_start();
        $_SESSION['mokinioID']=$identification;
	    $_SESSION['vrd']=$vardas;
        $_SESSION['pvr']=$pavarde;
        $_SESSION['mokID']=$mokytojoID;
        $_SESSION['elpastas']=$mokinio_pastas;
        $_SESSION['slp']=$slaptazodis;
        $_SESSION['vnt']=$count;

        $_SESSION['mokytojo_vardas']=$name;
        $_SESSION['mokytojo_pavarde']=$lastname;
    }
    
    $conn->close();
	
?>