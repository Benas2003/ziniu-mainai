<!doctype html>
<html lang="lt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VDU UKG Žinių mainai</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="shortcut icon" href="REIKALINGI/favicon.ico" type="image/x-icon">
	<link rel="icon" href="REIKALINGI/favicon.ico" type="image/x-icon">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="bootbox.min.js"></script>
    <script src="bootbox.locales.min.js"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet"> 
	<style>
	/*Stiliai*/
	body{

	font-family: 'Roboto', sans-serif;
	color: #001f3f;
	}
	body, html {
  	height: 100%;
	}
	.bg-image{
	background-image: url("REIKALINGI/Gimnazija.png");
  
	filter: blur(8px);
	-webkit-filter: blur(8px);
	height: 100%; 
	
	background-position: center;
	background-repeat: no-repeat;
	background-size: cover;
    }
}

</style>

</head>
<body>
<div class="bg-image"></div>

<script>

<?php
	//Duomenų perdavimas

	session_start();
	$vardas=$_SESSION['vrd'];
	$pavarde=$_SESSION['pvr'];
	$naujo_mokinioSLP=$_SESSION['ss'];
	$naujo_mokinioPASTAS=$_SESSION['ss1'];
	$_SESSION['sss']=$naujo_mokinioSLP;
	$_SESSION['sss1']=$naujo_mokinioPASTAS;
?>


