<!doctype html>
<html lang="lt">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>VDU UKG Žinių mainai</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="shortcut icon" href="REIKALINGI/favicon.ico" type="image/x-icon">
	<link rel="icon" href="REIKALINGI/favicon.ico" type="image/x-icon">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet"> 

	</head>
<body>

<style>

/*Stiliai*/
body{
	background-color : GhostWhite;
	font-family: 'Roboto', sans-serif;
	/*background-color : #f2faff;*/
}

</style>


<script>
    <?php
		// Duomenų perdavimas
		// Administratoriaus duomenys

		session_start();
		$admino_EL=$_SESSION['adminoEL'];
		$admino_SLP=$_SESSION['adminoSLP'];

		if(empty($_SESSION['adminoEL'])) {
			header("Location: Prisijungimas.php?OK=fail");
		}

		// Skirtas gauti tam tikro vartotojo duomenis (vaizduojame formoje Keisti)
		session_start();
		$identification1=$_SESSION['first'];
		$name=$_SESSION['second'];
		$lastname=$_SESSION['third'];
		$class1=$_SESSION['fourth'];
		$student_email=$_SESSION['fifth'];
		$password1=$_SESSION['sixth'];
		$status=$_SESSION['seventh'];
		$skaicius6=$_SESSION['eighth'];
		$class2=$_SESSION['ninth'];

		session_start();
		$skaicius3=$_SESSION['question'];
		$box1=$_SESSION['question1'];
		$box2=$_SESSION['question2'];
		$box3=$_SESSION['question3'];
		$box4=$_SESSION['question4'];
		$box5=$_SESSION['question5'];

		session_start();
		$skaicius4=$_SESSION['skaicius4'];
		$klases=$_SESSION['klases'];

		session_start();
		$skaicius5 = $_SESSION['klase1'];
		$Mvardas = $_SESSION['klase2'];
		$Mpavarde = $_SESSION['klase3'];
		$Mpastas = $_SESSION['klase4'];
		$MID = $_SESSION['klase5'];
		$vardas = $_SESSION['klase6'];
		$pavarde = $_SESSION['klase7'];
		$numeris = $_SESSION['klase8'];

		session_start();
		$deactivated_count=$_SESSION['klase9'];
		$deactivated_ID=$_SESSION['klase10'];
		$deactivated_name=$_SESSION['klase11'];
		$deactivated_lastname=$_SESSION['klase12'];
		$deactivated_email=$_SESSION['klase13'];

		session_start();
		$teachers_count=$_SESSION['teacher1'];
		$teachers_id=$_SESSION['teacher2'];
		$teachers_name=$_SESSION['teacher3'];
		$teachers_lastname=$_SESSION['teacher4'];
		$teachers_email=$_SESSION['teacher5'];
		$teachers_class=$_SESSION['teacher6'];
		$teachers_status=$_SESSION['teacher7'];


		session_start();
		$teacher_id=$_SESSION['teacher8'];
		$teacher_name=$_SESSION['teacher9'];
		$teacher_lastname=$_SESSION['teacher10'];
		$teacher_email=$_SESSION['teacher11'];
		$teacher_class=$_SESSION['teacher12'];

		session_start();
		$active_student_teacherID = $_SESSION['klase14'];
		$deactived_student_teacherID = $_SESSION['klase15'];

    ?>

    $(document).ready(function(){
		$(".inputas3").hide();
    	$(".forma4").hide();
		$(".forma7").hide();
		$(".forma8").hide();
		$(".forma9").hide();
		$(".ieskoti").hide();
		$(".filter1").hide();
		$(".filter2").hide();
		$(".first").hide();
		$(".second").hide();
		$(".third").hide();
		$(".fourth").hide();
		$("#info").hide();
		$("#info1").hide();
		$("#mokinioID").hide();
		$("#deactivate").hide();

		var str = window.location.href;
		
		// Apsauga nuo įsilaužėlių
		if(str=="http://www.ziniumainai.lt/Administratorius.php")
		{
			window.location.href = "Prisijungimas.php";
		}

		var administratoriausEL="";
		var administratoriausSPL="";

		// Administratoriaus duomenys konvertuojami iš php į jquery kintamuosius
		administratoriausEL = "<?php echo $admino_EL ?>"; 
		administratoriausSPL = "<?php echo $admino_SLP ?>"; 

		// Apsauga nuo įsilaužėlių
		// OK (Administratoriaus prisijungimas)
		if((str.includes("?OK=success")) && administratoriausEL!="" && administratoriausSPL!="") 
		{
			$(".ieskoti").show();

			$(naujas).click(function(){
			window.location.href = "filter4.php";
			});
			
			$(uzklausimai).click(function(){
			$(".ieskoti").hide();
			$(".filter1").show();
			$(".first").show();
			$("#deactivate").show();
			});

			$(mokytojas).click(function(){
			$(".ieskoti").hide();
			$(".forma8").show();
			});

			$(klase).click(function(){
				window.location.href = "filter2.php";
			});
			$(mokytojai).click(function(){
				window.location.href = "teachers.php";
			});



			if(str.includes("?filter=success")){
				$(".ieskoti").hide();
				$(".filter1").hide();
				$(".first").hide();
				$(".filter2").show();
			}
			if(str.includes("?f=success")){
				$(".ieskoti").hide();
				$(".filter1").hide();
				$(".first").hide();
				$(".filter2").show();
				$(".second").show();
				$(".third").show();
				$("#info").show();
				$("#info1").show();
			}
			/*if(str.includes("?f=success1")){
				$(".ieskoti").hide();
				$(".filter1").hide();
				$(".first").hide();
				$(".filter2").show();
				$(".second").show();
				$(".third").show();
				$("#info").show();
				$("#info1").show();
			}*/
		}
		if(str.includes("?OK=fail")){
			window.location.href = "Prisijungimas.php?OK=fail";
		}
		// Skirta alertamas pagal administratoriaus atliktus veiksmus
		// q (Administratoriaus veiksmams)
		if(str.includes("?q=1")){
			alert("Vartotojas sėkmingai sukurtas");
		}
		if(str.includes("?q=2")){
			alert("Vartotojo sukurti nepavyko");
		} 
		if(str.includes("?q=3")){
			$(".ieskoti").hide();
			$(".forma7").show();
		}
		if(str.includes("?q=4")){
			alert("Vartotojo rasti nepavyko");
		}
		if(str.includes("?q=5")){
			alert("Vartotojo duomenys sėkmingai pakeisti");
		}
		if(str.includes("?q=6")){
			alert("Vartotojo duomenų pakeisti nepavyko");
		}
		if(str.includes("?q=7")){
			alert("Vartotojas sėkmingai ištrintas");
		}
		if(str.includes("?q=8")){
			alert("Vartotojo ištrintas nepavyko");
		}  
		if(str.includes("?q=9")){
			alert("ERROR (Patikrinkite ar viskas suvesta teisingai ar kreipkitės į sistemos administratorių)");
		}  
		if(str.includes("?q=0")){
			alert("ERROR (Nepasirinkote nė vieno užklausimo)");
		}  

		if(str.includes("?report=success")){
		alert("Klasės/Srauto ataskaita sukurta ir išsiųsta sėkmingai");
		}  

		if(str.includes("?report=fail")){
			alert("Klasės/Srauto ataskaitos sukurti nepavyko");
		}  

		if(str.includes("?filtered")){
			$(".ieskoti").hide();
			$(".filter1").show();
			$(".first").show();
			$("#deactivate").show();
		}  
		if(str.includes("?1")){
			$(".ieskoti").hide();
			$(".forma4").show();
		}  
		if(str.includes("teachers")){
			$(".ieskoti").hide();
			$(".fourth").show();
		}
		if(str.includes("?OK=success/teachers_action")){
			$(".ieskoti").hide();
			$(".fourth").hide();
			$(".forma9").show();
		}
		if(str.includes("teachers/success")){
			alert("Duomenys pakeisti");
		}
		if(str.includes("teacher/false")){
			alert("ERROR");
		}

		$("#hover2").hover(function(){
		$("#hover1").attr("src", "REIKALINGI/report(1).png");
		}, function(){
		$("#hover1").attr("src", "REIKALINGI/report.png");
		});

	});  
