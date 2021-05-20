<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<title>Recherche...</title>
	<link rel="stylesheet" href="styles.css" />
</head>

<body>
	<?php
		$dataDir = __DIR__ . "/xml/";
		$xmlSuffix = ".xml";
		
		if(empty($_POST["name"]))
		{
			header("Location: search_0.php");
			die;
		} else
		{
			$query = $_POST["name"];
			$filesWithName = array();
			
			if ($handle = opendir($dataDir))
			{
				while (false !== ($file = readdir($handle)))
				{
					if ('.' === $file) continue;
					if ('..' === $file) continue;
					
					$xml = simplexml_load_file($dataDir . $file);
					
					foreach ($xml->coms->com as $com)
					{
						foreach ($com->name as $name)
						{
							if ($name == $_POST["name"])
							{
								$filesWithName[$file] = True;
							}
						}
					}
				}
				closedir($handle);
			}
			
			if (count($filesWithName) == 0)
			{
				header("Location: search_0.php");
				die;
			}
			else if (count($filesWithName) == 1)
			{
				header("Location: search_1.php?name=" . $query . "&filename=" . array_keys($filesWithName)[0]);
				die;
			} else
			{
				$header = "Location: search_2.php?name=" . $query;
				$iter = 0;
				foreach ($filesWithName as $value => $dummy)
				{
					$header = $header . "&filename" . $iter . "=" . $value;
					$iter++;
				}
				header($header);
				die;
			}
		}
	?>
</body>

</html>
