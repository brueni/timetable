<?php include 'include.php';
include 'login.php';
$dir="data/";
$eol = "\n";
$ics = "BEGIN:VCALENDAR" . $eol . 
"VERSION:2.0" . $eol . 
"PRODID:-//MichaelBruenisholz//Timetable//EN" . $eol;

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
 echo "$localfile erfolgreich hochgeladen\n";
} else {
 echo "Ein Fehler trat beim Hochladen von $localfile auf\n";
}

// Verbindung schließen
ftp_close($conn_id);
?>
