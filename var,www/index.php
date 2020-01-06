<html>
	<head>
		<title>PHP Info</title>
	</head>
	<body>
		<?php
			phpinfo();                   // Show all information, defaults to INFO_ALL
			phpinfo(INFO_MODULES); // Show just the module information.
		?>

        <?php
        echo "<p align='center'>Today is " . date("m/d/Y") . "</p>";
        ?>
	</body>
</html>
