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
	$f = fopen("shifts.csv", "r");
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
        		<link rel="stylesheet" type="text/css" href="default.css">
                <title>Timetable</title>
        </head>
        <body>
        	<h1>Dienste erzeugt</h1>	
		<?php
		$eol = "\r\n";
		$year = $_POST['year'];
		if (strlen($_POST['month'])=="1") {
			$month = "0" . $_POST['month'];
		} else {
			$month = $_POST['month'];
		}
		$day="1";
		while ($day <= '31') {
			if(isset($_POST['tag-' . $day])) {
				if($_POST['tag-' . $day] == 'free') {
					if (strlen($day)=="1") {
						$day2 = "0" . $day;
					} else {
						$day2 = $day;
					}
					$file1 = "data/" . $year . $month . $day2 . "-1.txt";
					$file2 = "data/" . $year . $month . $day2 . "-2.txt";
					if (file_exists($file1)) {
						unlink($file1);
					}
					if (file_exists($file2)) {
						unlink($file2);
					}
				} else {
					$key = $_POST['tag-' . $day];
					if (strlen($day)=="1") {
						$day2 = "0" . $day;
					} else {
						$day2 = $day;
					}
					$starthour1 = substr($start1[$key],0,2);
					$startmin1 = substr($start1[$key],-2);
					$stophour1 = substr($stop1[$key],0,2);
					$stopmin1 = substr($stop1[$key],-2);
					//zweite halbzeit abfangen
					$eol = "\n";
					$id = md5($year . $month . $day . "1");
					if ($stophour1 < $starthour1) {
						$endday = $day2 + 1;
					} else {
						$endday = $day2;
					}
					$startstr = $year . $month . $day2 . "T" . $starthour1 . $startmin1 . "00";
					$endstr = $year . $month . $endday . "T" . $stophour1 . $stopmin1 . "00";
					$timestamp = dateToCal(time());
					$summary = $shiftname[$key];
					$description = htmlspecialchars($shiftname[$key]);
				    $load1 = "BEGIN:VEVENT" . $eol .
				    "UID:" . $id . $eol .
				    "DTSTAMP:" . $timestamp . $eol .
				    "DESCRIPTION:" . $description . $eol .
				    "SUMMARY:" . $description . $eol .
				    "DTSTART;TZID=Europe/Zurich:" . $startstr . $eol .
				    "DTEND;TZID=Europe/Zurich:" . $endstr . $eol .
				    "END:VEVENT" . $eol;
					$file1 = fopen("data/" . $year . $month . $day2 . "-1.txt", "w");
					fwrite($file1, $load1);
					fclose($file1);
					//zweites File nur wenn geteilter Dienst, ansonsten loeschen
					if($start2[$key] == '') {
						$file2 = "data/" . $year . $month . $day2 . "-2.txt";
						if (file_exists($file2)) {
							unlink($file2);
						}
					} else {
						$id2 = md5($year . $month . $day . "2");
						$starthour2 = substr($start2[$key],0,2);
						$startmin2 = substr($start2[$key],-2);
						$stophour2 = substr($stop2[$key],0,2);
						$stopmin2 = substr($stop2[$key],-2);
						if ($stophour2 < $starthour2) {
							$endday = $day2 + 1;
						} else {
							$endday = $day2;
						}
						$startstr2 = $year . $month . $day2 . "T" . $starthour2 . $startmin2 . "00";
						$endstr2 = $year . $month . $endday . "T" . $stophour2 . $stopmin2 . "00";
						$load2 = "BEGIN:VEVENT" . $eol .
					    "UID:" . $id2 . $eol .
					    "DTSTAMP:" . $timestamp . $eol .
					    "DESCRIPTION:" . $description . $eol .
					    "SUMMARY:" . $description . $eol .
					    "DTSTART;TZID=Europe/Zurich:" . $startstr2 . $eol .
					    "DTEND;TZID=Europe/Zurich:" . $endstr2 . $eol .
					    "END:VEVENT" . $eol;
						$file2 = fopen("data/" . $year . $month . $day2 . "-2.txt", "w");
						fwrite($file2, $load2);
						fclose($file2);
					}
				}
			}
			$day++;
		}
		//Zeige alle Dienste
		echo "Folgende Dienste sind momentan vorhanden:<br>";
		$dir = "data";
		$files = scandir($dir);
		foreach($files AS $filename) {
			if ($filename != "." && $filename != ".." && $filename != "shifts.ics") {
				if (substr($filename,-5,1) != "2") { //Nur erstes Teil-File pro Dienst zeigen
					$year = substr($filename,0,4);
					$month = substr($filename,4,2);
					$day = substr($filename,6,2);
					$lines = file("data/" . $filename);
					$shift = substr($lines[3],12);
					if($month != $month_last) {
						echo "<b>" . $year . "/" . $month . "</b><br>";
						$month_last = $month;
					}
					echo $day . "." . $month . "." . $year . ":&nbsp;" . $shift . "<br>";
				}
			}
		}
		?>
		<a href="generate_ics.php">Dienste hochladen</a>
	</body>
</html>
