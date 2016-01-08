<?php

class DBHelperClass {
	var $conn = null;
	
	function __construct() {
		
		try {
			$sqlFile = 'sqlite:../../protected/db.sqlite';
			
			$this->conn = new PDO($sqlFile, "", "");
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected successfully";
			
		} catch(PDOException $e) {
			//echo "Connection failed: <pre>" . print_r($e, true) . '</pre>';
		}
		
		// set correct time size
		date_default_timezone_set('America/Denver');
		//die();
	}
	
	function addParticipant($inputValues, $key, $isNew) {
		// get current datetime
		$datetime = date("Y-m-d H:i:s");
		
		// prepare statement
		if($isNew) {
			$prepStmt = "INSERT INTO `t9hacks_participants` 
				(
					`key`, 
					`name`, 
					`email`, 
					`college`, 
					`major`, 
					`phone`, 
					`linkedin`, 
					`resume`, 
					`website`, 
					`github`, 
					`company`, 
					`position`, 
					`facebook`, 
					`twitter`, 
					`shirt`, 
					`comment`, 
					`coc_agree`,
					`datetime`, 
					`complete`
				) 
				VALUES (
					:key, 
					:name, 
					:email, 
					:college, 
					:major, 
					:phone, 
					:linkedin, 
					:resume, 
					:website, 
					:github, 
					:company, 
					:position, 
					:facebook, 
					:twitter, 
					:shirt, 
					:comment, 
					:coc_agree, 
					:datetime, 
					1
				)";
		} else {
			$prepStmt = "UPDATE `t9hacks_participants` 
				SET `name` 		= :name, 
					`email` 	= :email, 
					`college`	= :college, 
					`major`		= :major, 
					`phone`		= :phone, 
					`linkedin`	= :linkedin, 
					`resume`	= :resume, 
					`website`	= :website, 
					`github`	= :github, 
					`company`	= :company, 
					`position`	= :position, 
					`facebook`	= :facebook, 
					`twitter`	= :twitter, 
					`shirt`		= :shirt, 
					`comment`	= :comment, 
					`coc_agree`	= :coc_agree,
					`datetime`	= :datetime, 
					`complete`	= 1 
				WHERE key = :key";
		}
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
		$stmt->bindParam(':comment',	$inputValues['comment']);
		$stmt->bindParam(':coc_agree',	$inputValues['agree']);
		$stmt->bindParam(':datetime', 	$datetime);
		
		// use exec() because no results are returned
		$stmt->execute();
		
		// echo a message to say the UPDATE succeeded
		$updateCount = $stmt->rowCount();
		return($updateCount>0);
	}
	
	function addParticipantFriend($inputValues, $key) {
		// get current datetime
		$datetime = date("Y-m-d H:i:s");
		
		// prepare statement
		$prepStmt = "INSERT INTO `t9hacks_participants` 
				(`key`, `name`, `email`, `datetime`, `complete`) 
				VALUES (:key, :name, :email, :datetime, 0)";
		$stmt = $this->conn->prepare($prepStmt);
		$stmt->bindParam(':key', 		$key);
		$stmt->bindParam(':name', 		$inputValues['name']);
		$stmt->bindParam(':email', 		$inputValues['email']);
		$stmt->bindParam(':datetime', 	$datetime);
		
		// use exec() because no results are returned
		$stmt->execute();
		
		// echo a message to say the UPDATE succeeded
		$updateCount = $stmt->rowCount();
		return($updateCount>0);
	}
	
	function addMentor($inputValues, $key, $isNew) {
		// get current datetime
		$datetime = date("Y-m-d H:i:s");
		
		// prepare statement
		if($isNew) {
			$prepStmt = "INSERT INTO `t9hacks_mentors` 
				(
					`key`, 
					`name`, 
					`email`, 
					`phone`, 
					`company`, 
					`position`, 
					`breakfast`, 
					`lunch`, 
					`dinner`, 
					`area`, 
					`comment`, 
					`coc_agree`, 
					`datetime`, 
					`complete`
				)  
				VALUES (
					:key, 
					:name, 
					:email, 
					:phone, 
					:company, 
					:position, 
					:breakfast, 
					:lunch, 
					:dinner, 
					:area, 
					:comment, 
					:coc_agree, 
					:datetime, 
					1
				)";
		} else {
			$prepStmt = "UPDATE `t9hacks_mentors` 
				SET `name`				= :name, 
					`email`				= :email, 
					`phone`				= :phone, 
					`company`			= :company, 
					`position`			= :position, 
					`breakfast`			= :breakfast, 
					`lunch`				= :lunch, 
					`dinner`			= :dinner, 
					`area`				= :area, 
					`comment`			= :comment, 
					`coc_agree`			= :coc_agree,
					`datetime`			= :datetime, 
					`complete`			= 1 
				WHERE `key` = :key";
		}
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
		$stmt->bindParam(':area',			$inputValues['area']);
		$stmt->bindParam(':comment',		$inputValues['comment']);
		$stmt->bindParam(':coc_agree',		$inputValues['agree']);
		$stmt->bindParam(':datetime', 		$datetime);
		
		// use exec() because no results are returned
		$stmt->execute();
		
		// echo a message to say the UPDATE succeeded
		$updateCount = $stmt->rowCount();
		return($updateCount>0);
	}
	
