<?
	function event_points($event, $settings) {
		$teams = json_decode(file_get_contents('http://www.thebluealliance.com/api/v2/event/'.$event.'/teams?X-TBA-App-Id='.$settings["tba_id"].":".$settings["tba_description"].":".$settings["tba_version"]),true);
		for ($i=0; $i<count($teams); $i++) {
			//echo 'rank: '.($i+1).' points: '.qual_points(count($teams),$i+1).'</br>';
			$qualpoints=$qualpoints+qual_points(count($teams),$i+1);
		}
		//echo $qualpoints.'</br>';
		//echo 532+$qualpoints;
		return 532+$qualpoints;
	}
	
	function total_points($district, $year, $settings) {
		$events = json_decode(file_get_contents('http://www.thebluealliance.com/api/v2/district/'.$district.'/'.$year.'/events?X-TBA-App-Id='.$settings["tba_id"].":".$settings["tba_description"].":".$settings["tba_version"]),true);
		for ($i=0; $i<count($events); $i++) {
			if ($events[$i]['event_type'] == 1) {
				//echo $events[$i]['key'].' '.event_points($events[$i]['key'],$settings).'</br>';
				$points=$points+event_points($events[$i]['key'],$settings);
			}
		}
		return array($points,count($events)-1);
	}
	
	function qual_points($n, $r){
		$a=1.07;
		return ceil((inverf(($n-(2*$r)+2)/($a*$n))*(10/(inverf(1/$a))))+12);
	}
	
	function inverf($x) {
		$a=0.147;
		$sign=( $x > 0 ) ? 1 : ( ( $x < 0 ) ? -1 : 0 );
		return $sign*sqrt(sqrt(pow(((2/(pi()*$a))+((log(1-pow($x, 2)))/2)), 2) - ((log(1-pow($x, 2)))/$a) )-((2/(pi()*$a))+(log(1-pow($x, 2)))/2));
	}
?>