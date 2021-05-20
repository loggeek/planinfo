<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<title>Résultat de la recherche</title>
	<link rel="stylesheet" href="styles.css" />
</head>

<body>
	<h1>Plusieurs résultats ont été trouvés.</h1>
	<?php
		$name = $_GET["name"];
		$index = 0;
		do {
			if (isset($_GET["filename" . $index]))
			{
				$file = $_GET["filename" . $index];
				echo '<a href="search_1.php?name=' . $name . '&filename=' . $file . '">À ' . $file . '</a><br />';
				
				$hasFound = True;
				$index++;
			} else
			{
				$hasFound = False;
			}
		} while ($hasFound);
	?>
	<hr />
	<footer>
		<p>© 2021 - <?php echo date('Y') ?>.</p>
	</footer>
</body>

</html>
