<?php 
	var_dump($_POST);
	var_dump(isset($_POST["signupEmail"]));
	
	
	require("../functions.php");
	
	// kui on sisseloginud siis suunan data lehele
	if (isset($_SESSION["userId"])) {
		header("Location: data.php");
		exit();
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
	
		<div class="col-sm-4 col-md-3">

		<h1>Logi sisse</h1>
		<p style="color:red;"><?=$notice;?></p>
		<form method="POST" >
			
			<div class="form-group">
				<input class="form-control" placeholder="E-post" name="loginEmail" type="email">
			</div>
			
			<div class="form-group">
				<input class="form-control" name="loginPassword" placeholder="Parool" type="password">
			</div>
			
			
			<input class="btn btn-primary btn-sm hidden-xs" type="submit" value="Logi sisse 1">
			<input class="btn btn-primary btn-sm btn-block visible-xs-block" type="submit" value="Logi sisse 2">
			<a class="btn btn-primary btn-sm hidden-xs" href="reg.php">Loo kasutaja</a>
			<a class="btn btn-primary btn-sm btn-block visible-xs-block" href="reg.php">Loo kasutaja</a>
		
		</form>
		</div>
		
		<div class="col-sm-4 col-sm-offset-2 col-md-3 col-md-offset-3">
		
		

	</body>
</html>
</div>
</div>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
require_once '/home/kirikotk/config.php'; 
 
$link = mysqli_connect($serverHost, $serverUsername, $serverPassword, $database) 
    or die("Error " . mysqli_error($link)); 
     
$query ="SELECT ad_name, ad_price, ad_text FROM rt_ad";
 
$result = mysqli_query($link, $query) or die("Error " . mysqli_error($link)); 
if($result)
{
    $rows = mysqli_num_rows($result);
     
    echo "<table><tr><th>Toote nimetus</th><th>Hind</th><th>Kirjeldus</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 3 ; ++$j) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";
     
    mysqli_free_result($result);
}
 
mysqli_close($link);
?>
</body>
</html>


<?php require("../footer.php"); ?>