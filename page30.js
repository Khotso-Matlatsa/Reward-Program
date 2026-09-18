

const dataContainer = document.getElementById('data-container');
const pagination = document.getElementById('pagination');
const prevButton = document.getElementById('prev-Button');
const NextButton = document.getElementById('next-button');
const PageNumbersContainer = document.getElementById('page-numbers');
const items = Array.from(dataContainer.getElementByClassName('item'));


const itemsPerPage = 3; //number of items per page-numbers
let currentPage = 1;

function displayPage(page) {
   const startIndex = (page - 1) * itemsPerPage;
   const endIndex = startIndex + itemsPerPage;
   
   items.forEach((item, index) => {
      if (index >= startIndex && index < endIndex) {
	     item.style.display = 'block';
		 } else {
		       items.style.display = 'none';
		 }
	});
	   
	   updatePaginationControls()
  }

       function updatePaginationControls() {	   
	       pageNumbersContainer.innerHTML = '';
		   const totalPages = Math.ceil(items.length / itemsPerPage);
		   
		   for (let i = 1; i <= totalPages; i++) {
		      const pageLink = document.CreateElement('span');
			  pageLink.classList.add('page-link');
			  pageLink.textContent = i;
			  if (i === currentPage) {
			     pageLink.classList.add('active');
			  }
			  pageLink.addEventListener('click', () => {
			      currentPage = i;
				  displayPage(currentPage);
			  });
			  pageNumbersContainer.appendChild(pageLink);
		}
			  
			  prevButton.disabled = currentPage === 1;
			  nextButton.disabled = currentPage === totalPages;
			  
	   }
			  
			  prevButton.addEventListener('click', () => {
			     if (currentPage > 1) {
				     currentPage--;
					 displayPage(currentPage);
				 }
			});
			
			nextButton.addEventListener('click', () => {
			   const totalPages = Math.ceil(items.length / itemsPerPage);
			   if (currentPage < totalPages) {
			   currentPage++;
			   displayPage(currentPage);
			 }
			 
		 });
		 displayPage(currentPage);