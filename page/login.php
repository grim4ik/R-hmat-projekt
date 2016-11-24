<?php 
	var_dump($_POST);
	var_dump(isset($_POST["signupEmail"]));
	
	
	require("../functions.php");
	
	// kui on sisseloginud siis suunan data lehele
	if (isset($_SESSION["userId"])) {
		header("Location: data.php");
		exit();
	}
	
<<<<<<< HEAD
=======

>>>>>>> 3ab88b0058faaffb46fc5a19bbeaaeffc4305953
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

<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>

<div class="container"> 
	<div class="row">
	

	
		<div class="col-sm-4 col-md-3">

		<h1>Logi sisse</h1>
		<p style="color:red;"><?=$notice;?></p>
		<form method="POST" >
			
			<div class="form-group">
				<input class="form-control" placeholder="E-post" name="loginEmail" type="email">
			</div>
			
			<br>
			
			<div class="form-group">
				<input class="form-control" name="loginPassword" placeholder="Parool" type="password">
			</div>
			
			<br>
			
			<input class="btn btn-primary btn-sm hidden-xs" type="submit" value="Logi sisse 1">
			<input class="btn btn-primary btn-sm btn-block visible-xs-block" type="submit" value="Logi sisse 2">
			<a class="btn btn-primary btn-sm" href="reg.php">Loo kasutaja</a>
		
		</form>
		</div>
		
		<div class="col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3">

	</body>
</html>
</div>
</div>

<?php require("../footer.php"); ?>