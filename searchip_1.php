<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<title>Résultat de la recherche</title>
	<link rel="stylesheet" href="styles.css" />
</head>

<body>
	<h1>Résultat de la recherche&nbsp;:</h1>
	<?php
		if (isset($_GET["ip"]) && isset($_GET["filename"])) {
			$ip = $_GET["ip"];
			$filename = $_GET["filename"];
			echo '<img src="imagesearchip.php?ip=' . $ip . '&filename=' . $filename . '" width="50%" />';
		} else
		{
			http_response_code(404);
			include("404.php");
			die;
		}
	?>
	<br />
	<h2>VNCViewer - Bash</h2>
	<?php
		echo '<h3>' . $ip . '</h3>';
		echo '<code id="item-to-copy"> vncviewer ' . $ip . ' -viewonly</code>';
		echo '<button onclick="copyToClipboard()">Copier la commande</button> <br />';
	?>
</body>

<script>
	function copyToClipboard() {
		const str = document.getElementById('item-to-copy').innerText
		const el = document.createElement('textarea')
		el.value = str
		el.setAttribute('readonly', '')
		el.style.position = 'absolute'
		el.style.left = '-9999px'
		document.body.appendChild(el)
		el.select()
		document.execCommand('copy')
		document.body.removeChild(el)
	}
</script>

</html>
