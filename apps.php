
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services Section with HTML and CSS</title>
<link rel="stylesheet" href="stylees.css"
</head>



   <style>

		@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800|Poppins&display=swap');

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: 'Montserrat', sans-serif;
		}

		.cards {
			max-width: 1100px;
			margin: 0 auto;
			text-align: center;
			padding: 30px;
		}

		.cards h2.header {
			font-size: 40px;
			margin: 0 0 30px 0;
			text-transform: uppercase;
			letter-spacing: 1px;
		}

		.services {
			display: flex;
			align-items: center;
		}

		.content {
			display: flex;
			flex-wrap: wrap;
			flex: 1;
			margin: 20px;
			padding: 20px;
			border: 2px solid black;
			border-radius: 4px;
			transition: all .3s ease;
		}

		.content .fab {
			font-size: 70px;
			margin: 16px 0;
		}

		.content>* {
			flex: 1 1 100%;
		}

		.content:hover {
			color: white;
		}

		.content:hover a {
			border-color: white;
			background: white;
		}

		.content-1:hover {
			border-color: #1DA1F2;
			background: #1DA1F2;
		}

		.content-1:hover a {
			color: #1DA1F2;
		}

		.content-2:hover {
			border-color: #E1306C;
			background: #E1306C;
		}

		.content-2:hover a {
			color: #E1306C;
		}

		.content-3:hover {
			border-color: #ff0000;
			background: #ff0000;
		}

		.content-3:hover a {
			color: #ff0000;
		}

		.content h2 {
			font-size: 30px;
			margin: 16px 0;
			letter-spacing: 1px;
			text-transform: uppercase;
		}

		.content p {
			font-size: 17px;
			font-family: 'Poppins', sans-serif;
		}

		.content a {
			margin: 22px 0;
			background: black;
			color: white;
			text-decoration: none;
			text-transform: uppercase;
			border: 1px solid black;
			padding: 15px 0;
			border-radius: 25px;
			transition: .3s ease;
		}

		.content a:hover {
			border-radius: 4px;
		}

		@media (max-width: 900px) {
			.services {
				display: flex;
				flex-direction: column;
			}
		}

   </style>
   
   
<div class="cards">
    <h2 class="header">
        Download and get full experience
    </h2>
    <div class="services">
        <div class="content content-1">
            <div class="fab fa-twitter"></div>
            <h2>
                Software
            </h2>
            <p>
                Download an AI app which will help you simplify your schoolwork and write essays for you.
            </p>
            <a href="#">Download</a>
        </div>
        <div class="content content-2">
            <div class="fab fa-instagram"></div>
            <h2>
                Software
            </h2>
            <p>
                Download Haraka app and learn to make money from home in simple steps. it's simple and convenient.
            </p>
            <a href="#">Download</a>
        </div>
        <div class="content content-3">
            <div class="fab fa-youtube"></div>
            <h2>
                Software
            </h2>
            <p>
                Download a cook book and learn new recipes. You will find diferrent menus and learn best cooking strategies.
            </p>
            <a href="#">Download</a>
        </div>
    </div>
</div>

</body>
</html>