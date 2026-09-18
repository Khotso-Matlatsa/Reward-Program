
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
				   
				       $contactQuery = mysqli_query($con, "SELECT * FROM contacts");
				       $totalcontact = mysqli_num_rows($contactQuery);//counting total number of rows
					   
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
						
						$contacts = mysqli_query($con, "SELECT * FROM contacts LIMIT " . $startFrom .',' . $limitPerPage);
						$total_pages = ceil($totalcontact / $limitPerPage);
						
						?>
						
						<table class="table table-bordered table-striped" border=1>
						   <thead>
						       <tr>
							        <th>Caller ID</th>
									<th>Full names</th>
									 <th>Email</th>
									<th>Phone </th>
									<th>Message</th>
									<th>Delete</th>
									<th>Status</th>
									<th>Action</th>
							   </tr>
						   </thead>
						   <tbody>
						      <?php foreach($contacts as $contact) : ?>
							      <tr>
								     <td><?= $contact['caller_ID']; ?></td>
									 <td><?= $contact['fullnames']; ?></td>
									 <td><?= $contact['email']; ?></td>
									 <td><?= $contact['phone']; ?></td>
									 <td><?= $contact['message']; ?></td>
									 
									 <td><a href="messagedelete.php?id=<?php echo $row['caller_ID']; ?>">Delete</a></td> 
									<td><?php 
											// Usage of if-else statement to translate the 
											// tinyint status value into some common terms
											// 0-Inactive
											// 1-Active
											if($contact['status']=="1") 
												echo "Resolved";
											else 
												echo "Pending";
										?>                          
									</td>
									<td>
										<?php 
										if($contact['status']=="1") 
					  
											// if a course is active i.e. status is 1 
											// the toggle button must be able to deactivate 
											// we echo the hyperlink to the page "deactivate.php"
											// in order to make it look like a button
											// we use the appropriate css
											// red-deactivate
											// green- activate
											echo 
				                	"<a href=pending.php?caller_ID=".$contact['caller_ID']." class='btn red'>Pending</a>";
										else 
											echo 
					                "<a href=resolved.php?caller_ID=".$contact['caller_ID']." class='btn green'>Resolved</a>";
										?>
														 
									 
									 
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
									     <a class="page-link" href="paginate.php?page=<?= $pagination; ?>">
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