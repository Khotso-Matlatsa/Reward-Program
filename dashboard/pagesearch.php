



<?php
include('db.php'); 
if(isset($_POST['search']))
{

    
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `user_info` WHERE CONCAT(`user_id`, `fullnames`, `email`, `mobile`, `referralemail`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
	 $totaluser = mysqli_num_rows($query);//counting total number of rows

    	
}
 else {
    $query = "SELECT * FROM `user_info`";
    $search_result = filterTable($query);
}
// function to connect and execute the query
function filterTable($query)
{
	
   include('db.php'); 
    $filter_Result = mysqli_query($con, $query);
    return $filter_Result;
}

if(!isset($_GET['page'])){
					   
					      $page_number = 1;
					   
					   }else{
					      
						  if(!is_numeric($_GET['page'])){
						  
						      $page_number= 1;
						  }else{
						    $page_number= $_GET['page'];
							}
							
						}  
						
						$limitPerPage = 10;
						
						$startFrom = ($page_number - 1) * $limitPerPage;
						
						$users = mysqli_query($con, "SELECT * FROM user_info LIMIT " . $startFrom .',' . $limitPerPage);
						$total_pages = ceil($totaluser / $limitPerPage);

?>


<!DOCTYPE html>
<html>
<head>
    <title>web development</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>

	
</head>

   <body>
       <div class="container">
	      <div class="row">
		     <div class="col-md-12">
			    <div class="text-center my-4">
				   <h1>pagination</h1>
				</div>

  
  
  
        <form action="pagesearch.php" method="post" class="example">

			
			
			  <input type="text" placeholder="Search by phone number" name="valueToSearch">
  <button type="submit" name="search" value="search"><i class="fa fa-search"></i></button><br><br>
			
			
            
            <table border=1>
                <tr>
                    <th>User Id</th>
                    <th>Full names</th>
                    <th>Email</th>
					<th>Phone number</th>
					<th>Referral Email</th>
					<th>Delete</th>
					
					
                </tr>
				
				
                           <?php foreach($users as $row) : ?>
						   
						   
						   
      <!-- populate table from mysql database -->
               <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
							<td><?php echo $row['user_id']; ?></td>
							<td><?php echo $row['fullnames']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['mobile']; ?></td>
							<td><?php echo $row['referralemail']; ?></td>
							<td><a href="userdelete.php?id=<?php echo $row['user_id']; ?>">Delete</a></td>
							
							
							
                </tr>
                <?php endwhile;?>
            </table>
        </form>
  
  
  
  
  
						<div class="float-end">
						   <nav aria-label="Page navigation example">
						      <ul class="pagination">
							     <?php for($pagination = 1; $pagination <= $total_pages; $pagination++) : ?>
								 <li class="page-item
								      <?= isset($_GET['page']) ? ($_GET['page'] == $pagination ? 'active':'') : ($pagination == 1 ? 'active':''); ?>
									  ">
									     <a class="page-link" href="pagesearch.php?page=<?= $pagination; ?>">
										    <?= $pagination; ?>
										 </a>
								 </li>
							  <?php endfor; ?>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>

				<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
		
		
   </body>
   </html>
   