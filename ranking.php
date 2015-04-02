<?php
	
	include 'functions.php';
	
	//load settings
	$settings = parse_ini_file("settings.ini");
	$district=$_GET["d"];
	$year=$_GET["y"];
	
	$points=total_points($district,$year);
	echo $points[0].' points available in '.$district.' over '.$points[1].' district events</br>';
	
	$teams = tba_get('district/'.$district.'/'.$year.'/rankings');
	
	echo '<pre>';
	print_r($teams);
	echo '</pre>';
	
	
	
?>