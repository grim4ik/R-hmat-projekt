<?php 
	var_dump($_POST);
	var_dump(isset($_POST["signupEmail"]));
	
	
	require("../functions.php");
	
	// kui on sisseloginud siis suunan data lehele
	if (isset($_SESSION["userId"])) {
		header("Location: data.php");
		exit();
	}
	
	//var_dump($_GET);
	
	//echo "<br>";
	
	//var_dump($_POST);
	
	//MUUTUJAD
	$signupEmailError = "*";
	$signupEmail = "";
	
	//kas keegi vajutas nuppu ja see on olemas
	
	if (isset ($_POST["signupEmail"])) {
		
		//on olemas
		// kas epost on tühi
		if (empty ($_POST["signupEmail"])) {
			
			// on tühi
			$signupEmailError = "* Väli on kohustuslik!";
			
		} else {
			// email on olemas ja õige
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	} 
	
	$signupPasswordError = "*";
	
	if (isset ($_POST["signupPassword"])) {
		
		if (empty ($_POST["signupPassword"])) {
			
			$signupPasswordError = "* Väli on kohustuslik!";
			
		} else {
			
			// parool ei olnud tühi
			
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "* Parool peab olema vähemalt 8 tähemärkki pikk!";
				
			}
			
		}
		
	$signupUsernameError = "*";
	$signupUsername = "";
	
	//kas keegi vajutas nuppu ja see on olemas
	
	if (isset ($_POST["signupUsername"])) {
		
		//on olemas
		// kas epost on tühi
		if (empty ($_POST["signupUsername"])) {
			
			// on tühi
			$signupUsername = "* Väli on kohustuslik!";
			
		} else {
			// email on olemas ja õige
			$signupUsername = $_POST["signupUsername"];
			
		}
		
	}
	
	$signupNameError = "*";
	$signupName = "";
	
	//kas keegi vajutas nuppu ja see on olemas
	
	if (isset ($_POST["signupName"])) {
		
		//on olemas
		// kas epost on tühi
		if (empty ($_POST["signupName"])) {
			
			// on tühi
			$signupNameError = "* Väli on kohustuslik!";
			
		} else {
			// email on olemas ja õige
			$signupName = $_POST["signupName"];
			
		}
		
	}
	
		$signupSurnameError = "*";
	$signupSurname = "";
	
	//kas keegi vajutas nuppu ja see on olemas
	
	if (isset ($_POST["signupSurname"])) {
		
		//on olemas
		// kas epost on tühi
		if (empty ($_POST["signupSurname"])) {
			
			// on tühi
			$signupSurnameError = "* Väli on kohustuslik!";
			
		} else {
			// email on olemas ja õige
			$signupSurname = $_POST["signupSurname"];
			
		}
		
	}
	
			$signupPhoneError = "*";
	$signupPhone = "";
	
	//kas keegi vajutas nuppu ja see on olemas
	
	if (isset ($_POST["signupPhone"])) {
		
		//on olemas
		// kas epost on tühi
		if (empty ($_POST["signupPhone"])) {
			
			// on tühi
			$signupPhoneError = "* Väli on kohustuslik!";
			
		} else {
			// email on olemas ja õige
			$signupPhone = $_POST["signupSPhone"];
			
		}
		
	}
		
		/* GENDER */
		
		if (!isset ($_POST["gender"])) {
			
			//error
		}else {
			// annad väärtuse
		}
		
	}
	
	//vaikimisi väärtus
	$gender = "";
	
	if (isset ($_POST["gender"])) {
		if (empty ($_POST["gender"])) {
			$genderError = "* Väli on kohustuslik!";
		} else {
			$gender = $_POST["gender"];
		}
		
	} 
	
	
	
	
	if ( $signupEmailError == "*" AND
		 $signupPasswordError == "*" &&
		 $signupUsernameError == "*" &&
		 $signupNameError == "*" &&
		 $signupSurnameError == "*" &&
		 $signupPhoneError == "*" &&
		 isset($_POST["signupEmail"]) &&
		isset($_POST["signupPassword"]) &&
		isset($_POST["signupUsername"]) &&
		isset($_POST["signupName"]) &&
		isset($_POST["signupSurname"]) &&		 
		 isset($_POST["signupPPhone"]) 
	  ) {
		
		//vigu ei olnud, kõik on olemas	
		echo "Salvestan...<br>";
		echo "email ".$signupEmail."<br>";
		echo "Login ".$signupUsername."<br>";
		echo "Nimi ".$signupName."<br>";
		echo "Perekonnanimi ".$signupSurname."<br>";
		echo "Telefoni number ".$signupPhone."<br>";
		echo "parool ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo $password."<br>";
		
		$User->signup($signupEmail, $password, $signupUsername, $signupName, $signupSurname, $signupPhone);
		
		
	}
	
	$notice = "";
	//kas kasutaja tahab sisse logida
	if ( isset($_POST["loginEmail"]) && 
		 isset($_POST["loginPassword"]) && 
		 !empty($_POST["loginEmail"]) &&
		 !empty($_POST["loginPassword"]) 
	) {
		
		$notice = $User->login($_POST["loginEmail"], $_POST["loginPassword"]);
		
	}

?>
<?php require("../header.php"); ?>

<div class="container"> 
	<div class="row">
		
		<div class="col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3">
		<h1>Loo kasutaja</h1>
		
		<form method="POST" >
			
			<input name="signupEmail" placeholder="E-post" type="email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
			
			<br><br>
			
			<input name="signupUsername" placeholder="Login" type="login" value="<?=$signupUsername;?>"> <?php echo $signupUsernameError; ?>
			
			<br><br>

			<input name="signupPassword" placeholder="Parool" type="password"> <?php echo $signupPasswordError; ?>
			
			<br><br>
			
			<input name="signupName" placeholder="Nimi" type="name" value="<?=$signupName;?>"> <?php echo $signupNameError; ?>
			
			<br><br>
			
			<input name="signupSurname" placeholder="Perekonnanimi" type="surname" value="<?=$signupSurname;?>"> <?php echo $signupSurnameError; ?>
			
			<br><br>
			
			<input name="signupPhone" placeholder="Telefoni number" type="phone" value="<?=$signupPhone;?>"> <?php echo $signupPhoneError; ?>
			
			<br><br>
					

			
			<input class="btn btn-primary btn-sm" type="submit" value="Loo kasutaja">
			<p><a href="login.php"><-Tagasi</a></p>
		
		</form>
		</div>

	</body>
</html>
</div>
</div>

<?php require("../footer.php"); ?>