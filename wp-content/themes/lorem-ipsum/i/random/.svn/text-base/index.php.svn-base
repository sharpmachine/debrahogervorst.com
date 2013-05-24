<?php
/*
IMAGE ROTATOR & RESIZER
Version 1.0 - April 1, 2007

Picks up a random image file from the specified folder and have it ready to be displayed in a resized manner.

CHANGELOG

Version 1.0
	- Release version

USAGE

* Modify the $folder setting in the configuration section below
* Upload this file to your webserver - best option is to upload it to the image folder.
* Link to the file as you would any normal image file and add the additional options

<img src="http://www.mysite.com/imgfolder/index.php?w=200&q=80">

"w" is the desired width and
"q" is the desired image quality

*/

/* ------------------------- START: CONFIGURATION -----------------------
Set $folder to the full path to the location of your images.
For example: $folder = '/user/mysite/public_html/images/';
If the index.php file will be in the same folder as your
images then you should leave it set to $folder = '.';
*/

$folder = '.';

/* ------------------------- END: CONFIGURATION ----------------------- */
// No more editing required

$fileArray = glob("$folder/*.jpg");

$w = 500; // default image width
$quality = 80; // default image quality
$h = -1; // just sets the variable

srand();

$idx = rand(0,count($fileArray) - 1);
$fileName = $fileArray[$idx];
$time = date ("l, F jS, Y g:i:s A");
foreach ($_GET as $key => $value) {
$$key = stripslashes($value);
}
list($srcWidth, $srcHeight) = getimagesize($fileName);
$srcImg = ImageCreateFromJPEG($fileName);
$aspectRatio = $srcWidth / $srcHeight;

// Makes sure that the image is properly proportioned
$h = ($h != -1) ? $h : ($w / $aspectRatio); 
$dstImg = imagecreatetruecolor($w, $h);

// let us get a better resampling of the image
imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $w, $h, $srcWidth, $srcHeight);
header("Content-type: image/jpeg");
imagejpeg($dstImg,"",$quality);
imagedestroy($srcImg);
imagedestroy($dstImg);
?>