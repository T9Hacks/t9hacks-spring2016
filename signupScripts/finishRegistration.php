<?php 

date_default_timezone_set('America/Denver');

include 'GeneralHelper.php';
include 'DBHelperClass.php';

function getParticipantData($key) {
	
	// create database helper
	$db = new DBHelperClass();
	
	// get participant data
	$datas = $db->getParticipants($key);
	$data = $datas[0];
		
	// close database helper
	$db->close();
	
	return $data;	
}

function getMentorData($key) {
	
	// create database helper
	$db = new DBHelperClass();
	
	// get participant data
	$datas = $db->getMentors($key);
	$data = $datas[0];
		
	// close database helper
	$db->close();
	
	return $data;	
}

?>