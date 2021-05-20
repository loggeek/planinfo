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
		
		if(empty($_POST["ip"]))
		{
			header("Location: searchip_0.php");
			die;
		} else
		{
			$query = $_POST["ip"];
			$filesWithIp = array();
			
			if ($handle = opendir($dataDir))
			{
				while (false !== ($file = readdir($handle)))
				{
					if ('.' === $file) continue;
					if ('..' === $file) continue;
					
					$xml = simplexml_load_file($dataDir . $file);
					
					foreach ($xml->coms->com as $com)
					{
						foreach ($com->ip as $ip)
						{
							if ($ip == $_POST["ip"])
							{
								$filesWithIp[$file] = True;
							}
						}
					}
				}
				closedir($handle);
			}
			
			if (count($filesWithIp) == 0)
			{
				header("Location: searchip_0.php");
				die;
			}
			else if (count($filesWithIp) == 1)
			{
				header("Location: searchip_1.php?ip=" . $query . "&filename=" . array_keys($filesWithIp)[0]);
				die;
			} else
			{
				$header = "Location: searchip_2.php?ip=" . $query;
				$iter = 0;
				foreach ($filesWithIp as $value => $dummy)
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
