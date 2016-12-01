<?php
	//edit.php
	require("../functions.php");
	
	if(isset($_GET["delete"]) && isset($_GET["id"])) {
		// kustutan
		
		$Event->deletePerson($Helper->cleanInput($_GET["id"]));
		header("Location: data.php");
		exit();
	}
	
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		$Event->updatePerson(cleanInput($_POST["id"]), $Helper->cleanInput($_POST["ad_name"]), $Helper->cleanInput($_POST["ad_price"]), $Helper->cleanInput($_POST["ad_text"]));
		
		header("Location: edit.php?id=".$_POST["id"]."&success=true");
        exit();	
		
	}
	
	//saadan kaasa id
	$p = $Event->getSinglePerosonData($_GET["id"]);
	var_dump($p);
	
?>
<?php require("../header.php"); ?>
<br><br>
<a href="data.php"> tagasi </a>

<h2>Muuda kirjet</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["id"];?>" > 
	<label for="ad_name" >Toote nimetus</label><br>
	<input id="ad_name" name="name" type="text" value="<?php echo $p->ad_name;?>" ><br><br>
  	<label for="ad_price" >Hind</label><br>
	<input id="ad_price" name="price" type="text" value="<?php echo $p->ad_price;?>" ><br><br>
  	<label for="ad_text" >Kirjeldus</label><br>
	<input id="ad_text" name="text" type="text" value="<?php echo $p->ad_text;?>" ><br><br>
  	
	<input type="submit" name="update" value="Salvesta">
  </form>
  
  <a href="?id=<?=$_GET["id"];?>&delete=true">kustuta</a>
  
<?php require("../footer.php"); ?>