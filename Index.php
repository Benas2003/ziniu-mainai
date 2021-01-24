<!doctype html>
<html lang="lt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VDU UKG Žinių mainai</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    
	<link rel="shortcut icon" href="REIKALINGI/favicon.ico" type="image/x-icon">
	<link rel="icon" href="REIKALINGI/favicon.ico" type="image/x-icon">

	<script src="https://cdn.jsdelivr.net/npm/mobile-detect@1.4.4/mobile-detect.min.js"></script>
    <script src="jquery-3.5.1.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet"> 

	</head>
<body>
	
<style>

/*Stiliai*/
body{
	background-color : #eeeeee ;
	font-family: 'Roboto', sans-serif;
}

.alert {
  padding: 1%;
  background-color: #f44336;
  color: white;
  opacity: 1;
  transition: opacity 0.6s;
  margin-bottom: 0.5%;
}

.alert.success {background-color: #4CAF50;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}

nav {
  width: 100%;
  margin: 0 auto;
  background: #fff;
  padding: 20px 0;
  /*box-shadow: 0px 5px 0px #dedede;*/
}

nav ul {
  list-style: none;
  text-align: center;
}
nav ul li {
  display: inline-block;
}
nav ul li a {
  color:black !important;
  display: block;
  padding: 15px;
  text-decoration: none;
  color: #aaa;
  font-weight: 800;
  text-transform: uppercase;
  margin: 0 5px;
}
nav ul li a,
nav ul li a:after,
nav ul li a:before {
  transition: all .5s;
}
nav ul li a:hover {
  color: #555;
}

/* By Dominik Biedebach @domobch */


/* SHIFT */
nav.shift ul li a {
  position:relative;
  z-index: 1;
}
nav.shift ul li a:hover {
  color: #91640F;
}
nav.shift ul li a:after {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  margin: auto;
  width: 100%;
  height: 1px;
  content: '.';
  color: transparent;
  background: #28a745;
  visibility: none;
  opacity: 0;
  z-index: -1;
}
nav.shift ul li a:hover:after {
  opacity: 1;
  visibility: visible;
  height: 100%;
}

@media only screen and (max-width: 600px) {
	#juosta{
		display:none;
	}
}

