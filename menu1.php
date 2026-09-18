<!DOCTYPE html>
<html>
    <head>
        <title>Restaurant Menu</title>
        <link rel="stylesheet" href="styled.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    </head>
	
	<style>
	     /*basic css for readability (can be expanded) this is a suggestions css */
		 
		 
		 .faq-item{
		     margin-bottom: 15px;
			 
			 padding: 10px;
		 }
		 .faq-question{
		    font-weight: bold;
			cursor: pointer;
			
		 }
		 .faq-answer{
		      margin-top: 5px;
			  display: none;
		 }
		 
		 
	
	
	
	</style>
	
	
	
	
	
	
	
	
	
	
	
    <body>
        <nav>
            <h2 class="logo">911 Snack bar</h2>
        </nav>
        <div class="main">
            <section class="title">
                <h3>Our Menu</h3>
               
				
				
		 <div class="faq-item">
		    <h2 class="faq-question">Click here to give suggestions</h2>
			<div class="faq-answer">
			
			
			
	<div class="footer-section">
				   
				   <form action="#" method="post">
				   	<td>Are you satisfied with our services</td>
					   <input type="checkbox" name="optional_extras" value="chilli_sauce" />No
			           <input type="checkbox" name="optional_extras" value="chilli_sauce" />Yes<br>
				   <input type="email" placeholder="Give suggestion" required>
				   <button type="submit">Subscribe</button>
				   </form>
				   </div>
			
			
			
			 
				  
	
			</div> 
			
		  </div>
		  
		   
		  <script>
		        //javascript for functionality
				document.querySelectorAll('.faq-question').forEach(item => {
				item.addEventListener('click', event => {
				const answer = item.nextElementSibling;
				if (answer.style.display === 'block') {
				  answer.style.display = 'none';
				} else {
				   answer.style.display = 'block';
				}
				
				});
				
				});
				
		  
		  
		  </script>
				
				
				
				
				
				
				<br>
					<p>Rate our services</p><input type="range" class="range" id="points" name="points" min="0" max="10">
            </section>
            <section class="menu">

                <div class="menu-column">
                    <h4>Breakfast</h4>
                    <div class="menu-item">
                        <img src="img/meal.jpeg" alt="">
                        <div class="item-content">
                            <h5>French Toast <span>$9.99</span></h5>
                            <p>A loaf of bread fried in a batter of egg, milk, and sugar.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="img/pork.jpeg" alt="">
                        <div class="item-content">
                            <h5>Pork Meal <span>R50.00</span></h5>
                            <p>A choice of grilled or braai pork, papa and chakalaka.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="img/trotters.jpeg" alt="">
                        <div class="item-content">
                            <h5>Trotters meal <span>R25.00</span></h5>
                            <p>A freshly cooked papa, trotters and chakalaka.</p>
                        </div>
                    </div>
                </div>

                <div class="menu-column">
                    <h4>Lunch</h4>
                    <div class="menu-item">
                        <img src="img/wings.jpeg" alt="">
                        <div class="item-content">
                            <h5>Wings <span>R35.00</span></h5>
                            <p>Chicken wings cooked in a host of spices.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="img/snack.jpeg" alt="">
                        <div class="item-content">
                            <h5>Kebabas <span>R10.00</span></h5>
                            <p>Consists of gizzards, onion, peppers and potatoes sauted with spices.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="img/chinese.jpeg" alt="">
                        <div class="item-content">
                            <h5>Chinese Food <span>R20.00/ R25.00/ R30.00</span></h5>
                            <p>A choice of rice or noodles, chicken or pork, soup served with a host of vegetables.</p>
                        </div>
                    </div>
                </div>

                <div class="menu-column">
                    <h4>Dinner</h4>
                    <div class="menu-item">
                        <img src="img/junk.jpeg" alt="">
                        <div class="item-content">
                            <h5>Burger/hot dog/kota Meal <span>R35.00 & R16.00</span></h5>
                            <p>Bun, russian, Fries, polony, onion, tomato, lettuce, cucumber, sauces.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="img/potjiekos.jpeg" alt="">
                        <div class="item-content">
                            <h5>Potjiekos Meal <span>R25.00</span></h5>
                            <p>Beef, chicken and pork cooked in a host of soup and spices.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="img/cocktail.jpeg" alt="">
                        <div class="item-content">
                            <h5>Cocktail <span> R35.00 & R60.00</span></h5>
                            <p>Flavours.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
