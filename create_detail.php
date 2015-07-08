<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title></title>
	</head>
	<body>
				<h1>Monat <?php echo $_GET['y'] . "/" . $_GET['m']; ?> erfassen</h1>
				<a href="create.php">Zur&uuml;ck</a>
				<?php
				$start_of_month = mktime(0, 0, 1, $_GET['m'], 1, $_GET['y']);
				$days_in_month = date(t, $start_of_month);
				echo $start_of_month;
				echo "<br>";
				echo $days_in_month;
				?>
	</body>
</html>
