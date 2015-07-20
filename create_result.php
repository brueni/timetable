<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">


<?php include 'include.php';
function dateToCal($timestamp) {
  return date('Ymd\THis\Z', $timestamp);
}

function escapeString($string) {
  return preg_replace('/([\,;])/','\\\$1', $string);
}  

	//Get all possible shifts and put in array
	$n = "1";
	$f = fopen("shifts.csv.default", "r");
	while (($line = fgetcsv($f)) !== false) {
		$shiftname[] = $line[0];
		$start1[] = $line[1];
		$stop1[] = $line[2];
		$start2[] = $line[3];
		$stop2[] = $line[4];
	    $n++;
	}
	fclose($f);
?>

<html>
        <head>
                <title></title>
        </head>
        <body>
		<?php var_dump($_POST); ?>
		<br><br>
		<?php
		$eol = "\r\n";
		echo $_POST['year'];
		echo "<br>";
		echo $_POST['month'];
		echo "<br>";
		$year = $_POST['year'];
		if (strlen($_POST['month'])=="1") {
			$month = "0" . $_POST['month'];
		} else {
			$month = $_POST['month'];
		}
		$day="1";
		while ($day <= '31') {
			if(isset($_POST['tag-' . $day])) {
				$key = $_POST['tag-' . $day];
				if (strlen($day)=="1") {
					$day2 = "0" . $day;
				} else {
					$day2 = $day;
				}
				$starthour1 = substr($start1[$key],0,2);
				$startmin1 = substr($start1[$key],-2);
				$stophour2 = substr($stop1[$key],0,2);
				$stopmin1 = substr($stop11[$key],-2);
				//zweite halbzeit abfangen
				$eol = "\n";
				$id = md5($year . $month . $day . "1");
				$start = $year . $month . $day . "T" . $starthour1 . $startmin1 . "00Z";
				$end = $year . $month . $day . "T" . $stophour1 . $stopmin1 . "00Z";
				$timestamp = dateToCal(time());
				$summary = $shiftname[$key];
				$description = htmlspecialchars($shiftname[$key]);
			    $load = "BEGIN:VEVENT" . $eol .
			    "UID:" . $id . $eol .
			    "DTSTAMP:" . $timestamp . $eol .
			    "DESCRIPTION:" . $description . $eol .
			    "SUMMARY:" . $description . $eol .
			    "DTSTART:" . $start . $eol .
			    "DTEND:" . $end . $eol .
			    "END:VEVENT";
				echo $load;
				echo "<br>";
				$file1 = fopen("data/" . $year . $month . $day2 . "-1.txt", "w");
				fwrite($file1, $load);
				fclose($file1);
				//evtl. nach description noch das rein "URL;VALUE=URI:" . htmlspecialchars($url) . $eol .
				//echo "<br>";
				//echo $shiftname[$key];
				//echo $start2[$key];
				//echo "<br>";
			}
			$day++;
		}
		?>
	</body>
</html>
