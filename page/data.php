<?php 
	//ühendan sessiooniga
	require("../functions.php");
	
	//kui ei ole sisseloginud, suunan login lehele
	if (!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}
	
	//kas aadressireal on logout
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
		
	}
	
	
	if ( isset($_POST["ad_price"]) && 
		 isset($_POST["ad_text"]) && 
		 isset($_POST["ad_name"]) && 
		 !empty($_POST["ad_price"]) &&
		 !empty($_POST["ad_text"]) &&
		 !empty($_POST["ad_name"]) 
	) {
		
		
		$ad_text = $Helper->cleanInput($_POST["ad_text"]);
		$ad_name = $Helper->cleanInput($_POST["ad_name"]);
		
		$Event->saveEvent($Helper->cleanInput($_POST["ad_price"]), $ad_text, $ad_name);
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
	
	
	echo "<pre>";
	var_dump($people[0]);
	echo "</pre>";
	
?>

<?php require("../header.php"); ?>
<h1>Data</h1>

<?php echo $_SESSION["userEmail"];?>

<?=$_SESSION["userEmail"];?>

<p>
	Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?></a>!
	<a href="?logout=1">logi välja</a>
</p>

<h2>Salvesta sündmus</h2>
<form method="POST" >
	
	<label>Toote nimetus</label><br>
	<input name="ad_name" type="text">
	<br><br>
	
	<label>Hind</label><br>
	<input name="ad_price" type="text">
	
	<br><br>
	<label>Kirjeldus</label><br>
	<input name="ad_text" type="text">
	
	<br><br>
	
	<input type="submit" value="Salvesta">

</form>


<h2>Arhiiv</h2>

<form>
	<input type="search" name="q" value="<?=$q;?>">
	<input type="submit" value="Otsi">
</form>

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
		
			$html .= "<th>
						<a href='?q=".$q."&sort=id&order=".$orderId."'>
							ID ".$arr."
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
					 
			$html .= "<th>Edit</th>";
		$html .= "</tr>";
		
		
		//iga liikme kohta massiivis
		foreach ($people as $p) {
			
			$html .= "<tr>";
				$html .= "<td>".$p->id."</td>";
				$html .= "<td>".$p->ad_name."</td>";
				$html .= "<td>".$p->ad_price."</td>";
				$html .= "<td>".$p->ad_text."</td>";
                $html .= "<td><a class='btn btn-default btn xc' href='edit.php?id=".$p->id."'>
				<span class='glyphicon glyphicon-pencil'></span> Muuda
				</a>
				</td>";
			$html .= "</tr>";
		
		}
		
	$html .= "</table>";
	
	echo $html;
?>

<?php require("../footer.php"); ?>


