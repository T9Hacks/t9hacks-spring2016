<?php

include '../hidden/db-info.php';

class DBHelperClass {
	var $conn = null;
	
	function __construct() {
		
		try {
			/*
			$this->conn = new PDO("mysql: host=localhost; dbname=$dbname", $username ,$password);
			// set the PDO error mode to exception
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected successfully"; 
			*/
			
			$sqlFile = 'sqlite:../../protected/db.sqlite';
			
			$this->conn = new PDO($sqlFile, "", "");
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected successfully";
			
		} catch(PDOException $e) {
			//echo "Connection failed: <pre>" . print_r($e, true) . '</pre>';
		}
		//die();
	}
	
	function addParticipant($inputValues, $key) {
		// prepare statement
		$prepStmt = "INSERT INTO `t9hacks_participants` 
				(`key`, `name`, `email`, `college`, `major`, `phone`, `linkedin`, `resume`, `website`, `github`, `company`, `position`, `facebook`, `twitter`, `shirt`) 
				VALUES (:key, :name, :email, :college, :major, :phone, :linkedin, :resume, :website, :github, :company, :position, :facebook, :twitter, :shirt)";
		$stmt = $this->conn->prepare($prepStmt);
		$stmt->bindParam(':key', 		$key);
		$stmt->bindParam(':name', 		$inputValues['name']);
		$stmt->bindParam(':email', 		$inputValues['email']);
		$stmt->bindParam(':college', 	$inputValues['college']);
		$stmt->bindParam(':major', 		$inputValues['major']);
		$stmt->bindParam(':phone', 		$inputValues['phone']);
		$stmt->bindParam(':linkedin', 	$inputValues['linkedin']);
		$stmt->bindParam(':resume', 	$inputValues['resume']);
		$stmt->bindParam(':website', 	$inputValues['website']);
		$stmt->bindParam(':github',		$inputValues['github']);
		$stmt->bindParam(':company', 	$inputValues['company']);
		$stmt->bindParam(':position', 	$inputValues['position']);
		$stmt->bindParam(':facebook',	$inputValues['facebook']);
		$stmt->bindParam(':twitter', 	$inputValues['twitter']);
		$stmt->bindParam(':shirt', 		$inputValues['shirt']);
		
		// use exec() because no results are returned
		$stmt->execute();
		
		// echo a message to say the UPDATE succeeded
		$updateCount = $stmt->rowCount();
		return($updateCount>0);
	}
	
	function addMentor($inputValues, $key) {
		// prepare statement
		$prepStmt = "INSERT INTO `t9hacks_mentors` 
				(`key`, `name`, `email`, `phone`, `company`, `position`, `breakfast`, `lunch`, `dinner`, `area_web_design`, `area_web_dev`, `area_android`, `area_ios`, `area_uiux`, `area_gaming`, `area_print`, `area_arduino`)  
				VALUES (:key, :name, :email, :phone, :company, :position, :breakfast, :lunch, :dinner, :area_web_design, :area_web_dev, :area_android, :area_ios, :area_uiux, :area_gaming, :area_print, :area_arduino)";
		$stmt = $this->conn->prepare($prepStmt);
		$stmt->bindParam(':key', 			$key);
		$stmt->bindParam(':name', 			$inputValues['name']);
		$stmt->bindParam(':email', 			$inputValues['email']);
		$stmt->bindParam(':phone', 			$inputValues['phone']);
		$stmt->bindParam(':company', 		$inputValues['company']);
		$stmt->bindParam(':position', 		$inputValues['position']);
		$stmt->bindParam(':breakfast',		$inputValues['breakfast']);
		$stmt->bindParam(':lunch', 			$inputValues['lunch']);
		$stmt->bindParam(':dinner', 		$inputValues['dinner']);
		$stmt->bindParam(':area_web_design',$inputValues['webDesign']);
		$stmt->bindParam(':area_web_dev',	$inputValues['webDev']);
		$stmt->bindParam(':area_android',	$inputValues['android']);
		$stmt->bindParam(':area_ios',		$inputValues['iOS']);
		$stmt->bindParam(':area_uiux',		$inputValues['uiux']);
		$stmt->bindParam(':area_gaming',	$inputValues['gaming']);
		$stmt->bindParam(':area_print',		$inputValues['print']);
		$stmt->bindParam(':area_arduino',	$inputValues['arduino']);
		
		// use exec() because no results are returned
		$stmt->execute();
		
		// echo a message to say the UPDATE succeeded
		$updateCount = $stmt->rowCount();
		return($updateCount>0);
	}
	
	
	
	// getters for view page
	function getParticipants() {
		// get all participants
		$stmt = $this->conn->prepare("SELECT * FROM `t9hacks_participants`"); 
		
		// run
		$stmt->execute();
		
		// store data in array
		$participants = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			$participants[] = $row;
		}
		
		return $participants;
	}
	
	function getMentors() {
		// get all mentors
		$stmt = $this->conn->prepare("SELECT * FROM `t9hacks_mentors`"); 
		
		// run
		$stmt->execute();
		
		// store data in array
		$participants = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			$participants[] = $row;
		}
		
		return $participants;
	}
	
	
	
	function participantEmailRegistered($email) {
		$sql = "SELECT COUNT(*) AS c FROM `t9hacks_participants` WHERE `email` = :email";
		return $this->emailRegistered($email, $sql);
	}
	
	function mentorEmailRegistered($email) {
		$sql = "SELECT COUNT(*) AS c FROM `t9hacks_mentors` WHERE `email` = :email";
		return $this->emailRegistered($email, $sql);
	}
	
	function emailRegistered($email, $sql) {
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':email', $email);
		
		// run
		$stmt->execute();
		
		// store data in array
		$pCount = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			$pCount = $row;
		}
		
		//print_r($pCount); die();
		// test if email used
		return ($pCount["c"] != 0);
	}
	
	
	
	function close() {
		$conn = null;
	}
	
}