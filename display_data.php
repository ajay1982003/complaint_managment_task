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
				<select name="priority_filter" class="form-control" >
						<option value=" ">Priority</option>
						<option value="low" <?php if(isset($_POST['filter'])){ if($_POST['priority_filter']== "low"){echo "selected" ;} }?>>Low</option>
						<option value="high" <?php if(isset($_POST['filter'])){ if($_POST['priority_filter']== "high"){echo "selected" ;} }?> >High</option>
				</select>
			</div>

			<div class="col-3">
				<select name="priority_complain" class="form-control">
						<option value=" ">Complain</option>
						<option value="staff" <?php if(isset($_POST['filter'])){ if($_POST['priority_complain']== "staff"){echo "selected" ;} }?>>Staff</option>
						<option value="job" <?php if(isset($_POST['filter'])){ if($_POST['priority_filter']== "job"){echo "selected" ;} }?>>Job</option>
				</select>
			</div>

			<div class="col-3">
				<input type="text" name="priority_name" class="form-control" placeholder="Search data" >
			</div>

			<div class="col-3">
				<input type="submit" name="filter" value="Filter" class="btn btn-primary">
			</div>
		</form>

	</div>
	<div class="row">
		<div class="col-2">
			<a href="complaint_form.php" ><button class="btn btn-primary">Insert complain</button></a>
		</div>

		<div class="col-2">
		<a href="logout.php"><button class="btn btn-danger">Logout</button></a>

		</div>
	</div>

	<table class="table table-striped table-bordered mt-4 w-50" border="1">
<tr>
	<th>Complaint id</th>
	<th>image</th>
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


if(isset($_POST['filter']))
{

$priority_filter =$_POST['priority_filter'];
$name_filter = "%".$_POST['priority_name']."%";
$complain_filter = $_POST['priority_complain'];



	if($_POST['priority_filter']!=" ")
	{
	$sql1= $conn->prepare("Select * from complaint_form where priority=? ");	
	$sql1->bindParam(1,$priority_filter,PDO::PARAM_STR);
	}

	if($_POST['priority_complain']!=" ")
	{
	$sql1= $conn->prepare( "Select * from complaint_form where complain= ? ");	
	$sql1->bindParam(1,$complain_filter,PDO::PARAM_STR);

	}

	if($_POST['priority_name']!=NULL)
	{
	$sql1= $conn->prepare( "Select * from complaint_form where name LIKE ? ");	
	$sql1->bindParam(1,$name_filter,PDO::PARAM_STR);

	}

	$sql1->execute();

	$result1 = $sql1->fetchAll(PDO::FETCH_ASSOC);

// $result1 = mysqli_query($conn,$sql1);

foreach($result1 as $a ) {
	


?>

<tr>
	<td><?php echo $a['id'] ?></td>
	<td><img class="w-100" src="<?php echo $a['file']; ?>" ></td>
	<td><?php echo $a['name'] ?></td>
	<td><?php echo $a['email'] ?></td>
	<td><?php echo $a['mobil'] ?></td>
	<td><?php echo $a['complain'] ?></td>
	<td class="<?php if($a['priority']=='High'){echo "badge text-bg-success";} else{echo "badge text-bg-danger";} ?> m-2" ><?php echo $a['priority']; ?></td>
	<td><?php echo $a['message'] ?></td>
	<th><a href="view.php?id=<?php echo $a['id'] ?>">View</a></th>
	<th><a href="update.php?id=<?php echo $a['id'] ?>">Update</th>



</tr>
<?php
}

}
else
{


	//$sql1= "Select * from complaint_form  ";	
	
$sql1 = $conn->prepare("Select * from complaint_form");
$sql1->execute();

$result1 = $sql1->fetchAll(PDO::FETCH_ASSOC);

// $result1 = mysqli_query($conn,$sql1);

// while ($a=mysqli_fetch_array($result1)) 
	foreach($result1 as $a)
	{
	


?>

<tr>
	<td><?php echo $a['id'] ?></td>
	<td><img class="w-100" src="<?php echo $a['file']; ?>" ></td>
	<td><?php echo $a['name'] ?></td>
	<td><?php echo $a['email'] ?></td>
	<td><?php echo $a['mobil'] ?></td>
	<td><?php echo $a['complain'] ?></td>
	<td class="<?php if($a['priority']=='High'){echo "badge text-bg-success";} else{echo "badge text-bg-danger";} ?> m-2" ><?php echo $a['priority']; ?></td>
	<td><?php echo $a['message'] ?></td>
	<th><a href="view.php?id=<?php echo $a['id'] ?>">View</a></th>
	<th><a href="update.php?id=<?php echo $a['id'] ?>">Update</th>



</tr>
<?php
}
}




?>

</table>

<nav aria-label="...">
			
			<ul class="pagination pagination-sm ">
<?php
// $sql2 = "Select * from complaint_form";

$sql2 = $conn->prepare("Select * from complaint_form");
$sql2->execute();
// $result2 = mysqli_query($conn,$sql2);

$result2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

if($sql2->rowCount()>0)
{
	$total = $sql2->rowCount();
	$limit = 3;
	$page = ceil($total / $limit);

	for ($i=1; $i<=$page ; $i++) { 
		

?>
				<li class="page-item"><a href="display_data.php?page_no=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
<?php
	}
}
?>
				
			</ul>
		</nav>
		
</div>

	
	
</div>
</body>
</html>