</style>

	<script>
	<?php 

		// Duomenų perdavimas

		//Prisijungimas
		session_start();
		$mokinio_ID=$_SESSION['mokinioID'];
		$vardas=$_SESSION['vrd'];
		$pavarde=$_SESSION['pvr'];
		$mokytojoID=$_SESSION['mokID'];
		$mokinioEL=$_SESSION['elpastas'];
		$slaptazodis=$_SESSION['slp'];
		$count=$_SESSION['vnt'];

        $mokytojo_vardas1=$_SESSION['mokytojo_vardas'];
        $mokytojo_pavarde1=$_SESSION['mokytojo_pavarde'];

		//sukurti
		session_start();
		$_SESSION['kl']=$mokytojoID;
		$_SESSION['slpa']=$slaptazodis;
		$_SESSION['el']=$mokinioEL;


		// kai mano
		session_start();
		$temos=$_SESSION['temos'];
		$dalykai=$_SESSION['dalykai'];		
		$skaicius=$_SESSION['sk'];
		$ID=$_SESSION['ID1'];

		// kai kitu
		session_start();
		$temos1=$_SESSION['temos1'];
		$dalykai1=$_SESSION['dalykai1'];		
		$skaicius1=$_SESSION['sk1'];
		$ID1=$_SESSION['ID2'];
		$sukure1=$_SESSION['sukure'];

		// mokinio el pastui
		$_SESSION['aisID']=$mokinio_ID;
		$_SESSION['aisV']=$vardas;
		$_SESSION['aisP']=$pavarde;
		$_SESSION['aisEL']=$mokinioEL;
		$_SESSION['aismokID']=$mokytojoID;

		// aukletojo EL
		$_SESSION['aukID']=$mokytojoID;

		session_start();
		$skaicius2=$_SESSION['confirms_count'];
		$confirmID=$_SESSION['confirm_ID'];
		$questionID=$_SESSION['question_ID'];
		$createdByID=$_SESSION['created_By_ID'];
		$questionSubject=$_SESSION['question_subject'];
		$questionDiscipline=$_SESSION['question_Discipline'];

		
		
	?>
	$(document).ready(function(){
	$(".inputas1").hide();
	$(".inputas2").hide();
	$(".inputas4").hide();
	//$("#juosta").show();
	document.getElementById("juosta").style.display = "flex"; 
	$(".titulinis").show();

	var str = window.location.href;

	// Apsauga nuo įsilaužėlių
	if(str=="http://www.ziniumainai.lt/Index.php")
	{
		window.location.href = "Prisijungimas.php";
	}
	if(str=="http://www.ziniumainai.lt/Index.php")
	{
		window.location.href = "Prisijungimas.php";
	}


	var vardas="";
	var pavarde="";
	var klase="";
	var slaptazodis="";

	vardas = "<?php echo $vardas ?>"; 
	pavarde = "<?php echo $pavarde ?>"; 
	klase = "<?php echo $klase ?>"; 
	slaptazodis = "<?php echo $slaptazodis ?>"; 

	var confirms = "<?php echo $count ?>"; 
	//alert(confirms);
	////////////////////// STATUSAI ///////////////////////////////////////
	// Apsauga nuo įsilaužėlių
	// Status (mokiniu prisijungimas)
	if(vardas == "" && pavarde == "")
	{
		window.location.href = "Prisijungimas.php";
	}
	if((str.includes("?status=success")) && vardas!="" && pavarde!= ""){
		/*document.getElementById("vartotojas_vardas").innerHTML=vardas+ " ";
		document.getElementById("vartotojas_pavarde").innerHTML=pavarde;*/
		//document.getElementById("apacia").innerHTML="© Vytauto Didžiojo universiteto Ugnės Karvelis Gimnazija," + " " + new Date().getFullYear();
        $("#apacia").html("© Vytauto Didžiojo universiteto Ugnės Karvelis Gimnazija," + " " + new Date().getFullYear());

			// Created (užklausimo sukūrimas)
		if(str.includes("?created=success")){
			//alert("Užklausimas sėkmingai sukurtas");
			$( ".sukuriu" ).css( "display", "block" );
		}
      	if(str.includes("?created=characters")){
			//alert("Užklausimas sėkmingai sukurtas");
			$( ".nesukuriu_rasmenys" ).css( "display", "block" );
		}
		if(str.includes("?created=fail")){
			//alert("Užklausimo sukurti nepavyko");
			$( ".nesukuriu" ).css( "display", "block" );
		}
		// Accepted (mano užklausimų vaizdavimui)
		if(str.includes("?accepted=success")){
			$( ".tikmano" ).css( "display", "inline-block" );
			$( ".titulinis").css( "display", "none" );
		}
		// Request (visų užklausimų vaizdavimui)
		if(str.includes("?request=success")){
			$( ".kitu" ).css( "display", "inline-block" );
			$( ".titulinis").css( "display", "none" );
		}

		// Email (elektroninio pašto išsiuntimui)
		if(str.includes("?email=success")){
			$( ".mokinys" ).css( "display", "block" );
			//alert("Mokiniui pranešta apie Jūsų susidomėjimą paaiškinti");
			//window.location.href = "aukletojas.php";
		}
		if(str.includes("?email=fail")){
			$( ".nemokinys" ).css( "display", "block" );
			//alert("Pranešimo išsiųsti nepavyko");
		}
		if(str.includes("?email=my")){
			$( ".as_pats" ).css( "display", "block" );
			//alert("Negalite paaiškinti savo sukurto užklausimo");
		}
      	if(str.includes("?email=young")){
			$( ".vyresnis" ).css( "display", "block" );
			//alert("Negalite paaiškinti savo sukurto užklausimo");
		}
		// Delete (užklausimų šalinimui)
		if(str.includes("?delete=success")){
			$( ".pasalinu" ).css( "display", "block" );
		}
		if(str.includes("?delete=false")){
			$( ".nepasalinu" ).css( "display", "block" );
			//alert("Užklausimo pašalinti nepavyko");
		}
		if(str.includes("?returned=success")){
			$( ".grazinu" ).css( "display", "block" );
		}
		if(str.includes("?returned=fail")){
			$( ".negrazinu" ).css( "display", "block" );
			//alert("Užklausimo pašalinti nepavyko");
		}
		if(str.includes("?changed=success")){
			$( ".pakeiciu" ).css( "display", "block" );
			//alert("Užklausimo pašalinti nepavyko");
		}
		if(str.includes("?changed=fail")){
			$( ".nepakeiciu" ).css( "display", "block" );
			//alert("Užklausimo pašalinti nepavyko");
		}
     	if(str.includes("?changedata")){
			$( ".forma2" ).css( "display", "none" );
			$( ".tikmano" ).css( "display", "none" );
			$( ".kitu" ).css( "display", "none" );
			$( ".patvirtinimai" ).css( "display", "none" );
			$( ".titulinis").css( "display", "none" );
			$( ".student_info").css( "display", "block" );
		}
      	if(str.includes("?createquestion")){
			$( ".forma2" ).css( "display", "block" );
			$( ".tikmano" ).css( "display", "none" );
			$( ".kitu" ).css( "display", "none" );
			$( ".patvirtinimai" ).css( "display", "none" );
			$( ".titulinis").css( "display", "none" );
      		$( ".student_info").css( "display", "none" );
		}

		if(confirms==0)
		{
			$(".cnf").css('display', 'none');
			$(".cnf1").css('display', 'none');
		}
		else
		{
			$(".cnf").css('display', 'inline-block');
			$(".cnf1").css('display', 'inline-block');
		}
		if(str.includes("?confirm")){
			$( ".patvirtinimai" ).css( "display", "inline-block" );
			$( ".titulinis").css( "display", "none" );
		}

		if(str.includes("?confirm=success")){
			$( ".patvirtinu" ).css( "display", "block" );
			$( ".patvirtinimai" ).css( "display", "inline-block" );
			$( ".titulinis").css( "display", "none" );
		}

		if(str.includes("?confirm=fail")){
			$( ".nepatvirtinu" ).css( "display", "block" );
			$( ".patvirtinimai" ).css( "display", "inline-block" );
			$( ".titulinis").css( "display", "none" );
		}


		var close = document.getElementsByClassName("closebtn");
		var i;

		for (i = 0; i < close.length; i++) {
		close[i].onclick = function(){
			var div = this.parentElement;
			div.style.opacity = "0";
			setTimeout(function(){ div.style.display = "none"; }, 600);
		}
		}
		if((str.includes("Index.php?status=success")) && vardas== "" && pavarde == ""){
		window.location.href = "Prisijungimas.php";
		}

		/*MOBILI VERSIJA*/
		var md = new MobileDetect(window.navigator.userAgent);

		if(md.mobile())
		{
			//alert("You are using phone");
			$( ".dropdown").css( "display", "inline" );
			document.getElementById("juosta").style.display = "none"; 
            //$("#apacia").css("fontSize", "20px");
            $("#apacia").html("© VDU Ugnės Karvelis Gimnazija," + " " + new Date().getFullYear());

		}
		if(!md.mobile())
		{
			$( ".dropdown").css( "display", "none" );
			document.getElementById("juosta").style.display = "flex"; 
            //$("#apacia").css("fontSize", "20px");
             $("#apacia").html("© Vytauto Didžiojo universiteto Ugnės Karvelis Gimnazija," + " " + new Date().getFullYear());
		}

		$('.btnSubmit1').click(function() {
			$(".mobilus_5_klase").submit();
          	
  		});
		$('.btnSubmit2').click(function() {
			$(".mobilus_6_klase").submit();
  		});
		$('.btnSubmit3').click(function() {
			$(".mobilus_7_klase").submit();
  		});
		$('.btnSubmit4').click(function() {
			$(".mobilus_8_klase").submit();
  		});
		$('.btnSubmit5').click(function() {
			$(".mobilus_9_klase").submit();
  		});
		$('.btnSubmit6').click(function() {
			$(".mobilus_10_klase").submit();
  		});
		
		$('#btnSubmit7').click(function() {
			document.getElementById("mobilus_atsijungimas").submit();
  		});
		$('#btnSubmit8').click(function() {
			document.getElementById("mobilus_mano").submit();
  		});
		$('.btnSubmit9').click(function() {
			$(".cnf1").submit();
  		});
		$('.btnSubmit10').click(function() {
			$(".mobilus_mano").submit();
  		});
		$('.btnSubmit11').click(function() {
			$(".cnf").submit();
  		});

		$('#sukurti1').click(function() {
         	window.location.href = "Index.php?status=success?createquestion";	
          	/*$(".dropdown-content").css( "display", "none" );
          	$( ".forma2" ).css( "display", "block" );
			$( ".tikmano" ).css( "display", "none" );
			$( ".kitu" ).css( "display", "none" );
			$( ".patvirtinimai" ).css( "display", "none" );
			$( ".titulinis").css( "display", "none" );
          	$( ".student_info").css( "display", "none" );*/
		});
  
      
		$('#data1').click(function() {
          	window.location.href = "Index.php?status=success?changedata";
          	/*$(".dropdown-content").css( "display", "none" );
			$( ".forma2" ).css( "display", "none" );
			$( ".tikmano" ).css( "display", "none" );
			$( ".kitu" ).css( "display", "none" );
			$( ".patvirtinimai" ).css( "display", "none" );
			$( ".titulinis").css( "display", "none" );
			$( ".student_info").css( "display", "block" );*/
		});
      	
		$('#mobilus_titulinis').click(function() {
			window.location.href = "Index.php?status=success";
		});
      
      	
      	/*$('#sukurti1').click(function() {
    	 	$(".dropdown").click(function(e){
                e.preventDefault();
                var $this = $(this).children(".dropdown-content");
                $(".dropdown-content:visible").not($this).slideToggle(200); //Close submenu already opened
                $this.slideToggle(200); //Open the new submenu
            });
        });*/

		///////////////////////////////////////////////////////////////////
	}
	
	});
	</script>

	  <!-- Mobili versija -->
		<div class="dropdown" style="display:none;">
		<button class="dropbtn">Meniu <a style="align-items: end;">&#9776;</a></button>
		<div class="dropdown-content">
			<a id="mobilus_titulinis" style="cursor:pointer;" ><img src="MOBILI/house.png" width="20" height="20" class="d-inline-block align-top" alt="">  Titulinis</a>
			<form class="mobilus_5_klase" method="POST" action="gauti.php">
				<input style="display:none;" name="uz_klase" value="5"> 
				<a style="cursor:pointer;" class="btnSubmit1">5 klasė</a>
			</form>
			<form class="mobilus_6_klase" method="POST" action="gauti.php">
				<input style="display:none;" name="uz_klase" value="6"> 
				<a style="cursor:pointer;" class="btnSubmit2">6 klasė</a>
			</form>
			<form class="mobilus_7_klase" method="POST" action="gauti.php">
				<input style="display:none;" name="uz_klase" value="7"> 
				<a style="cursor:pointer;" class="btnSubmit3">7 klasė</a>
			</form>
			<form class="mobilus_8_klase" method="POST" action="gauti.php">
				<input style="display:none;" name="uz_klase" value="8"> 
				<a style="cursor:pointer;" class="btnSubmit4">8 klasė</a>
			</form>
			<form class="mobilus_9_klase" method="POST" action="gauti.php">
				<input style="display:none;" name="uz_klase" value="9"> 
				<a style="cursor:pointer;" class="btnSubmit5">9 klasė</a>
			</form>
			<form class="mobilus_10_klase" method="POST" action="gauti.php">
				<input style="display:none;" name="uz_klase" value="10"> 
				<a style="cursor:pointer;" class="btnSubmit6">10 klasė</a>
			</form>
			<a id="sukurti1" style="cursor:pointer;"><img src="MOBILI/pen.png" width="20" height="20" class="d-inline-block align-top" alt="">  Sukurti užklausimą</a>
			<form id="mobilus_mano" action="gauti_mano.php">
			<a style="cursor:pointer;" id="btnSubmit8"><img src="MOBILI/paper.png" width="20" height="20" class="d-inline-block align-top" alt="">  Mano užklausimai</a>
			</form>
			<form action="gauti_confirm.php" class="cnf1" >
			<a style="cursor:pointer;" class="btnSubmit9"><img src="MOBILI/confirm.png" width="20" height="20" class="d-inline-block align-top" alt="">  Patvirtinimai (<?php echo $count;?>)</a>
			</form>
			<a id="data1" style="cursor:pointer;"><img src="MOBILI/gears.png" width="20" height="20" class="d-inline-block align-top" alt="">  Keisti duomenis</a>
			<form id="mobilus_atsijungimas" action="logout.php" method="POST">
				<a style="cursor:pointer;" id="btnSubmit7"><img src="MOBILI/logout.png" width="20" height="20" class="d-inline-block align-top" alt="">  Atsijungti (<?php echo $vardas;?> <?php echo $pavarde;?>)</a>
			</form>
		</div>
		</div> 


	<section>
	<nav id='juosta' class="shift">
		<ul>
		<li><a style="text-decoration: none;" href="Index.php?status=success"><img src="REIKALINGI/logo.png" width="40" height="40" class="d-inline-block align-top" alt="">VDU UKG Žinių mainai</a></li>
		
		
		
		<li>
		<form class="mobilus_5_klase" method="POST" action="gauti.php" style="cursor:pointer;">
		<input style="display:none;" name="uz_klase" value="5"> 
		<a style="text-decoration: none;" style="cursor:pointer;" class="btnSubmit1">5 klasė</a>
		</form>
		</li>


		<li>
		<form class="mobilus_6_klase" method="POST" action="gauti.php" style="cursor:pointer;">
		<input style="display:none;" name="uz_klase" value="6"> 
		<a style="text-decoration: none;" style="cursor:pointer;" class="btnSubmit2">6 klasė</a>
		</form>
		</li>

		<li>
		<form class="mobilus_7_klase" method="POST" action="gauti.php" style="cursor:pointer;">
		<input style="display:none;" name="uz_klase" value="7"> 
		<a style="text-decoration: none;" style="cursor:pointer;" class="btnSubmit3">7 klasė</a>
		</form>
		</li>

		<li>
		<form class="mobilus_8_klase" method="POST" action="gauti.php" style="cursor:pointer;">
		<input style="display:none;" name="uz_klase" value="8"> 
		<a style="text-decoration: none;" style="cursor:pointer;" class="btnSubmit4">8 klasė</a>
		</form>
		</li>

		<li>
		<form class="mobilus_9_klase" method="POST" action="gauti.php" style="cursor:pointer;">
		<input style="display:none;" name="uz_klase" value="9"> 
		<a style="text-decoration: none;" style="cursor:pointer;" class="btnSubmit5">9 klasė</a>
		</form>
		</li>

		<li>
		<form class="mobilus_10_klase" method="POST" action="gauti.php" style="cursor:pointer;">
		<input style="display:none;" name="uz_klase" value="10"> 
		<a style="text-decoration: none;" style="cursor:pointer;" class="btnSubmit6">10 klasė</a>
		</form>
		</li>

		
		
		
		<li><a style="text-decoration: none;" href="Index.php?status=success?createquestion">Sukurti</a></li>


		<li>
		<form class="mobilus_mano" method="POST" action="gauti_mano.php" style="cursor:pointer;">
		<input style="display:none;" name="uz_klase" value="10"> 
		<a style="text-decoration: none;" style="cursor:pointer;" class="btnSubmit10">Mano</a>
		</form>
		</li>

		<li>
		<form class="cnf" method="POST" action="gauti_confirm.php" style="cursor:pointer;">
		<input style="display:none;" name="uz_klase" value="10"> 
		<a style="text-decoration: none;" style="cursor:pointer;" class="btnSubmit11">Patvirtinti <sup><?php echo $count;?></sup></a>
		</form>
		</li>

		<li><a style="text-decoration: none;" href="Index.php?status=success?changedata"><img src="MOBILI/gears.png" width="20" height="20" class="d-inline-block align-top" alt="">Paskyra</a></li>
		<li><a style="text-decoration: none;" href="logout.php">Atsijungti (<?php echo $vardas;?> <?php echo $pavarde;?>)</a></li>
		</ul>
	</nav>
	</section>
				
	
	<div class="alert success mokinys">
		<span class="closebtn">&times;</span>  
		<strong>Veiksmas atliktas sėkmingai</strong> Mokiniui pranešta apie Jūsų susidomėjimą.
	</div>

	<div class="alert success pasalinu">
  		<span class="closebtn">&times;</span>  
 		<strong>Veiksmas atliktas sėkmingai</strong> Užklausimas pašalintas.
	</div>

	<div class="alert success sukuriu">
  		<span class="closebtn">&times;</span>  
 		<strong>Veiksmas atliktas sėkmingai</strong> Užklausimas sukurtas.
	</div>

	<div class="alert success grazinu">
  		<span class="closebtn">&times;</span>  
 		<strong>Veiksmas atliktas sėkmingai</strong> Užklausimas grąžintas.
	</div>

	<div class="alert success patvirtinu">
		<span class="closebtn">&times;</span>  
		<strong>Veiksmas atliktas sėkmingai</strong> Paaiškinimas patvirtintas.
	</div>

	<div class="alert success pakeiciu">
		<span class="closebtn">&times;</span>  
		<strong>Veiksmas atliktas sėkmingai</strong> Duomenys pakeisti.
	</div>


	<div class="alert as_pats">
  		<span class="closebtn">&times;</span>  
  		<strong>Veiksmo atlikti negalima</strong> Negalite padėti sau.
	</div>
	<div class="alert nemokinys">
		<span class="closebtn">&times;</span>  
		<strong>Veiksmas atlikta negalima</strong> Mokiniui nebuvo pranešta apie Jūsų susidomėjimą.
	</div>
	<div class="alert nepasalinu">
  		<span class="closebtn">&times;</span>  
  		<strong>Veiksmo atlikti nepavyko</strong> Užklausimo pašalinti nepavyko.
	</div>
	<div class="alert nesukuriu">
  		<span class="closebtn">&times;</span>  
  		<strong>Veiksmo atlikti nepavyko</strong> Užklausimo sukurti nepavyko.
	</div>
              
    <div class="alert nesukuriu_rasmenys">
  		<span class="closebtn">&times;</span>  
  		<strong>Veiksmo atlikti nepavyko</strong> Užklausimo sukurti nepavyko dėl panaudotų neleistinų simbolių.
	</div>

	<div class="alert negrazinu">
  		<span class="closebtn">&times;</span>  
  		<strong>Veiksmo atlikti nepavyko</strong> Užklausimo grąžinti nepavyko.
	</div>

	<div class="alert nepatvirtinu">
  		<span class="closebtn">&times;</span>  
  		<strong>Veiksmo atlikti nepavyko</strong> Paaiškinimo patvirtinti nepavyko.
	</div>

	<div class="alert nepakeiciu">
  		<span class="closebtn">&times;</span>  
  		<strong>Veiksmo atlikti nepavyko</strong> Duomenų pakeisti nepavyko.
	</div>
              
    <div class="alert vyresnis">
  		<span class="closebtn">&times;</span>  
  		<strong>Veiksmo atlikti nepavyko</strong> Jūs negalite paaiškinti vyresniam gimnazijos mokiniui/-ei.
	</div>


	<div class="titulinis">
		
		<h1>Trumpai apie viską ....</h1>
		<br>
		<br>
		<h5>VDU UKG Žinių mainai - tai programa, kurios pagalba galite ne tik rasti atsakymus į Jums rūpimus mokymosi klausimus, bet ir gauti socialinių valandų.</h5>
		<br>
		<h3> Instrukcija</h3>
		<span> </span>
		<p> Norint sukurti užklausimą, Jums tereikia paspausti ant mygtuko „Sukurti“ ir pasirinkus dalyką, ir parašius temą, paspausti „Pateikti“.</p>
		<span>  </span>
		<p> Jūsų sukurtus užklausimus galite rasti skiltyje „Mano“, taip pat čia Jūs galite juos pašalinti paspausdę mygtuką „Pašalinti“.</p>
		<span> </span>
		<p> Jei Jūs norite padėti, pasirinkę norima klasę juostoje, bei užklausimą, paspauskite „Aš galiu paaiškinti“, programa automatiškai el. paštu informuos užklausimo kūrėją apie Jūsų susidomėjimą.</p> 
		<span> </span>
		<p> Jeigu Jūs jau padėjote, nepamirškite patvirtinti paaiškinimo, kad gautumėte socialines valandas, tai galite padaryti skiltyje „Patvirtinti“ ir pasirinkus tam tikrą užklausimo patvirtinimą paspausti mygtuką „Patvirtinti“.</p>
		<span> </span>
		<p> Jeigu Jūs netyčia paspaudėte užklausimo mygtuką „Aš galiu paaiškinti“, juostos skiltyje „Patvirtinti“ pasirinkite tą užklausimą, kuriame suklydote ir paspauskite „Grąžinti“.</p>
		<br>
		<h2> Jei iškilo techninės kliūtys, susisiekite el. paštu : <a style="text-decoration:none;" href="mailto:pagalba@bkworks.lt" target="_blank"><strong>pagalba@bkworks.lt</strong></a></h2>
		<br>
		<h2> Šaunaus tarpusavio bendradarbiavimo. Kūrėjas</h2>

	</div>

	<div class="student_info" style="background-color:white; font-family: 'Roboto', sans-serif;">
		<h5><strong>Vardas: </strong><?php echo $vardas;?></h5>
		<h5><strong>Pavardė: </strong><?php echo $pavarde;?></h5>
		<h5><strong>El. paštas: </strong><?php echo $mokinioEL;?></h5>
		<h5><strong>Auklėtojas/Kuratorius: </strong><?php echo $mokytojo_vardas1;echo " ";echo $mokytojo_pavarde1;?></h5>
		<h5><strong>Slaptažodis: </strong><?php echo $slaptazodis;?></h5>
		<br>
		<br>
		<!--<form class="change_email" action="change.php" method="POST">
			<input name='change1' style="display:none;" type="text" value='</?php echo $mokinio_ID;?>'></input>
			<input name='change2' class="form-control" type="text" placeholder="Įveskite naują el. paštą"></input>
			<br>
			<button style="justify:center;" class=" navbar-brand btn btn-outline-success" type="submit">Keisti</button>
		</form>
		<br>-->
		<form class="change_email" action="password.php" method="POST">
			<input name='change_pass_1' style="display:none;" type="text" value='<?php echo $mokinio_ID;?>'></input>
			<input name='change_pass_2' class="form-control" type="text" placeholder="Įveskite naują slaptažodį"></input>
			<br>
			<button style="justify:center;" class=" navbar-brand btn btn-outline-success" type="submit">Keisti</button>
		</form>
	</div>



	<!-- Mano užklausimų vaizdavimui -->
	<?php 
		for ($i=1; $i<=$skaicius; $i=$i+1){
	?>
	<form class='tikmano'action="remove.php" method="POST">
		<div class="card" style="width: 18rem; margin: 20px;">
			<div class="card-body">
				<input type="text" name="code1" class="card-text inputas1" value='<?php echo $ID[$i]?>'></input>
				<h5 class="card-title"><?php echo $dalykai[$i]?></h5>
				<p class="card-text"><?php echo $temos[$i] ?></p>
				<button type="submit" class="btn btn-success patvirtinti">Pašalinti</button>
				<h6 class="card-text" ><small>ID : <?php echo $ID[$i]?></small></h6>
			</div>
		</div>
	</form>
    <?php } ?>

	<!--Klasių užklausimų vaizdavimui -->
	<?php 
		for ($y=1; $y<=$skaicius1; $y=$y+1){
	?>
	<form class='kitu' action="email.php" method="POST">
		<div class="card" style="width: 20rem; margin: 20px;">
			<div class="card-body">
				<input type="text" name="code" class="card-text inputas2" value='<?php echo $ID1[$y]?>'></input>
				<h5 class="card-title"><?php echo $dalykai1[$y]?></h5>
				<p class="card-text"><?php echo $temos1[$y] ?></p>
				<button type="submit" class="btn btn-success patvirtinti">Aš galiu paaiškinti</button>
				<h6 class="card-text" ><small>ID : <?php echo $ID1[$y]?></small></h6>
				<h6 class="card-text" ><small>Sukūrė ID : <?php echo $sukure1[$y]?></small></h6>
			</div>
		</div>
	</form>
	<?php } ?>


	<!--Patvirtimų vaizdavimui -->		
	<?php 
		for ($u=1; $u<=$skaicius2; $u=$u+1){
	?>
	<form class='patvirtinimai' action="confirm.php" method="POST">
		<div class="card" style="width: 20rem; margin: 20px;">
				<div class="card-body">
					<input type="text" name="code2" class="card-text inputas4" value='<?php echo $confirmID[$u]?>'></input>
					<h5 class="card-title"><?php echo $questionSubject[$u]?></h5>
					<p class="card-text"><?php echo $questionDiscipline[$u] ?></p>
					<button value="tvirtinu" name="pat_action" type="submit" class="btn btn-success patvirtinti">Patvirtinti</button>
					<button value="grazinu" name="pat_action" type="submit" class="btn btn-success patvirtinti">Grąžinti</button>
					<h6 class="card-text" ><small>ID : <?php echo $confirmID[$u]?></small></h6>
					<h6 class="card-text" ><small>Užklausimo ID : <?php echo $questionID[$u]?></small></h6>
				</div>
			</div>
	</form>
	<?php } ?>
	
	<!-- Užklausimo sukūrimo forma -->
	<form class="forma2" method="POST" action="sukurti.php">
		<select class="form-control form-control-lg" name="dalykas">
				<option selected>Pasirinkite dalyką</option>
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
		<input class="form-control form-control-lg" type="text" name="tema" placeholder="Nesuprantamo dalyko tema">
		<br>
		<button id="pateikti2" type="submit" class="btn btn-success">Pateikti</button>
	</form>

	<div class="footer">
  		<p id="apacia"></p>
	</div>


</body>
</html>