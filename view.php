<?php

session_start();

if(isset($_SESSION['email']) && !isset($_GET['id']) )
{
	header("Location:login_database.php");
}

include("conn.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<title></title>
</head>
<body>

	<div class="container" >
			<table class="table table-bordered w-50 mt-3">
				<tr>
					<th>No</th>
					<th>Image</th>
					<th>Name</th>
					<th>Email</th>
					<th>No</th>
					<th>Complain</th>
					<th>Priority</th>
					<th>Message</th>
					
				</tr>
				<?php
					if(isset($_GET['id']))
					{
						$id = $_GET['id'];

						 $sql = "Select * from complaint_form where id=$id";

						 $sql = $conn->prepare("Select * from complaint_form where id=?");
						 $sql->bindParam(1,$id,PDO::PARAM_INT);
						// $result = mysqli_query($conn,$sql);
							$sql->execute();
							$a = $sql->fetch(PDO::FETCH_ASSOC);
						// foreach($result as $a)
						// 	{

						
					
				?>
				<tr>
					<th><?php echo $a['id']; ?></th>
					<th><img class="w-100" src="<?php echo $a['file']; ?>">  </th>
					<th><?php echo $a['name']; ?></th>
					<th><?php echo $a['email']; ?></th>
					<th><?php echo $a['mobil']; ?></th>
					<th><?php echo $a['complain']; ?></th>
					<th class="<?php if($a['priority']=='High'){echo "badge text-bg-success";} else{echo "badge text-bg-danger";} ?> m-2"><?php echo $a['priority']; ?></th>
					<th><?php echo $a['message']; ?></th>
				</tr>

				

			<?php  } ?>
			</table>
		</div>
</body>
</html>