<?php

# Include the Dropbox SDK libraries
require_once "dropbox-sdk/lib/Dropbox/autoload.php";
use \Dropbox as dbx;

class DropboxHelperClass {		
	
	var $dbxClient = null;
	
	function __construct() {
		// access token for brittany's t9hacks app
		$accessToken = "nOBW72ELdYoAAAAAAAAAH8jlXLqkeWPH7Pv8Y9nJ2Pfsi7SM-s-StO4r8L_I7SLa";
		
		// Complete the OAuth 2 authorization flow
		$appInfo = dbx\AppInfo::loadFromJsonFile("app-info.json");
		$webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");
		
		// Connect
		$this->dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
	}
	
	function uploadFile($tmp_file, $target_file_name) {
		$f = fopen($tmp_file, "rb");
		$result = $this->dbxClient->uploadFile("/".$target_file_name, dbx\WriteMode::add(), $f);
		fclose($f);
		//echo '<pre>'.print_r($result, true).'</pre>';
	}
}
	
	




/*
$authorizeUrl = $webAuth->start();
echo "1. Go to: " . $authorizeUrl . "\n";
echo "2. Click \"Allow\" (you might have to log in first).\n";
echo "3. Copy the authorization code.\n";
//$authCode = \trim(\readline("Enter the authorization code here: "));


$authCode = nOBW72ELdYoAAAAAAAAAHiW6NIdhAx3Vf8yS5T8Kic4;
$accessToken = "nOBW72ELdYoAAAAAAAAAH8jlXLqkeWPH7Pv8Y9nJ2Pfsi7SM-s-StO4r8L_I7SLa";


$dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
$accountInfo = $dbxClient->getAccountInfo();
echo '<pre>' . print_r($accountInfo, true) . '</pre>';
*/




?>
