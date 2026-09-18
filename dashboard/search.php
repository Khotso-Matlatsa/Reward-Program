<?php 
include 'db.php';
$search=$_POST['valuetosearch'];
$q=mysqli_query($con,"select * from user_info where email='$search' or mobile='$search'");
$rr=mysqli_num_rows($q);
if(!$rr)
{
echo "<h2 style='color:red'>No any Records exists !!!</h2>";
}
else
{
?>
<script>
	function DeleteGrop(id)
	{
		if(confirm("You want to delete this Group ?"))
		{
		window.location.href="deletefile.php?id="+id;
		}
	}
</script>



<h2 style="color:#00FFCC; text-decoration:underline" align="center" >Results Found</h2>


<form action="search.php" method="post">
	<input type="text" name="valuetosearch" placeholder="Search Record">
	<input type="submit" name="search" value="search record">
</form>


<table class="table table-bordered">
	
	
	<Tr class="active">
		<th>User ID</th>
		<th>User Name</th>
		<th>Email</th>
		<th>phone number</th>
		<th>Referral email</th>
		<th>Delete</th>
		<!--<th>Update</th>-->
	</Tr>
		<?php 


$i=1;
while($row=mysqli_fetch_assoc($q))
{

echo "<Tr>";
echo "<td>".$i."</td>";
echo "<td>".$row['user_id']."</td>";
echo "<td>".$row['fullnames']."</td>";
echo "<td>".$row['email']."</td>";
echo "<td>".$row['mobile']."</td>";
echo "<td>".$row['referral']."</td>";

?>

<Td><a href="javascript:DeleteGrop('<?php echo $row['user_id']; ?>')" style='color:Red'><span class='glyphicon glyphicon-trash'></span></a></td>

<!--<Td><a href="index.php?page=update_group" style='color:green'><span class='glyphicon glyphicon-edit'></span></a></td>-->

<?php 
echo "</Tr>";
$i++;
}
		?>
		
</table>
<?php }?>