<?php
include("db.php");



if (isset($_POST['comment'])){
$comment = $_POST['comment_content'];

mysqli_query($con,"insert into tblannouncecomments (commentcontent,user_id,announcementid) values ('$comment','$user_id','$content')") or die (mysqli_error());

?>
<script>
window.location = 'announcecomment.php';
</script>

<?php
}
?>