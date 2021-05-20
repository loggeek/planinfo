<?php
	if (isset($_GET["ip"]) && isset($_GET["filename"])) {
		$dataDir = __DIR__ . "/xml/";
		$imgDir = __DIR__ . "/img/";
		$fontDir = __DIR__ . "/fonts/";
		
		$ip = $_GET["ip"];
		$filename = $_GET["filename"];
		$imgName = explode(".", $filename);
		
		$imgName = $imgName[0];
		$xmlFile = $dataDir . $filename;
		$font = $fontDir . "sans.ttf";
	
		if (file_exists($xmlFile))
		{
			$xml = simplexml_load_file($xmlFile);
			$path = $imgDir . $xml->filename;
			
			$desktop = imagecreatefrompng($imgDir . "desktop.png");
			$hotspot = imagecreatefrompng($imgDir . "hotspot.png");
			$laptop = imagecreatefrompng($imgDir . "laptop.png");
			$switch = imagecreatefrompng($imgDir . "switch.png");
			$image = imagecreatefrompng($path);
			
			$bgColor = imagecolorallocate($image, 255, 255, 255);
			$black = imagecolorallocate($image, 0, 0, 0);
			$red = imagecolorallocatealpha($image, 255, 0, 0, 63);
			
			foreach ($xml->coms->com as $com)
			{
				$image_x = $com->x;
				$image_y = $com->y;
				
				imagettftext($image, 28, 0, $image_x+0, $image_y-5, $black, $font, $com->name);
				
				if ($com->type == "desktop")
				{
					imagecopymerge($image, $desktop, (int) $image_x, (int) $image_y, 0, 0, 128, 128, 60);
				}
				else if ($com->type == "hotspot")
				{
					imagecopymerge($image, $hotspot, (int) $image_x, (int) $image_y, 0, 0, 128, 128, 60);
				}
				else if ($com->type == "laptop")
				{
					imagecopymerge($image, $laptop, (int) $image_x, (int) $image_y, 0, 0, 128, 128, 60);
				}
				else if ($com->type == "switch")
				{
					imagecopymerge($image, $switch, (int) $image_x, (int) $image_y, 0, 0, 128, 64, 60);
				}
				
				if ($com->ip == $ip)
				{
					if ($com->type == "switch")
					{
						imagefilledrectangle($image, $image_x+0, $image_y+0, $image_x+128, $image_y+64, $red);
					} else
					{
						imagefilledrectangle($image, $image_x+0, $image_y+0, $image_x+128, $image_y+128, $red);
					}
				}
			}
			
			header ("Content-type: image/png");
			imagepng($image);
		} else
		{
			http_response_code(404);
			include("img404.php");
			die;
		}
	} else
	{
		http_response_code(404);
		include("img404.php");
		die;
	}
?>
