
<?php
	
                 <table border="1"> 
                         <thead> 
						         
                                 <th>File ID</th> 
                                 <th>File Name</th> 
                                 <th>Action</th>
                                 <th>Status</th>								 
                         </thead> 
  
                         
			<?php 
              include('db.php'); 
										 
										 
	 $query=mysqli_query($con,"select * from `files`"); 
            while($row=mysqli_fetch_array($query)){ 
          ?> 
          <tr> 
               <td><?php echo $row['file_id']; ?></td> 
               <td><?php echo $row['filename']; ?></td> 
               
                 <td>  <a href="deletefile.php?id=<?php echo $row['file_id']; ?>">Delete</a></td> 
          </tr> 
              <?php 
			  
                       </tbody> 
              </table>  
			  } 
               ?> 
              
         



