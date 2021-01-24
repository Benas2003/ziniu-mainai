<?php
// Iš formos gaunami duomenys
$numeris=$_POST['code1'];
session_start();
$mokinioID=$_SESSION['mokinioID'];
$skaicius=0;
$temos;
$dalykai;
$id;

// Prisijungiama prie duomenų bazės
require '/home/ziinai/domains/ziniumainai.lt/public_html/connections.php';
$conn = new mysqli($servername, $username, $password, $dbname); 
// Užklausimo deaktyvavimas
$sql = "UPDATE Uzklausimai SET Statusas='Neaktyvus' WHERE ID='$numeris'";
if ($conn->query($sql) === TRUE) {
   echo "Record updated successfully";
   
} else {
   echo "Error updating record: " . $conn->error;
   
}
   $sql1 = "SELECT ID, Tema, Dalykas, SukureID, Statusas FROM Uzklausimai WHERE SukureID='$mokinioID' && Statusas='Aktyvus'";
   $result = $conn->query($sql1);
   if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
      // Užklausimų duomenų surašymas į masyvus
      $skaicius++;
      $temos[$skaicius]=$row["Tema"];
      $dalykai[$skaicius]=$row["Dalykas"];
      $id[$skaicius]=$row["ID"];
      }
   } else {
   echo "0 results";
   }
   // Užklausimų masyvų perdavimas
   session_start();
   $_SESSION['sk']=$skaicius;
   $_SESSION['temos']=$temos;
   $_SESSION['dalykai']=$dalykai;
   $_SESSION['ID1']=$id;
   header("Location: Index.php?status=success?delete=success?accepted=success");
$conn->close();
?>