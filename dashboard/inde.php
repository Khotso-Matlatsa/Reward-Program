 <!DOCTYPE html> 
 <html> 
 <head> 
 <title>Basic MySQLi Commands</title> 
 </head> 
 <body> 
         <div> 
                 <form method="POST" action="add.php"> 
                         <label>Full name:</label><input type="text" name="firstname"> 
                         <label>Email:</label><input type="text" name="lastname"> 
                         <input type="submit" name="add"> 
                 </form> 
         </div> 
         <br> 
         <div> 
                 <table border="1"> 
                         <thead> 
						         
                                 <th>Full name</th> 
                                 <th>Email</th> 
                                 <th>Action</th>
                                 <th>Action</th>								 
                         </thead>                          
			<?php 
              include('db.php'); 
										 
										 
	 $query=mysqli_query($con,"select * from `user_info`"); 
            while($row=mysqli_fetch_array($query)){ 
          ?> 
          <tr> 
               <td><?php echo $row['fullnames']; ?></td> 
               <td><?php echo $row['email']; ?></td> 
               <td><a href="updates.php?id=<?php echo $row['user_id']; ?>">Edit</a> </td>
                 <td>  <a href="delete.php?id=<?php echo $row['user_id']; ?>">Delete</a></td> 
          </tr> 
              <?php 
                 } 
               ?> 
              </tbody> 
              </table> 
         </div> 
 </body> 
 </html> 