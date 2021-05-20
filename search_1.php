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
		if (isset($_GET["name"]) && isset($_GET["filename"])) {
			$name = $_GET["name"];
			$filename = $_GET["filename"];
			echo '<img src="imagesearch.php?name=' . $name . '&filename=' . $filename . '" width="50%" />';
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
		$dataDir = __DIR__ . "/xml/";
		
		$xmlFile = $dataDir . $filename;
		$xml = simplexml_load_file($xmlFile);
		
		$ips = array();
		foreach ($xml->coms->com as $com)
		{
			if ($com->name == $name)
			{
				if (empty($com->ip))
				{
					$ips[] = "undefined";
				} else
				{
					$ips[] = $com->ip;
				}
			}
		}
		echo '<h3>' . $name . '</h3>';
		$id = 0;
		
		foreach ($ips as $ip) {
			if ($ip == "undefined") {
				echo 'IP non précisée. <br />';
			} else
			{
				echo 'IP ' . $ip . '&nbsp;: <br/>';
				echo '<code id="item-to-copy' . $id . '"> vncviewer ' . $ip . ' -viewonly</code>';
				echo '<button onclick="copyToClipboard(' . $id . ')">Copier la commande</button> <br />';
				$id++;
			}
		}
	?>
</body>

<script>
	function copyToClipboard(id) {
		const str = document.getElementById('item-to-copy' + id).innerText
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
