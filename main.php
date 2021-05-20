<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<title>Plan informatique de l'ISSAT</title>
	<link rel="stylesheet" href="styles.css" />
</head>

<body>
	<h1>Plan informatique de l'ISSAT</h1>
	
	<form action="search.php" method="post">
		<p>Nom de la machine&nbsp;: <br />
		<input type="text" name="name" />
		<input type="submit" value="Rechercher par nom"></p>
	</form>
	<form action="searchip.php" method="post">
		<p>Adresse IP de la machine&nbsp;: <br />
		<input type="text" name="ip" />
		<input type="submit" value="Rechercher par IP"></p>
	</form>
	
	<h2>Galerie&nbsp;:</h2>
	
	<img src="image.php?plan=B1E1" width="30%" height="30%" />
	<p>Bâtiment 1, étage 1<p>
	
	<img src="image.php?plan=B1E2" width="30%" height="30%" />
	<p>Bâtiment 1, étage 2<p>
</body>

</html>
