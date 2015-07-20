<?php include 'include.php';
$dir="data/";
$ics = "BEGIN:VCALENDAR\n
VERSION:2.0\n
PRODID:-//hacksw/handcal//NONSGML v1.0//EN\n";


if ($handle = opendir('data')) {
    while (false !== ($entry = readdir($handle))) {
        if($entry != "." && $entry != "..") {
        	$ics .= readfile($entry);	
        }	
    }
    closedir($handle);
}
$ics .= "END:VCALENDAR";

$file = fopen("data/shifts.ics", "w");
fwrite($file, $ics);
close($file);
?>
