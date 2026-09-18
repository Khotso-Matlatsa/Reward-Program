
  <?php
include 'db.php';
if(isset($_POST['search']))
{

    $valueToSearch = $_POST['valueToSearch'];
    $ValueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `user_info` WHERE CONCAT(`user_id`, `fullnames`, `email`, `mobile`, `referral`) LIKE '%".$ValueToSearch."%'";
    $search_result = filterTable($query);
    	
}
 else {
    $query = "SELECT * FROM `user_info`";
    $search_result = filterTable($query);
}
// function to connect and execute the query
function filterTable($query)
{
	
    include 'db.php';
    $filter_Result = mysqli_query($con, $query);
    return $filter_Result;
}

?>
  
  
  
        <form action="searchuser.php" method="post" class="example">

			
			
			  <input type="text" placeholder="Search by phone number" name="valueToSearch">
  <button type="submit" name="search"><i class="fa fa-search"></i></button><br><br>
			
			
            
            <table>
                <tr>
                    <th>User Id</th>
                    <th>Full names</th>
                    <th>Email</th>
					<th>Phone number</th>
					<th>Referral email</th>
					<th>Delete</th>
					<th>Update</th>
					
					
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
							<td><?php echo $row['user_id']; ?></td>
							<td><?php echo $row['fullnames']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['mobile']; ?></td>
							<td><?php echo $row['referralemail']; ?></td>
							
							<td><a href="deleteapp.php?id=<?php echo $row['user_id']; ?>">Delete</a></td>
						    <td><a href="edit.php?id=<?php echo $row['user_id']; ?>">Update</a></td>
							
							
                </tr>
                <?php endwhile;?>
            </table>
        </form>
  
  