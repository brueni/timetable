<?php include 'include.php';
$dir="data/";
$eol = "\n";
$ics = "BEGIN:VCALENDAR" . $eol . 
"VERSION:2.0" . $eol . 
"PRODID:-//MichaelBruenisholz//Timetable//EN" . $eol;

if ($handle = opendir('data')) {
    while (false !== ($entry = readdir($handle))) {
        if($entry != "." && $entry != ".." && $entry != "shifts.ics") {
        	$f = fopen($dir . $entry,"r");
			$event = fread($f);
        	$ics .= $event;
			fclose($f)	
        }	
    }
    closedir($handle);
}
$ics .= "END:VCALENDAR";

$file = fopen("data/shifts.ics", "w");
fwrite($file,$ics);
close($file);
?>
