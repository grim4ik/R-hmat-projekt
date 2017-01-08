<?php
class Event {
    
    private $connection;
	
	function __construct($mysqli){
		$this->connection = $mysqli;
	}
	
		
	function saveEvent($ad_price, $ad_text, $ad_name, $ad_tuup, $ad_people, $ad_phone) {
				
		$stmt = $this->connection->prepare("INSERT INTO rt_ad (ad_price, ad_text, ad_name, ad_tuup, ad_people, ad_phone) VALUE (?, ?, ?, ?, ?, ?)");
		echo $this->connection->error;
		
		$stmt->bind_param("isssss", $ad_price, $ad_text, $ad_name, $ad_tuup, $ad_people, $ad_phone);
		
		if ( $stmt->execute() ) {
			echo "õnnestus";
		} else {
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	function getAllPeople($q, $sort, $order) {
		
		$allowedSort = ["id", "ad_price", "ad_text", "ad_name", "ad_tuup", "ad_people", "ad_phone"];
		
		// sort ei kuulu lubatud tulpade sisse 
		if(!in_array($sort, $allowedSort)){
			$sort = "id";
		}
		
		$orderBy = "ASC";
		
		if($order == "DESC") {
			$orderBy = "DESC";
		}
		
		echo "Sorteerin: ".$sort." ".$orderBy." ";
		
		
		if ($q != "") {
			//otsin
			echo "otsin: ".$q;
			
			$stmt = $this->connection->prepare("
				SELECT id, ad_price, ad_text, ad_name, ad_tuup, ad_people, ad_phone
				FROM rt_ad
				WHERE deleted IS NULL
				AND ( age LIKE ? OR color LIKE ? )
				ORDER BY $sort $orderBy
			");
			
			$searchWord = "%".$q."%";
			
			$stmt->bind_param("ss", $searchWord, $searchWord);
			
		} else {
			// ei otsi
			$stmt = $this->connection->prepare("
				SELECT id, ad_price, ad_text, ad_name, ad_tuup, ad_people, ad_phone
				FROM rt_ad
				WHERE deleted IS NULL
				ORDER BY $sort $orderBy
			");
		}
		
		$stmt->bind_result($id, $ad_price, $ad_text, $ad_name, $ad_tuup, $ad_people, $ad_phone);
		$stmt->execute();
		
		$results = array();
		
		// tsükli sisu tehakse nii mitu korda, mitu rida
		// SQL lausega tuleb
		while ($stmt->fetch()) {
			
			$human = new StdClass();
			$human->id = $id;
			$human->ad_price = $ad_price;
			$human->ad_text = $ad_text;
			$human->ad_name = $ad_name;
			$human->ad_tuup = $ad_tuup;
			$human->ad_people = $ad_people;
			$human->ad_phone = $ad_phone;
			
			
			
			//echo $color."<br>";
			array_push($results, $human);
			
		}
		
		return $results;
		
	}
	
	
	function getSinglePerosonData($edit_id){
    
		
		$stmt = $this->connection->prepare("SELECT ad_price, ad_text, ad_name, ad_tuup, ad_people, ad_phone FROM rt_ad WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($ad_price, $ad_text, $ad_name, $ad_tuup, $ad_people, $ad_phone);
		$stmt->execute();
		
		//tekitan objekti
		$p = new Stdclass();
		
		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$p->ad_price = $ad_price;
			$p->ad_text = $ad_text;
			$p->ad_name = $ad_name;
			$p->ad_tuup = $ad_tuup;
			$p->ad_people = $ad_people;
			$p->ad_phone = $ad_phone;
			
			
		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
			header("Location: data.php");
			exit();
		}
		
		$stmt->close();
		
		return $p;
		
	}
	function updatePerson($id, $ad_price, $ad_text, $ad_name, $ad_tuup, $ad_people, $ad_phone){
    			
		$stmt = $this->connection->prepare("UPDATE rt_ad SET ad_price=?, ad_text=?, ad_name=?, ad_tuup=?, ad_people=?, ad_phone=? WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("isissss",$ad_price, $ad_text, $ad_name, $ad_tuup, $ad_people, $ad_phone, $id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		
		$stmt->close();
		
	}
	
	function deletePerson($id){
    	
        $database = "if16_kirikotk_4";		
		
		$stmt = $this->connection->prepare("
		UPDATE rt_ad SET deleted=NOW()
		WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("i",$id);
		
		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}
		
		$stmt->close();
		
	}
	
	
}
?>