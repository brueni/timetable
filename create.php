<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title></title>
	</head>
	<body>
				<h1>Neuer Monat erfassen</h1>
				<a href="index.php">Zur&uuml;ck</a>
				<?php
				$month_now = date(n);
				$month_plus1 = date(n) + 1;
				$month_plus2 = date(n) + 2;
				$year_now = date(Y);
				if ($month_plus1 == 13) {$month_plus1 = 1; $year_now++;}
				if ($month_plus2 == 13) {$month_plus2 = 1; $year_now++;}
				?>
				<ul>
					<li><a href="create_detail.php?y=<?php echo $year_now . "&m=" . $month_now; ?>"><?php echo $year_now . "/" . $month_now; ?></a></li>
					<li><a href="create_detail.php?y=<?php echo $year_now . "&m=" . $month_plus1; ?>"><?php echo $year_now . "/" . $month_plus1; ?></a></li>
					<li><a href="create_detail.php?y=<?php echo $year_now . "&m=" . $month_plus2; ?>"><?php echo $year_now . "/" . $month_plus2; ?></a></li>
				</ul>
	</body>
</html>
