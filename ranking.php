<?php
	
	include 'functions.php';
	
	//load settings
	$settings = parse_ini_file("settings.ini");
	$district=$_GET["d"];
	$year=$_GET["y"];
	
	$points=total_points($district,$year,$settings);
	echo $points[0].' points available in '.$district.' over '.$points[1].' district events</br>';
	
	$teams = json_decode(file_get_contents('http://www.thebluealliance.com/api/v2/district/'.$district.'/'.$year.'/rankings?X-TBA-App-Id='.$settings["tba_id"].":".$settings["tba_description"].":".$settings["tba_version"]),true);
	
	echo '<pre>';
	print_r($teams);
	echo '</pre>';
	
	
	
?>