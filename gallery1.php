
<!DOCTYPE html> 
<html>
 <head> 
<title>Media Gallery</title>
 </head>
 <body> 
<h1>Welcome to my Media Gallery</h1>
 <?php 
// define the folder where your media files are located 
$media_folder = "img/"; 
// open the directory and loop through its contents 
if ($handle = opendir($media_folder)) { 
while (false !== ($entry = readdir($handle))) { 
if ($entry != "." && $entry != "..") {
 // display the media file with a link to its URL
 echo "<a href=\"" . $media_folder . $entry . "\" target=\"_blank\">"; 
echo "<img src=\"" . $media_folder . $entry . "\" alt=\"" . $entry . "\" style=\"max-width: 200px; margin: 10px;\" />"; 
echo "</a>"; 
} 
}
 closedir($handle); 
}
 ?>
 </body>
 </html>
