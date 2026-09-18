<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>slider</title>
	
	
	<style>
	   body{
	     font-family: arial, Helvetica, san-serif;
		 font-size: 12px;
		 }
	  .fadein {
	     position: relative;
		 height: 332px;
		 width: 500px;
		 margin: 0 auto;
		 background: #ebebeb;
		 padding: 10px;
	  }
	  .fadein img{
	    position: absolute;
		width: calc(96%);
		height: calc(94%);
		object-fit: scale-down;
		}
		
	
	
	
	</style>
	
	<script>
	    src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js">
	</script>
	<script>
	    $(function(){
		    $('.fadein img:gt(0)').hide();
			setInterval(function()
			{$('.fadein :first-child').fadeOut().next('img').fadeIn().end.appendTo('.fadeIn');}, 3000);
			
			});
	</script>
	
	</head>
	<body>
	     <div class="fadein">
		 <?php
		 //display images from directory
		 //directory path
		 $dir = "./slide/";
		 
		 $scan_dir = scandir($dir);
		 foreach($scan_dir as $img);
		 
		 if(in_array($img,array('.','..')))
		  continue;
		  ?>
		  
		  <img src="<?php echo $dir.$img ?>" alt="<?php echo $img ?>">
		  <?php endforeach; ?>
		  </div>
	</body>
	</html>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
	
	
	