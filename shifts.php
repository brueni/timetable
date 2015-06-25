<?php
if ($_GET['do'] == "new") {
	$newline = array(
		$_GET['name'],
		$_GET['start1'],
		$_GET['end1'],
		$_GET['start2'],
		$_GET['end2']
	);
	$f = fopen("shifts.csv.default", "a");
	fputcsv($f, $newline);
	fclose($f);
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title></title>
	</head>
	<body>
				<h1>M&ouml;gliche Schichten</h1>
				<a href="index.php">Zur&uuml;ck</a>
		<table border="1">
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Startzeit 1</td>
				<td>Endzeit 1</td>
				<td>Startzeit 2</td>
				<td>Endzeit 2</td>
				<td>Aktion</td>
			</tr>
			<?php
				$n = "1";
				$f = fopen("shifts.csv.default", "r");
				while (($line = fgetcsv($f)) !== false) {
				        echo "<tr><td>$n</td>";
				        foreach ($line as $cell) {
				                echo "<td>" . htmlspecialchars($cell) . "</td>";
				        }
				        echo "<td><a href=\"?do=delete&line=" . $n . "\">L&ouml;schen</a></td></tr>\n";
						$n++;
				}
				fclose($f);
			?>
			<tr>
				<td colspan="7">Neuer Dienst einf&uuml;gen</td>
			</tr>
			<tr>
				<form action="#" method="get">
				<td></td>
				<td><input type="text" name="name" /></td>
				<td><input type="text" name="start1" /></td>
				<td><input type="text" name="end1" /></td>
				<td><input type="text" name="start2" /></td>
				<td><input type="text" name="end2" /></td>
				<td><input type="submit" name="submit" value="Eintragen" /></td>
				<input type="hidden" name="do" value="new" /></form>
			</tr>
		</table>
	</body>
</html>
