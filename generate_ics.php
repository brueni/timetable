<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">

<html>
        <head>
        		<link rel="stylesheet" type="text/css" href="default.css">
                <title>Timetable</title>
        </head>
        <body>
        	<h1>Kalenderupload</h1>	
<?php include 'include.php';
include 'login.php';
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
			//echo $event;
        	$ics .= $event;
			//echo $ics;
			fclose($f);
        }
    }
    closedir($handle);
}
$ics .= "END:VCALENDAR";
$file = fopen("data/shifts.ics", "w");
fwrite($file,$ics);
fclose($file);
//FTP Upload
$localfile="data/shifts.ics";
$remotefile="/public_html/timetable/shifts.ics";
$conn_id = ftp_connect($ftpserver);
$login_result = ftp_login($conn_id, $ftpuser, $ftppw);
ftp_pasv($conn_id, true);
if (ftp_put($conn_id, $remotefile, $localfile, FTP_ASCII)) {
 echo "$localfile erfolgreich hochgeladen<br>";
} else {
 echo "Ein Fehler trat beim Hochladen von $localfile auf<br>";
}

// Verbindung schließen
ftp_close($conn_id);
?>
<a href="index.php">Zur&uuml;ck zur Startseite</a>
</body></html>
