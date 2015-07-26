<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">


<?php include 'include.php';
				//Get all possible shifts and put in array
                                $n = "1";
                                $f = fopen("shifts.csv.default", "r");
                                while (($line = fgetcsv($f)) !== false) {
                                        $shifts[] = $line[0];
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
				<h1>Monat <?php echo $_GET['y'] . "/" . $_GET['m']; ?> erfassen</h1>
				<a href="create.php">Zur&uuml;ck</a>
			<form action="create_result.php" method="POST">
			<input type="hidden" name="year" value= <?php echo $_GET['y']; ?>>
			<input type="hidden" name="month" value= <?php echo $_GET['m']; ?>>
				<table border=1>
					<tr>
						<th>Mo</th>
						<th>Di</th>
						<th>Mi</th>
						<th>Do</th>
						<th>Fr</th>
						<th>Sa</th>
						<th>So</th>
					</tr>
				<?php
				$start_of_month = mktime(0, 0, 1, $_GET['m'], 1, $_GET['y']);
				$days_in_month = date(t, $start_of_month);
				$i = "1";
				$weekday_first = date('N', mktime(0,0,1,$_GET['m'], 1, $_GET['y']));
				if ($weekday_first == "1") {
					echo "<tr>";	
				} else {
					$colspan = $weekday_first - 1;
					echo "<tr><td colspan=\"" . $colspan . "\">&nbsp;</td>";
				}
				
				while ($i <= $days_in_month) {
					$weekday = date('D', mktime(0,0,1,$_GET['m'], $i, $_GET['y']));
					$weekday_nr = date('N', mktime(0,0,1,$_GET['m'], $i, $_GET['y']));
					$weekday = strtr($weekday, $trans);
					echo "<td><b>$i.</b><br>
							$weekday<br>";
					$key=0;
					foreach($shifts AS $shiftname) {
						echo "<input type=\"radio\" name=\"tag-" . $i . "\" value=\"" . $key . "\">" . $shiftname . "</input><br>";
						$key++;
					}
					echo "<input type=\"radio\" name=\"tag-" . $i . "\" value=\"free\">Frei</input><br>";
					echo "		</td>";
					if ($weekday_nr == "7") {
						echo "</tr><tr>";
					}
					$i++;
				}
				echo "</tr>";
				?>
				<tr><td colspan=3><input type="submit" value="Eintragen"></td></tr>
				</table>
			</form>
	</body>
</html>
