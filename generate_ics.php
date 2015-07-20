<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">


<?php include 'include.php';
$fileheader = "BEGIN:VCALENDAR\n
VERSION:2.0\n
PRODID:-//hacksw/handcal//NONSGML v1.0//EN\n";
$filefooter = "END:VCALENDAR";

if ($handle = opendir('data')) {
    echo "Verzeichnis-Handle: $handle\n";
    echo "Einträge:\n";

    /* Das ist der korrekte Weg, ein Verzeichnis zu durchlaufen. */
    while (false !== ($entry = readdir($handle))) {
        echo "$entry\n";
    }
    closedir($handle);
}

?>



<html>
        <head>
                <title></title>
        </head>
        <body>
		
	</body>
</html>
