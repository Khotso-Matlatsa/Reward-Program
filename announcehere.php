<!DOCTYPE html>
<html>
<head>
	<title>POST AND COMMENT SYSTEM</title>
	 
	


</head>
<body>
       

            <?php	
			     include('db.php');

                $query = mysqli_query($con,"SELECT date_created AS TimeSpent from tblannouncements LEFT JOIN user_info on user_info.user_id = tblannouncements.user_id order by announcementid DESC");
				$result= mysqli_query($con, $query);
				if (!$result){
					die("query_failed: " . mysqli_error($con));
				}
				
				if (mysqli_num_rows($result) > 0) {
				while($post_row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				
				
				$id = $post_row['announcementid'];	
				$upid = $post_row['user_id'];	
				$posted_by = admin;
			?>
		
		<h3>Posted by: <a href="#"> <?php echo $posted_by; ?></a>
		-
			<?php				
					$days = floor($post_row['TimeSpent'] / (60 * 60 * 24));
					$remainder = $post_row['TimeSpent'] % (60 * 60 * 24);
					$hours = floor($remainder / (60 * 60));
					$remainder = $remainder % (60 * 60);
					$minutes = floor($remainder / 60);
					$seconds = $remainder % 60;
					if($days > 0)
					echo date('F d, Y - H:i:sa', $post_row['date_created']);
					elseif($days == 0 && $hours == 0 && $minutes == 0)
					echo "A few seconds ago";		
					elseif($days == 0 && $hours == 0)
					echo $minutes.' minutes ago';
			?>
		<br>
		<br><?php echo $post_row['content']; ?></h3>
		<form method="post" action="insertcomment.php">
		<hr>
		Comment:<br>
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<textarea name="comment_content" rows="2" cols="44" style="" placeholder=".........Type your comment here........" required></textarea><br>
		<input type="submit" name="comment">
		</form>
			
		</br>
	
				<?php 
					$comment_query = mysqli_query($con,"SELECT * ,UNIX_TIMESTAMP() - date_posted AS TimeSpent FROM tblannouncecomments LEFT JOIN user_info on user_info.user_id = tblannouncecomments.user_id where announcementid = '$id'") or die (mysqli_error());
					while ($comment_row=mysqli_fetch_array($comment_query)){
					$comment_id = $comment_row['announcecommentid'];
					$comment_by = $comment_row['fullnames'];
				?>
		<br><a href="#"><?php echo $comment_by; ?></a> - <?php echo $comment_row['commentcontent']; ?>
		<br>
				<?php				
					$days = floor($comment_row['TimeSpent'] / (60 * 60 * 24));
					$remainder = $comment_row['TimeSpent'] % (60 * 60 * 24);
					$hours = floor($remainder / (60 * 60));
					$remainder = $remainder % (60 * 60);
					$minutes = floor($remainder / 60);
					$seconds = $remainder % 60;
					if($days > 0)
					echo date('F d, Y - H:i:sa', $comment_row['commentdate']);
					elseif($days == 0 && $hours == 0 && $minutes == 0)
					echo "A few seconds ago";		
					elseif($days == 0 && $hours == 0)
					echo $minutes.' minutes ago';
				?>
		<br>
				<?php
				}
				?>
		<hr
		&nbsp;
		<?php 
		if ($u_id = $id){
		?>
		
	
		
		<?php }else{ ?>
			
		<?php
				} } }?>
		
		</body>
		</html>