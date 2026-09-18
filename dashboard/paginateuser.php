
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
				   <?php
				   include('db.php');
				   
				       $userQuery = mysqli_query($con, "SELECT * FROM user_info");
				       $totaluser = mysqli_num_rows($userQuery);//counting total number of rows
					   
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
						
						<table class="table table-bordered table-striped" border=1>
						   <thead>
						       <tr>
							        <th>User ID</th>
									<th>Full names</th>
									 <th>Email</th>
									<th>Phone </th>
									<th>Referral Email</th>
									<th>Delete</th>
									
							   </tr>
						   </thead>
						   <tbody>
						      <?php foreach($users as $user) : ?>
							      <tr>
								        <td><?= $user['user_id']; ?></td>
										<td><?= $user['fullnames']; ?></td>
										<td><?= $user['email']; ?></td>
										<td><?= $user['mobile']; ?></td>
										<td><?= $user['referralemail']; ?></td>
										<td><a href="userdelete.php?id=<?php echo $row['user_id']; ?>">Delete</a></td>
										
										
								     
								  </tr>
							  <?php endforeach; ?>
						   </tbody>
						</table>
						
						<div class="float-end">
						   <nav aria-label="Page navigation example">
						      <ul class="pagination">
							     <?php for($pagination = 1; $pagination <= $total_pages; $pagination++) : ?>
								 <li class="page-item
								      <?= isset($_GET['page']) ? ($_GET['page'] == $pagination ? 'active':'') : ($pagination == 1 ? 'active':''); ?>
									  ">
									     <a class="page-link" href="paginateuser.php?page=<?= $pagination; ?>">
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