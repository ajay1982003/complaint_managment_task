<?php
session_start();

if(!isset($_SESSION['email']))
{
	header("Location:login_database.php");
}
include('conn.php');
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container border p-3">
	<form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
	<div class="row">
		

			<div class="col-3">
				<select name="priority_filter" class="form-control">
						<option value=" ">Priority</option>
						<option value="low">Low</option>
						<option value="high">High</option>
				</select>
			</div>

			<div class="col-3">
				<select name="priority_complain" class="form-control">
						<option value=" ">Complain</option>
						<option value="staff">Staff</option>
						<option value="job">Job</option>
				</select>
			</div>

			<div class="col-3">
				<input type="text" name="priority_name" class="form-control" placeholder="Search data">
			</div>

			<div class="col-3">
				<input type="submit" name="filter" value="Filter" class="btn btn-primary">
			</div>
		</form>

	</div>


	<table class="table table-striped table-bordered mt-4 w-50" border="1">
<tr>
	<th>Complaint id</th>
	<th>Name</th>
	<th>Email</th>
	<th>No</th>
	<th>Complain</th>
	<th>Priority</th>
	<th>Message</th>
	<th>View</th>
	<th>Update</th>
</tr>
<?php


// if(isset($_POST['filter']))
// {
// $sql1= "Select * from complaint_form where priority='$priority_filter' OR complain='$complain_filter' OR name LIKE '%$name_filter%' ";	
// }
// elseif(isset($_POST['filter']))
// {
// 	// $sql1="SELECT * from complaint_form where name LIKE '%$name_filter%' ";
// }

// else
// {
// $sql1= "Select * from complaint_form ";

// }

if(isset($_POST['filter']))
{

$priority_filter =$_POST['priority_filter'];
$name_filter = $_POST['priority_name'];
$complain_filter = $_POST['priority_complain'];

if(isset($_POST['priority_filter']))
{
	$sql1= "Select * from complaint_form where priority='$priority_filter' ";	
}
elseif(isset($_POST['priority_complain']))
{
	$sql1= "Select * from complaint_form where complain='$complain_filter'  ";	
}
 elseif(isset($_POST['priority_name']))
{
	$sql1="SELECT * from complaint_form where name LIKE '%$name_filter%' ";
}
else
{
$sql1= "Select * from complaint_form ";

}

$result1 = mysqli_query($conn,$sql1);

while ($a=mysqli_fetch_array($result1)) {
	


?>

<tr>
	<td><?php echo $a['id'] ?></td>
	<td><?php echo $a['name'] ?></td>
	<td><?php echo $a['email'] ?></td>
	<td><?php echo $a['mobil'] ?></td>
	<td><?php echo $a['complain'] ?></td>
	<td class="<?php if($a['priority']=='high'){echo "badge text-bg-success";} else{echo "badge text-bg-danger";} ?> m-2" ><?php echo $a['priority']; ?></td>
	<td><?php echo $a['message'] ?></td>
	<th><a href="view.php?id=<?php echo $a['id'] ?>">View</a></th>
	<th><a href="update.php?id=<?php echo $a['id'] ?>">Update</th>



</tr>
<?php
}

}

?>

</table>


<div>
		<a href="logout.php"><button class="btn btn-danger">Logout</button></a>
</div>
</div>
</body>
</html>