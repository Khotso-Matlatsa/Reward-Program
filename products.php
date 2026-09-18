<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
"width=device-width, initial-scale=1.0">
    <title>Responsive Table</title>
    <style>
	/****like feature css****/
	   .like-container{
	       display: flex;
		   align-items: center;
	   }
	    .like-button{
		   background-color: #007bff;
		   color: white;
		   border: none;
		   padding: 8px 12px;
		   border-radius: 5px;
		   cursor: pointer;
		   display: flex;
		   align-items: center;
		}
		like-button:hover {
		     background-color: #0056b3
		}
		.like-count{
		   margin-left: 5px;
		   font-weight: bold;
		}
	
	/****like1 feature css****/
	
		/****like feature css****/
	   .like1-container{
	       display: flex;
		   align-items: center;
	   }
	    .like1-button{
		   background-color: #007bff;
		   color: white;
		   border: none;
		   padding: 8px 12px;
		   border-radius: 5px;
		   cursor: pointer;
		   display: flex;
		   align-items: center;
		}
		like1-button:hover {
		     background-color: #0056b3
		}
		.like1-count{
		   margin-left: 5px;
		   font-weight: bold;
		}
	
	/****like feature css****/
	
	
        table {
            width: 80%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 35px;
            border: 1px solid #ddd;
        }

        @media screen and (max-width: 600px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 20px;
                border: 1px solid #ddd;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                position: absolute;
                left: 6px;
                content: attr(data-label);
                font-weight: bold;
            }
        }
		
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
</head>

<body>
<h3>Click a like button for products you love</h3>





		 <div class="faq-item">
		    <h2 class="faq-question">Click here to tell why you love it</h2>
			<div class="faq-answer">
			
			
			
	<div class="footer-section">
				   
				   <form action="#" method="post">
				   	<td>Are you satisfied with our services</td>
					   <input type="checkbox" name="optional_extras" value="chilli_sauce" />No
			           <input type="checkbox" name="optional_extras" value="chilli_sauce" />Yes<br>
				   <input type="email" placeholder="Give suggestion" required>
				   <button type="submit">Send</button>
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









    <table>
        <thead>
            <tr>
              
            </tr>
        </thead>
        <tbody>
            <tr>
                
                <td data-label="R100.00"><img alt="NO IMAGE" src="img/chinese.jpeg" width="140" height="170"><br>=R100.00
				
				<div class="like-container">
		      <button class="like-button"
			  <span class="material-icons">Like</span>
			  </button>
			  <span class="like-count">0</span>
	     </div>
				</td>
				
				
                <td data-label="R200.00"><img alt="NO IMAGE" src="img/trotters.jpeg" width="150" height="170"><br>=R200.00
				<div class="like1-container">
		      <button class="like1-button"
			  <span class="material-icons">Like</span>
			  </button>
			  <span class="like1-count">0</span>
	     </div>
				</td>
                <td data-label="R300.00"><img alt="NO IMAGE" src="img/junk.jpeg" width="150" height="170"><br>=R300.00
				<div class="like-container">
		      <button class="like-button"
			  <span class="material-icons">Like</span>
			  </button>
			  <span class="like-count">0</span>
	     </div>
				</td>
                <td data-label="R400.00"><img alt="NO IMAGE" src="img/chinese.jpeg" width="150" height="170"><br>=R400.00
				<div class="like-container">
		      <button class="like-button"
			  <span class="material-icons">Like</span>
			  </button>
			  <span class="like-count">0</span>
	     </div>
				</td>
            </tr>
            <tr>
                
                <td data-label="R100.00"><img alt="NO IMAGE" src="img/cocktail.jpeg" width="150" height="170"><br>=R100.00</td>
                <td data-label="R200.00"><img alt="NO IMAGE" src="img/chinese.jpeg" width="150" height="170"><br>=R200.00</td>
                <td data-label="R300.00"><img alt="NO IMAGE" src="img/wings.jpeg" width="150" height="170"><br>=R300.00</td>
                <td data-label="R400.00"><img alt="NO IMAGE" src="img/junk.jpeg" width="150" height="170"><br>=R400.00</td>
            </tr>
            <tr>
                
                <td data-label="R100.00"><img alt="NO IMAGE" src="img/wings.jpeg" width="150" height="170"><br>=R100.00</td>
                <td data-label="R200.00"><img alt="NO IMAGE" src="img/chinese.jpeg" width="150" height="170"><br>=R200.00</td>
                <td data-label="R300.00"><img alt="NO IMAGE" src="img/snack.jpeg" width="150" height="170"><br>=R300.00</td>
                <td data-label="R400.00"><img alt="NO IMAGE" src="img/cocktail.jpeg" width="150" height="170"><br>=R400.00</td>
            </tr>
            <tr>
                
                <td data-label="R100.00"><img alt="NO IMAGE" src="img/chinese.jpeg" width="150" height="170"><br>=R100.00</td>
                <td data-label="R200.00"><img alt="NO IMAGE" src="img/wings.jpeg" width="150" height="170"><br>=R200.00</td>
                <td data-label="R300.00"><img alt="NO IMAGE" src="img/chinese.jpeg" width="150" height="170"><br>=R300.00</td>
                <td data-label="R400.00"><img alt="NO IMAGE" src="img/junk.jpeg" width="150" height="170"><br>=R400.00</td>
            </tr>
        </tbody>
    </table>
	
	
	<script>
		       document.addEventListener('DOMContentLoaded', () => {
			   const likeButton = document.querySelector('.like-button');
			   const likeCountSpan = document.querySelector('.like-count');
			   let likeCount = 0;
			   
			   likeButton.addEventListener('click',() => {
			   likeCount++;
			   
			   likeCountSpan.textContent = likeCount;
			   
			   });
			   
			   
			   
			   
			   });
			   
		 </script>
		 
		 
		 <script>
		       document.addEventListener('DOMContentLoaded', () => {
			   const like1Button = document.querySelector('.like1-button');
			   const like1CountSpan = document.querySelector('.like1-count');
			   let like1Count = 0;
			   
			   like1Button.addEventListener('click',() => {
			   like1Count++;
			   
			   like1CountSpan.textContent = like1Count;
			   
			   });
			   
			   
			   
			   
			   });
			   
		 </script>
	
	
</body>

</html>
