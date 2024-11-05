<?php 
require_once("include/config.php");
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: error.php"); // Redirect to an error page or home page
    exit();
}
if(!empty($_POST["emailid"])) {
	$email= $_POST["emailid"];
	
		$result =mysqli_query($con,"SELECT docEmail FROM doctors WHERE docEmail='$email'");
		$count=mysqli_num_rows($result);
if($count>0)
{
echo "<span style='color:red'> Email already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Email available for Registration .</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}


?>
