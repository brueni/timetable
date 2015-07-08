<?php include 'include.php' ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title></title>
	</head>
	<body>
				<h1>Monat <?php echo $_GET['y'] . "/" . $_GET['m']; ?> erfassen</h1>
				<a href="create.php">Zur&uuml;ck</a>
				<table border=1>
					<tr>
						<td>Datum</td>
						<td>Wochentag</td>
						<td>Dienst</td>
					</tr>
				<?php
				$start_of_month = mktime(0, 0, 1, $_GET['m'], 1, $_GET['y']);
				$days_in_month = date(t, $start_of_month);
				$i = "1";
				while ($i <= $days_in_month) {
					$weekday = date('D', mktime(0,0,1,$_GET['m'], $i, $_GET['y']));
					$weekday = strtr($weekday, $trans);
					echo "<tr>
							<td>$i.</td>
							<td>$weekday</td>
							<td><select name=\"dienst_$i\">
									<opton value=\"foo\">bar</option>
								</select>
							</td>
						</tr>";
					$i++;
				}
				?>
				</table>
	</body>
</html>
