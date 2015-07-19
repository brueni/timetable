<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">


<?php include 'include.php';
                                //Get all possible shifts and put in array
                                $n = "1";
                                $f = fopen("shifts.csv.default", "r");
                                while (($line = fgetcsv($f)) !== false) {
                                        $shiftname[] = $line[0];
					$start1[] = $line[1];
					$stop1[] = $line[2];
					$start2[] = $line[3];
					$start3[] = $line[4];
                                        $n++;
                                }
                                fclose($f);

?>

<html>
        <head>
                <title></title>
        </head>
        <body>
		<?php var_dump($_POST); ?>
		<br><br>
		<?php
		echo $_POST['year'];
		echo "<br>";
		echo $_POST['month'];
		echo "<br>";
		$day="1";
		while ($day <= '31') {
			if(isset($_POST['tag-' . $day])) {
				$key = $_POST['tag-' . $day];
				echo "<br>";
				echo $shiftname[$key];
				echo $start2[$key];
				echo "<br>";
			}
			$day++;
		}
		//if (isset($_POST
		?>
	</body>
</html>