</script>

	<!-- Juosta -->
	<nav id="juosta1" class="navbar navbar-expand-lg navbar-light bg-light">
			<nav class="navbar navbar-light bg-light">
			 	<a class="navbar-brand" href="Administratorius.php?OK=success">
			  	 <img src="REIKALINGI/logo.png" width="40" height="40" class="d-inline-block align-top" alt="">
			 	 VDU UKG Žinių mainai
				</a>
			</nav>
			<div class="collapse navbar-collapse" id="navbarNav">
			</div>
	 
			<form action="logout.php" method="POST">
				<nav name="out" class="navbar navbar-light bg-light">
					<button type="submit" class=" navbar-brand btn btn-outline-success" >
					<img src="REIKALINGI/user.png" width="30" height="30" class="d-inline-block align-top" alt="">
						<span>Administratorius</span>
					</button>
				</nav>
			</form>
	</nav>
   
    <!-- Veiksmų pasirinkimas -->
	<nav class="ieskoti">
        <h1><strong>Veiksmai:</strong></h1>
        <button id="naujas" class="btn btn-outline-dark btn-lg btn-block">Pridėti naują vartotoją</button>
		<button id="mokytojas" class="btn btn-outline-dark btn-lg btn-block">Pridėti naują mokytoją</button>
		<button id="mokytojai" class="btn btn-outline-dark btn-lg btn-block">Peržiūrėti mokytojus</button>
		<button id="klase" class="btn btn-outline-dark btn-lg btn-block">Peržiūrėti klases</button>
		<button id="uzklausimai" class="btn btn-outline-dark btn-lg btn-block">Peržiūrėti sukurtus užklausimus</button>
	</nav>

	<!-- SUKURIMO FORMOS -->

	<!-- Sukūrimo forma (mokiniai)-->
	<form class="forma4" method="POST" action="veiksmai.php">
		<div class="row">
		<div class="col">
		<input type="text" name="vr" class="form-control" placeholder="Vardas">
		</div>
		<div class="col">
		<input type="text" name="pv" class="form-control" placeholder="Pavardė">
		</div>
		</div>
	<br>
	<select class="form-control form-control" name="kl">
				<option selected>Pasirinkite klasę / srautą</option>
				<?php foreach($klases as $value){ ?>
					<option><?php echo $value?></option>
				<?php
				}
				?>
	</select>
	<br>
	<input name="mokinio_pastas" class="form-control" type="text" placeholder="El. paštas">
	<br>
	<input name="slp" class="form-control" style="text-transform: uppercase" type="text" placeholder="Aktyvacijos kodas">
	<br>
	<button id="pateikti3" value="1" name="su" type="submit" class="btn btn-outline-dark">Sukurti</button>
	</form>

	<!-- Sukūrimo forma (mokytojai)-->
	<form class="forma8" method="POST" action="veiksmai.php">
	<div class="row">
		<div class="col">
		<input type="text" name="vr" class="form-control" placeholder="Vardas">
		</div>
		<div class="col">
		<input type="text" name="pv" class="form-control" placeholder="Pavardė">
		</div>
	</div>
	<br>
	<input name='Mel' class="form-control" type="text" placeholder="Mokytojo el.paštas">
	<br>
	<input name='kl' class="form-control" type="text" placeholder="Priskiriama klasė / srautas">
	<br>
	<button value="2" name="su" type="submit" class="btn btn-outline-dark">Pridėti</button>
	</form>

	<!-- FILTRAI -->

	<!-- Filtras užklausimams -->
	<form class="filter1" action="filter1.php" method="POST">
		<select class="form-control form-control-lg" name="dalykas1">
				<option value="1" selected>Pasirinkite dalyką</option>
				<option>Biologija/Gamta ir Žmogus</option>
				<option>Chemija</option>
          		<option>Ekonomika</option>
				<option>Fizika</option>
				<option>Geografija</option>
				<option>Informacinės technologijos</option>
        		<option>Istorija</option>
				<option>Lietuvių kalba ir literatūra</option>
				<option>Matematika</option>
				<option>Užsienio kalba (anglų)</option>
				<option>Užsienio kalba (rusų)</option>
          		<option>Užsienio kalba (vokiečių)</option>
				<option>Užsienio kalba (prancūzų)</option>
		</select>
		<br>
		<select class="form-control form-control-lg" name="bukle">
				<option value="1" selected>Pasirinkite būklę</option>
				<option>Aktyvus</option>
				<option>Neaktyvus</option>
		<br>
		</select>
		<br>
		<button type="submit" class="btn btn-primary">Rodyti / Filtruoti</button>
		<br>
	</form>

	<!-- Filtras klasems -->
	<form class="filter2" action="filter3.php" method="POST">
		<select class="form-control form-control-lg" name="dalykas2">
			<option selected>Pasirinkite klasę / srautą</option>
			<?php foreach($klases as $value){ ?>
					<option><?php echo $value?></option>
				<?php
				}
				?>
			</select>
			<br>
			<button type="submit" class="btn btn-primary">Rodyti / Filtruoti</button>
	</form>

	<!-- LENTELES -->

	<!-- Uzklausimu lentele (filtruota) -->
	<form action="question_action.php" method="POST" >
	<table class="table first">
		<thead class="thead-dark">
			<tr>
			<th scope="col">Pasirinkti / #</th>
			<th scope="col">Dalykas</th>
			<th scope="col">Tema</th>
			<th scope="col">Sukūrė ID</th>
			<th scope="col">Statusas</th>
			</tr>
		</thead>
		<tbody>
		<?php
			for ($u=1; $u<=$skaicius3; $u=$u+1){
		?>
			<tr>
			<td scope="row">

				<div class="custom-control custom-checkbox">
					<input name="check_list[]" type="checkbox" class="custom-control-input" id="<?php echo $u?>" value="<?php echo $box1[$u]?>">
					<label class="custom-control-label" for="<?php echo $u?>"><?php echo $box1[$u]?></label>
				</div>
			
			</td>
			<td><?php echo $box2[$u]?></td>
			<td><?php echo $box3[$u]?></td>
			<td><?php echo $box4[$u]?></td>
			<td><?php echo $box5[$u]?></td>
			</tr>
			
		<?php
			}
		?>
		</tbody>
	</table>
	<button id='deactivate' name="submit" type="submit" class="btn btn-primary">Deaktyvuoti</button>
	</form>

	<!-- Klases lentele (esantiems) -->
	<div id="info" >
		<br>
		<h1>Klasė / Srautas : <?php echo $numeris?></h1>
		<h3><?php echo $vardas?> <?php echo $pavarde?></h3>
		<br>
		<form action="custom-report.php" method="POST">
		<input style="display:none;" name="report1" type="text" value="<?php echo $vardas?>" readonly></input>
		<input style="display:none;" name="report2" type="text" value="<?php echo $pavarde?>" readonly></input>
		<button id="hover2" type="submit" class="btn btn-outline-dark"><img id="hover1" src="REIKALINGI/report.png"></img> Suformuoti <?php echo $numeris;?> klasės/srauto ataskaitą</button>
		</form>

	</div>
	<table class="table second">
		<thead class="thead-dark">
			<tr>
			<th scope="col">#</th>
			<th scope="col">Vardas</th>
			<th scope="col">Pavardė</th>
			<th scope="col">El.paštas</th>
			<th scope="col">Veiksmai</th>
			</tr>
		</thead>
		<tbody>
		<?php
			for ($p=1; $p<=$skaicius5; $p=$p+1){
				
		?>
			<tr>
			<form action="class_table.php" method="POST">
			<td scope="row"><?php echo $MID[$p]?>
			<input name='inputas' type="text" class="card-text inputas3" value='<?php echo $MID[$p]?>'></input>
			<input name="inputas1" type="text" class="card-text inputas3" value='<?php echo $active_student_teacherID[$p]?>'></input>
			</td>
			<td><?php echo $Mvardas[$p]?></td>
			<td><?php echo $Mpavarde[$p]?></td>
			<td><?php echo $Mpastas[$p]?></td>
			<td>
				<button name="action" value="1" type="submit" class="btn btn-primary" >Deaktyvuoti</button>
				<button name="action" value="2" type="submit" class="btn btn-primary" >Keisti</button>
			</td>
			</form>
			</tr>
		<?php
			}
		?>
		</tbody>
	</table>


	<!-- Klases lentele (pasalintiems) -->
	<div id="info1" >
		<br>
		<br>
		<br>
		<br>
		<br>
		<h1>Mokiniai, kurie buvo pašalinti iš šios klasės / srauto</h1>
	</div>
	<table class="table third">
		<thead class="thead-dark">
			<tr>
			<th scope="col">#</th>
			<th scope="col">Vardas</th>
			<th scope="col">Pavardė</th>
			<th scope="col">El.paštas</th>
			<th scope="col">Veiksmai</th>
			</tr>
		</thead>
		<tbody>
		<?php
			for ($e=1; $e<=$deactivated_count; $e=$e+1){
				
		?>
			<tr>
			<form action="class_table.php" method="POST">
			<td scope="row"><?php echo $deactivated_ID[$e]?>
			<input name="inputas" type="text" class="card-text inputas3" value='<?php echo $deactivated_ID[$e]?>'></input>
			<input name="inputas1" type="text" class="card-text inputas3" value='<?php echo $deactived_student_teacherID[$e]?>'></input>
			</td>
			<td><?php echo $deactivated_name[$e]?></td>
			<td><?php echo $deactivated_lastname[$e]?></td>
			<td><?php echo $deactivated_email[$e]?></td>
			<td>
				<button name="action" value="4" type="submit" class="btn btn-primary" >Grąžinti</button>
			</td>
			</form>
			</tr>
		<?php
			}
		?>
		</tbody>
	</table>

	<!-- Mokytoju lentele -->
	<table class="table fourth">
		<thead class="thead-dark">
			<tr>
			<th scope="col">#</th>
			<th scope="col">Vardas</th>
			<th scope="col">Pavardė</th>
			<th scope="col">El.paštas</th>
			<th scope="col">Klasė</th>
			<th scope="col">Statusas</th>
			<th scope="col">Veiksmai</th>
			</tr>
		</thead>
		<tbody>
			<?php
			for ($w=1; $w<=$teachers_count; $w=$w+1){
			?>
			<tr>
				<form action="teachers_actions.php" method="POST">
				<td scope="row"><?php echo $teacher_id[$w]?>
				<input name="teacher_ID" type="text" class="card-text inputas3" value='<?php echo $teachers_id[$w]?>'></input>
				</td>
				<td><?php echo $teachers_name[$w]?></td>
				<td><?php echo $teachers_lastname[$w]?></td>
				<td><?php echo $teachers_email[$w]?></td>
				<td><?php echo $teachers_class[$w]?></td>
				<td><?php echo $teachers_status[$w]?></td>
				<td>
					<button name="teacher_action" value="3" type="submit" class="btn btn-primary">Keisti</button>
					<button name="teacher_action" value="1" type="submit" class="btn btn-primary">Deaktyvuoti</button>
					<button name="teacher_action" value="2" type="submit" class="btn btn-primary">Aktyvuoti</button>
				</td>
				</form>
			</tr>
			<?php } ?>
		</tbody>
	</table>	

	<!-- KEITIMAI -->	

	<!-- Mokytoju keitimo forma -->
	<form class="forma9" action="teachers_actions.php" method="POST">
		<input name="identity" class="form-control" type="text" placeholder="ID" value='<?php echo $teacher_id ?>'>
		<br>
		<div class="row">
			<div class="col">
			<input type="text" name="vk" class="form-control" placeholder="Vardas" value='<?php echo $teacher_name ?>'>
			</div>
			<div class="col">
			<input type="text" name="pv" class="form-control" placeholder="Pavardė" value='<?php echo $teacher_lastname ?>'>
			</div>
		</div>
		<br>
		<input name="mail" class="form-control" type="text" placeholder="Mokytojo el.paštas" value='<?php echo $teacher_email ?>'>
		<br>
		<input name="kl" class="form-control" type="text" placeholder="Priskirta klasė" value='<?php echo $teacher_class ?>'>
		<br>
		<button value="4" name="teacher_action" type="submit" class="btn btn-outline-dark">Keisti</button>
	</form>

	<!-- Keisti forma -->
	<form class="forma7" method="POST" action="class_table.php">
	<input id="mokinioID" name="numeris" class="form-control" type="text" placeholder="ID" value='<?php echo $identification1 ?>'>
	<br>
		<div class="row">
		<div class="col">
		<input type="text" name="vr" class="form-control" placeholder="Vardas" value='<?php echo $name ?>'>
		</div>
		<div class="col">
		<input type="text" name="pv" class="form-control" placeholder="Pavardė" value='<?php echo $lastname ?>'>
		</div>
		</div>
	<br>
	<select class="form-control form-control-lg" name="dalykas3">
		<option selected><?php echo $class1?></option>
		<?php foreach($class2 as $value){ ?>
					<option><?php echo $value?></option>
				<?php
				}
				?>
	</select>
	<br>
	<input name="mok" class="form-control" type="text" placeholder="Mokinio el.paštas" value='<?php echo $student_email ?>'>
	<br>
	<input name="slp" class="form-control" type="text" placeholder="Slaptažodis" value='<?php echo $password1 ?>'>
	<br>
	<input name="sta" class="form-control" type="text" placeholder="Statusas" value='<?php echo $status ?>'>
	<br>
	<button value="3" name="action" name="su" type="submit" class="btn btn-outline-dark">Keisti</button>
	</form>

</body>
</html>