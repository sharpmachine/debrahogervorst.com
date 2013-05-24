<?php
	function imagecolorgradient($im, $width, $height, $top_color, $bottom_color) 
	{
		$top_color_red = hexdec(substr($top_color, 0, 2));
		$top_color_green = hexdec(substr($top_color, 2, 2));
		$top_color_blue = hexdec(substr($top_color, 4, 2));
		
		$bottom_color_red = hexdec(substr($bottom_color, 0, 2));
		$bottom_color_green = hexdec(substr($bottom_color, 2, 2));
		$bottom_color_blue = hexdec(substr($bottom_color, 4, 2));
		
		$kred = ($top_color_red - $bottom_color_red) / $height; 
		$kgreen = ($top_color_green - $bottom_color_green) / $height; 
		$kblue = ($top_color_blue - $bottom_color_blue) / $height;
		
		for ($i = 0; $i <= $height; $i++) 
		{ 
			$red = $top_color_red - floor($i * $kred); 
			$green = $top_color_green - floor($i * $kgreen); 
			$blue = $top_color_blue - floor($i * $kblue); 
			$color = imagecolorallocate($im, $red, $green, $blue); 
			imageline($im, 0, 0 + $i, 0 + $width, 0 + $i, $color); 
		}
	}
	
	header('Content-type: image/png');
	$image = imagecreate(1, $_GET['height']);
	imagecolorgradient($image, 1, $_GET['height'], $_GET['top'], $_GET['bottom']);
	imagepng($image);
	imagedestroy($image);
?>