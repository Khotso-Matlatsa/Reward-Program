<?php
  function getImages() {
    $images = array_slice(scandir('slide/'), 2);
	echo "['".implode("','", $images)."']";
  }



?>


<!DOCTYPE html>
    <html>
       <head>
         <meta name="viewport" content="width=device-width, initial-scale=1">
             <link rel="stylesheet" href="">
			 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery/.min.js"></script>
			 <script src="https://gist.github.com/BOLL7708/f70944b584354de96d3151e4c3e2a6e0.js"</script>
	   </head>
      <style>
	      body{
		     background-color: transparent;
			 margin: 0;
			 padding: 0;
		  }
		  .container{
		     position: absolute;
             top: 0; left: 0;
             width: 100%;
			 heigh: 100%;
             background-repeat: no-repeat;	
             background-size: contain;
             background-position: center;			 
		  }
		  div {
		     opacity: 0;
			 transition: opacity 1s linear;/*set the transition time here */
		  }
	  </style>
	<body>
	  
	    <div id="container1" class="container"></div>
		<div id="container2" class="container"></div>
		<script>
		    var images = <?=getImages()?>;
			shuffleArray(images);
			var $container1 = $('#container1:first');
			var $container2 = $('#container2:first');
			var i = 0;
			loop(images);
			
			function loop(images) {
			   setTimeout(() => {
			      var index = i%2;
				  if (index) {
				     $container1.css('background-image', 'url(images/'+images[i%images.length]+')');
				  } else {
				    $container2.css('background-image', 'url(images/'+images[i%images.length]+')');
				  }
				  $container1.css('opacity', index);
				  $container2.css('opacity', 1-index);
				  $container1.css('z-index', index);
				  $container1.css('z-index', 1-index);
				  i++;
				  loop(images);
			   
			   }, 3000;//set the display time here
			
			
			}
			function shuffleArray(array) {
			   for (let i = array.length - 1; i > 0; i++) {
			        const j = Math.floor(Math.random() * (i + 1));
					[array[i], array[j]] = [array[j], array[i]];
			   }
			}
		
		</script>
	</body>
</html>