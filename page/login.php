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
	
	
		// otsib
	if (isset($_GET["q"])) {
		
		$q = $_GET["q"];
	
	} else {
		//ei otsi
		$q = "";
	}
	
	//vaikimisi, kui keegi mingit linki ei vajuta
	$sort = "id";
	$order = "ASC";
	
	if (isset($_GET["sort"]) && isset($_GET["order"])) {
		$sort = $_GET["sort"];
		$order = $_GET["order"];
	}
	
	$people = $Event->getAllPeople($q, $sort, $order);
	
	
?>

<h1>Rentimine</h1>

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
<h2>Arhiiv</h2>

<?php 
	
	$html = "<table class='table table-striped table-condensed'>";
	
		$html .= "<tr>";
		
			$orderId = "ASC";
			$arr="&darr;";
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" &&
				$_GET["sort"] == "id" ) {
					
				$orderId = "DESC";
				$arr="&uarr;";
			}
		
					 
			
			$orderAd_tuup = "ASC";
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" &&
				$_GET["sort"] == "ad_tuup" ) {
					
				$orderAd_tuup = "DESC";
			}
		
			$html .= "<th>
						<a href='?q=".$q."&sort=ad_tuup&order=".$orderAd_tuup."'>
							Toote tuup
						</a>
					 </th>";	 
			
			$orderAd_name = "ASC";
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" &&
				$_GET["sort"] == "ad_name" ) {
					
				$orderAd_name = "DESC";
			}
		
			$html .= "<th>
						<a href='?q=".$q."&sort=ad_name&order=".$orderAd_name."'>
							Toote nimetus
						</a>
					 </th>";
			
			
			$orderAd_price = "ASC";
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" &&
				$_GET["sort"] == "ad_price" ) {
					
				$orderAd_price = "DESC";
			}
		
			$html .= "<th>
						<a href='?q=".$q."&sort=ad_price&order=".$orderAd_price."'>
							Hind
						</a>
					 </th>";
					 
			$orderAd_text = "ASC";
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" &&
				$_GET["sort"] == "ad_text" ) {
					
				$orderAd_text = "DESC";
			}
		
			$html .= "<th>
						<a href='?q=".$q."&sort=ad_text&order=".$orderAd_text."'>
							Kirjeldus
						</a>
					 </th>";
					 
			
			$orderAd_people = "ASC";
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" &&
				$_GET["sort"] == "ad_people" ) {
					
				$orderAd_people = "DESC";
			}
		
			$html .= "<th>
						<a href='?q=".$q."&sort=ad_people&order=".$orderAd_people."'>
							Nimi
						</a>
					 </th>";
					 
			$orderAd_phone = "ASC";
			if (isset($_GET["order"]) && 
				$_GET["order"] == "ASC" &&
				$_GET["sort"] == "ad_phone" ) {
					
				$orderAd_phone = "DESC";
			}
		
			$html .= "<th>
						<a href='?q=".$q."&sort=ad_phone&order=".$orderAd_phone."'>
							Telefoni number
						</a>
					 </th>";
					 
		$html .= "</tr>";
		
		
		//iga liikme kohta massiivis
		foreach ($people as $p) {
			
			$html .= "<tr>";
				$html .= "<td>".$p->ad_tuup."</td>";
				$html .= "<td>".$p->ad_name."</td>";
				$html .= "<td>".$p->ad_price."</td>";
				$html .= "<td>".$p->ad_text."</td>";
				$html .= "<td>".$p->ad_people."</td>";
				$html .= "<td>".$p->ad_phone."</td>";
			$html .= "</tr>";
		
		}
		
	$html .= "</table>";
	
	echo $html;
?>


<?php require("../footer.php"); ?>