<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title></title>
	</head>
	<body>
				<h1>M&ouml;gliche Schichten</h1>
		<table>
			<th>
				<td>ID</td>
				<td>Name</td>
				<td>Startzeit 1</td>
				<td>Endzeit 1</td>
				<td>Startzeit 2</td>
				<td>Endzeit 2</td>
			</th>
			<?php
				$n = "1";
				$f = fopen("shifts.csv.default", "r");
				while (($line = fgetcsv($f)) !== false) {
				        echo "<tr><td>$n</td>";
				        foreach ($line as $cell) {
				                echo "<td>" . htmlspecialchars($cell) . "</td>";
				        }
				        echo "</tr>\n";
						$n++;
				}
				fclose($f);
			?>
		</table>
	</body>
</html>