	function addMentorFriend($inputValues, $key) {
		// get current datetime
		$datetime = date("Y-m-d H:i:s");
		
		// prepare statement
		$prepStmt = "INSERT INTO `t9hacks_mentors` 
				(`key`, `name`, `email`, `datetime`, `complete`)  
				VALUES (:key, :name, :email, :datetime, 0)";
		$stmt = $this->conn->prepare($prepStmt);
		$stmt->bindParam(':key', 			$key);
		$stmt->bindParam(':name', 			$inputValues['name']);
		$stmt->bindParam(':email', 			$inputValues['email']);
		$stmt->bindParam(':datetime', 		$datetime);
		
		// use exec() because no results are returned
		$stmt->execute();
		
		// echo a message to say the UPDATE succeeded
		$updateCount = $stmt->rowCount();
		return($updateCount>0);
	}
	
	
	
	// getters 
	function getParticipants($key = null) {
		// get participant(s)
		if(is_null($key)) {
			$stmt = $this->conn->prepare("SELECT * FROM `t9hacks_participants`"); 
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM `t9hacks_participants` WHERE `key` = :key");
			$stmt->bindParam(':key', $key);
		}
		
		// run
		$stmt->execute();
		
		// store data in array
		$participants = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			$participants[] = $row;
		}
		
		return $participants;
	}
	
	function getMentors($key = null) {
		// get mentor(s)
		if(is_null($key)) {
			$stmt = $this->conn->prepare("SELECT * FROM `t9hacks_mentors`"); 
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM `t9hacks_mentors` WHERE `key` = :key");
			$stmt->bindParam(':key', $key);
		}
		
		// run
		$stmt->execute();
		
		// store data in array
		$mentors = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			$mentors[] = $row;
		}
		
		return $mentors;
	}
	
	
	
	function participantEmailRegistered($email) {
		$sql = "SELECT COUNT(*) AS c FROM `t9hacks_participants` WHERE `email` = :email AND `deleted` = 0";
		return $this->emailRegistered($email, $sql);
	}
	
	function mentorEmailRegistered($email) {
		$sql = "SELECT COUNT(*) AS c FROM `t9hacks_mentors` WHERE `email` = :email AND `deleted` = 0";
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
	
	
	
	
	function deleteRecord($id, $type) {
		// prepare statement
		if($type == 1)
			$prepStmt = "UPDATE `t9hacks_participants` SET `deleted` = 1 WHERE `id` = :id";
		if($type == 2)
			$prepStmt = "UPDATE `t9hacks_mentors` SET `deleted` = 1 WHERE `id` = :id";
		$stmt = $this->conn->prepare($prepStmt);
		$stmt->bindParam(':id',$id);
		
		// use exec() because no results are returned
		$stmt->execute();
		
		// echo a message to say the UPDATE succeeded
		$updateCount = $stmt->rowCount();
		return($updateCount>0);
	}
	
	function checkInRecord($id, $type) {
		// prepare statement
		if($type == 1)
			$prepStmt = "UPDATE `t9hacks_participants` SET `checked_in` = 1 WHERE `id` = :id";
		if($type == 2)
			$prepStmt = "UPDATE `t9hacks_mentors` SET `checked_in` = 1 WHERE `id` = :id";
		$stmt = $this->conn->prepare($prepStmt);
		$stmt->bindParam(':id',$id);
		
		// use exec() because no results are returned
		$stmt->execute();
		
		// echo a message to say the UPDATE succeeded
		$updateCount = $stmt->rowCount();
		return($updateCount>0);
	}
	
	
	
	
	function login($username, $password) {
		$passwordHash = sha1($password);
		
		$stmt = $this->conn->prepare("SELECT COUNT(*) AS c FROM `t9hacks_users` WHERE `username` = :username AND `password_hash` = :passwordHash");
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':passwordHash', $passwordHash);
		$stmt->execute();
		
		// store data in array
		$pCount = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			$pCount = $row;
		}
		
		// test if email used
		return ($pCount["c"] == 1);
	}
	
	
	
	
	function close() {
		$conn = null;
	}
	
}