$(document).ready(function(){
	$("#neteisingai").hide();
	$("#neteisingai1").hide();
	$("#neteisingai2").hide();
	$(".forma1").hide();
	$(".forma3").hide();
	$(".forma5").hide();
	$(".forma6").hide();
	$("#apie").hide();
	document.getElementById("metai").innerHTML= new Date().getFullYear();
	

    var str = window.location.href;
	
    $(pirmas).click(function(){
	document.getElementById("pradzia").style.display = "none"; 
	$( ".forma1" ).css( "display", "inline" );
	//$(".forma1").show();
	});

	$(antras).click(function(){
	document.getElementById("pradzia").style.display = "none"; 
	document.getElementById("apie").style.display = "inline"; 
	//$("#apie").show();
	});

	// Grįžimo mygtukai
	
	$(go_back1).click(function(){
	document.getElementById("pradzia").style.display = "inline"; 
	$( ".forma1" ).css( "display", "none" );
	//$(".forma1").hide();
	});

	$(go_back2).click(function(){
	document.getElementById("pradzia").style.display = "inline"; 
	$( ".forma5" ).css( "display", "none" );
	//$(".forma5").hide();
	});

	$(go_back3).click(function(){
	document.getElementById("pradzia").style.display = "inline"; 
	$( ".forma6" ).css( "display", "none" );
	//$(".forma6").hide();
	});

	$(go_back4).click(function(){
	document.getElementById("pradzia").style.display = "inline"; 
	$( ".forma3" ).css( "display", "none" );
	//$(".forma3").hide();
	});
	
	$(go_back5).click(function(){
	document.getElementById("pradzia").style.display = "inline"; 
	document.getElementById("apie").style.display = "none"; 
	//$("#apie").hide();
	});

    $(trecias).click(function(){
	document.getElementById("pradzia").style.display = "none"; 
	$( ".forma3" ).css( "display", "inline" );
	//$(".forma3").show();
	});

	$(ketvirtas).click(function(){
	document.getElementById("pradzia").style.display = "none"; 
	$( ".forma5" ).css( "display", "inline" );
	//$(".forma5").show();
	});

	$("#remind1").hover(function(){
	$(this).css("color", "#0e8fc7");
	}, function(){
	$(this).css("color", "white");
	});

	var vardas="";
	var pavarde="";
	vardas = "<?php echo $vardas ?>"; 
	pavarde = "<?php echo $pavarde ?>"; 

    // Apsauga nuo įsilaužėlių
	if((str.includes("Index.php?status=success")) && vardas== "" && pavarde == ""){
		$("#pradzia").hide();
		$(".forma1").show();
		$("#neteisingai").show();
	}
	if(str.includes("?status=fail")){
		$("#pradzia").hide();
		$(".forma1").show();
		$("#neteisingai").show();
	}
	if(str.includes("?OK=fail")){
		$("#pradzia").hide();
		$(".forma3").show();
		$("#neteisingai1").show();
	}
	// Ar vartotojo slaptažodis egzistuoja
	if(str.includes("?find=success")){
		$("#pradzia").hide();
		$(".forma6").show();
	}
	if(str.includes("?find=fail")){
		$("#pradzia").hide();
		$(".forma5").show();
		$("#neteisingai2").show();
	}
	// El. pašto įrašymo alertas
	if(str.includes("?login=success")){
     	bootbox.alert({
    	message: "Jūsų slaptažodis įsimintas. PASKYRA AKTYVUOTA",
        className: 'rubberBand animated',
        locale: 'lt',
        centerVertical: true,
    	backdrop: true
		});
	}
	if(str.includes("?login=fail")){
      	bootbox.alert({
    	message: "Kažkas atsitiko. Bandykite dar kartą.",
        className: 'rubberBand animated',
        locale: 'lt',
        centerVertical: true,
    	backdrop: true
		});
	}

	if(str.includes("?remind=no")){
      	bootbox.alert({
    	message: "Sistemoje neegzistuoja toks el. paštas. Bandykite dar kartą.",
        className: 'rubberBand animated',
        locale: 'lt',
        centerVertical: true,
    	backdrop: true
		});
	}

	if(str.includes("?sent")){
      	bootbox.alert({
    	message: "El. laiškas išsiųstas.",
        className: 'rubberBand animated',
        locale: 'lt',
        centerVertical: true,
    	backdrop: true
		});
	}

	if(str.includes("?remind=more")){
      	bootbox.alert({
    	message: "Kažkas atsitiko. Bandykite dar kartą.",
        className: 'rubberBand animated',
        locale: 'lt',
        centerVertical: true,
    	backdrop: true
		});
	}

	if(str.includes("?remind")){
	$(".priminti").css("display", "block");
	$("#pradzia").hide();
	$("#neteisingai").hide();
	$("#neteisingai1").hide();
	$("#neteisingai2").hide();
	$(".forma1").hide();
	$(".forma3").hide();
	$(".forma5").hide();
	$(".forma6").hide();
	$("#apie").hide();
	
	}

});
</script>
    <!-- Pradžia -->
    <div id="pradzia" class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Sveiki atvykę</h1>
			<p class="lead">į VDU Ugnės Karvelis gimnazijos Žinių mainus </p>
			<button id="pirmas" type="button" class="btn btn-info">Prisijungti</button>
			<button id="ketvirtas" type="button" class="btn btn-info">Prisijungti pirmą kartą</button>
			<button id="antras" type="button" class="btn btn-info">Apie programą</button>
			<button id="trecias" type="button" class="btn btn-info">Prisijungti administratoriui</button>
		</div>
	</div>


	 <!-- Mokinio prisijungimas -->
    <form id="form_1" class="forma1" method="POST" action="code.php">
		<p id="neteisingai"><strong>Duomenys įvesti neteisingai</strong></p>
		<div class="form-group">
		  <label for="exampleInputEmail1">El.paštas</label>
		  <input name="pastas" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
		</div>
		<div class="form-group">
		  <label for="exampleInputPassword1">Slaptažodis</label>
		  <input name="slap" type="password" class="form-control" id="exampleInputPassword1">
		</div>
		<a id="remind1" href="Prisijungimas.php?remind" style="text-decoration: none; color:white;"><h6>Pamiršai slaptažodį?</h6></a>
		<br>
		<button id="pateikti1" type="submit" class="btn btn-primary">Prisijungti</button>
		<a style="display:inline-block; font-size:0.87rem;" id="go_back1" class="btn btn-primary btn-lg" href="#" role="button">Grįžti</a>
	</form>

	<form class="priminti" method="POST" action="remind.php" style="display:none; background-color: rgb(0,0,0); background-color: rgba(0,0,0, 0.4); color: white; font-weight: bold; border: 3px solid #f1f1f1; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 2; width: 80%; padding: 20px; text-align:center; max-width: 250px; max-height: 600px; margin:0 auto;">
		<p style="display:none;" id="nerasta"><strong>Duomenys įvesti neteisingai</strong></p>
		<div class="form-group">
		  <label for="exampleInputEmail1">El.paštas</label>
		  <input name="remind_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
		</div>
		<button id="pateikti1" type="submit" class="btn btn-primary">Priminti</button>
		<a style="display:inline-block; font-size:0.87rem;" class="btn btn-primary btn-lg" href="Prisijungimas.php" role="button">Grįžti</a>
	</form>
	
	<form id="form_2" class="forma5" method="POST" action="naujas.php">
		<p id="neteisingai2"><strong>Duomenys įvesti neteisingai</strong></p>
		<div class="form-group">
		  <label for="exampleInputPassword1">Aktyvacijos kodas</label>
		  <input style="text-transform: uppercase" name="slap2" type="text" class="form-control" id="exampleInputPassword1">
		</div>
		<button id="pateikti4" value="2" name="n_vk" type="submit" class="btn btn-primary">Patvirtinti</button>
		<a style="display:inline-block; font-size:0.87rem;"  id="go_back2" class="btn btn-primary btn-lg" href="#" role="button">Grįžti</a>
	</form>

	<!-- Mokinio prisijungimas pirmą kartą -->
	<form id="form_3" class="forma6" method="POST" action='naujas.php'>
		<div class="form-group">
		  <label for="exampleInputEmail1">Naujas slaptažodis</label>
		  <input name="pastas2" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
		</div>
		<button id="pateikti4" value="3" name="n_vk" type="submit" class="btn btn-primary">Patvirtinti</button>
		<a style="display:inline-block; font-size:0.87rem;"  id="go_back3" class="btn btn-primary btn-lg" href="#" role="button">Grįžti</a>
	</form>



     <!-- Administratoriaus prisijungimas -->
	<form id="form_4" class="forma3" method="POST" action="admin.php">
		<span><strong>Sistemos administratoriaus prisijungimas</strong></span>
		<p></p>
		<p id="neteisingai1"><strong>Duomenys įvesti neteisingai</strong></p>
		<div class="form-group">
		  <label for="exampleInputEmail1">El.paštas</label>
		  <input name="pastas1" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
		</div>
		<div class="form-group">
		  <label for="exampleInputPassword1">Slaptažodis</label>
		  <input name="slap1" type="password" class="form-control" id="exampleInputPassword1">
		</div>
		<button id="pateikti1" type="submit" class="btn btn-primary">Prisijungti</button>
		<a style="display:inline-block; font-size:0.87rem;" id="go_back4" class="btn btn-primary btn-lg" href="#" role="button">Grįžti</a>
	</form>

	<!-- Apie -->
	<div id="apie" class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Apie</h1>
			<p class="lead">Programą sukūrė : Benas Kubilius</p>
			<p class="lead">Programa sukurta mokomaisiais tikslais, bei skirta gerinti mokinių socialinę veiklą</p>
			<p class="lead" style="display:inline">©Benas Kubilius, ©Vytauto Didžiojo universiteto Ugnės Karvelis gimnazija, </p>
			<p class="lead" id="metai" style="display:inline"></p>
			<br>
			<br>
			<p class="lead" >Versija : 2.4.0</p>
			<a style="display:block; width: 100px;" id="go_back5" class="btn btn-primary btn-lg" href="#" role="button">Grįžti</a>
		</div>
	</div>

</body>
</html>