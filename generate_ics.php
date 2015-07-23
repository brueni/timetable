<?php include 'include.php';
$dir="data/";
$eol = "\n";
$ics = "BEGIN:VCALENDAR" . $eol . 
"VERSION:2.0" . $eol . 
"PRODID:-//MichaelBruenisholz//Timetable//EN" . $eol .
"BEGIN:VTIMEZONE" . $eol .
"TZID:Europe/Zurich" . $eol .
"BEGIN:DAYLIGHT" . $eol .
"TZOFFSETFROM:+0100" . $eol .
"TZOFFSETTO:+0200" . $eol .
"DTSTART:19810329T020000" . $eol .
"RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU" . $eol .
"TZNAME:CEST" . $eol .
"END:DAYLIGHT" . $eol .
"BEGIN:STANDARD" . $eol .
"TZOFFSETFROM:+0200" . $eol .
"TZOFFSETTO:+0100" . $eol .
"DTSTART:19961027T030000" . $eol .
"RRULE:FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU" . $eol .
"TZNAME:CET" . $eol .
"END:STANDARD" . $eol .
"END:VTIMEZONE" . $eol;

if ($handle = opendir('data')) {
    while (false !== ($entry = readdir($handle))) {
        if($entry != "." && $entry != ".." && $entry != "shifts.ics") {
        	$filename = $dir . $entry;
        	$f = fopen($filename, "r");
			$event = fread($f, filesize($filename));
			echo $event;
        	$ics .= $event;
			echo $ics;
			fclose($f);
        }	
    }
    closedir($handle);
}
$ics .= "END:VCALENDAR";

$file = fopen("data/shifts.ics", "w");
fwrite($file,$ics);
close($file);
?>
