<?php

include_once '../signupScripts/DBHelperClass.php';
include_once '../signupScripts/GeneralHelper.php';

// check if token exists
if(array_key_exists("token", $_GET)) {
	
	// test token
	if(false) {
		
		// create database helper
		$db = new DBHelperClass();
		
		// create an array for people
		$people = array("participants" => array(), "mentors" => array());
		
		// get participants
		$participants = $db->getParticipants();
		foreach($participants as $id => $participant) {
			if($participant["approved"] == 1 && $participant["unregistered"] == 0) {
				$people["participants"][] = $participant;
			}
		}
		
		// get mentors
		$mentors = $db->getMentors();
		foreach($mentors as $id => $mentor) {
			if($mentor["approved"] == 1 && $mentor["unregistered"] == 0) {
				$people["participants"][] = $mentor;
			}
		}
		
		// close database helper
		$db->close();
		
		// json encode array
		//printArray($people);
		$jsonResult = json_encode($people);
		
		// print array to screen as results
		print_r($jsonResult);
		
		
	}
}