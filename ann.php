   
<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html>
  <head>
   
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="card.css">
	<title>responsive column cards</title>
  </head>
  
  <style>
     .announcement-bar {
	    background-color: #f44336;
		color: white;
		padding: 15px;
		text-align: center;
		position: relative;
		font-family: arial, sans-serif;
		font-size: 16px;
		margin-bottom: 20px;
	 }
	 .announcement-bar p{
	    margin: 0;
	 }
	 .close-btn{
	    position: absolute;
		top: 50%;
		right: 15px;
		transform: translateY(-50%);
		color: white;
		font-size: 24px;
		font-weight: bold;
		cursor: pointer;
		transition: 0.3s;
	 }
	 .close-btn:hover{
	    color: black;
	 }
	 @media (max-width: 768){
	 .announcement-bar {
	    font-size: 14px;
		padding: 10px;
	 }
	 .close-btn{
	   font-size: 20px;
	   right: 10px;
	 }
	 
	 }
	 
  </style>
    
  
  <body>
  
  <div class="announcement-bar">
    <p>important announcement: our services....</p>
	<span class="close-btn">&times;</span>
  </div>
  
  
  <script>
      document.addEventListener('DOMContentLoaded', function() {
		  const closeButton = document.querySelector('.close-btn');
		  const announcementBar = document.querySelector('.announcement-bar');
		  
		  if (closetButton && announcementBar) {
		  closeButton.addEventListener('click', function() {
		    announcementBar.style.display = 'none';
	  });
	  }
	});  
	  
  
  
  </script>
  
  
  
  
  </body>
 </html>