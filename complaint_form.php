<?php
session_start();
include("conn.php");
if(!isset($_SESSION['email']))
{
	header("Location:login_database.php");
}
if(isset($_POST['submit']))
{	
		$name=$email=$no=$complain=$file=$Priority=$Message="";
		$name1=$email1=$no1=$complain1=$file1=$Priority1=$Message1="";
		
		$time = time();
		$random = rand();

		$name_data = $_POST['name'];
		$email_data = $_POST['email'];
		$no_data = $_POST['no'];
		$complain_data = $_POST['complain'];
		$priority_data = $_POST['priority'];
		$Message_data = $_POST['Message'];

		$filename = $_FILES['file']['name'];
		$tmpname = $_FILES['file']['tmp_name'];

		move_uploaded_file($tmpname, "upload/".$filename);



	$date=date('Y-m-d H:i:s',$time);
		if(empty($_POST['name']))
		{
			$name="flied is required";
		}
		else
		{
			$name1=$_POST['name'];
		}

		if(empty($_POST['email']))
		{
			$email="Flied is required";
		}
		elseif(!filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL))
		{
			$email="NOt proper email formate";
		}

		else
		{
			$email1=$_POST['email'];
		}

		if(empty($_POST['no']))
		{
			$no="Flied is required";
		}

		elseif (!preg_match("/^[0-9]{10}$/", $_POST['no']))
		{
			$no="Number must be of 10 digit";
		}
		else
		{
			$no1= $_POST['no'];
		}

		if(empty($_POST['complain']))
		{
			$complain="NOT selected";
		}
		else
		{
			$complain1= $_POST['complain'];
		}

		if(empty($_POST['priority']))
		{
			$Priority="NOT selected";
		}
		else
		{
			$Priority1= $_POST['priority'];
		}

			if(empty($_POST['Message']))
		{
			$Message="NOT selected";
		}
		else
		{
			$Message1= $_POST['Message'];
		}

		if(empty($_POST['file']))
		{
			$file="NOT Empty";
		}
		elseif($_FILES['file']["size"]<1000)
		{
			$file="file is larger";
		}
		else
		{

		}

		if($name==""&&$email=="" && $no=="" && $complain=="" && $Priority=="" && $Message=="")
		{
			$sql = "insert into complaint_form (name,email , mobil , complain , priority, message , file) VALUES('$name_data','$email_data','$no_data','$complain_data','$priority_data','$Message_data' , 'upload/$filename')";

			$result = mysqli_query($conn,$sql);

			if($result)
			{
					header("Location:complaint_form.php");

			}
		}




}

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
	<div class="container border mt-3 p-4">

		<h1>Complaint form</h1>
			<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" >
				<div class="row row-cols-2">
					<div class="col">
						<span>Enter Name</span><span class="text-danger">*</span>
						<input class="form-control" type="text" name="name" <?php if(isset($_POST['submit'])){ echo $name; } ?>>
						<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $name; } ?></span>
					</div>

					<div class="col">
						<span>Enter Email</span><span class="text-danger">*</span>
						<input class="form-control" type="text" name="email" <?php if(isset($_POST['submit'])){ echo $email1; } ?>>
						<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $email; } ?></span>
					</div>

					<div class="col">
						<span>Enter Mobile Number</span><span class="text-danger">*</span>
						<input class="form-control" type="text" name="no" <?php if(isset($_POST['submit'])){ echo $no; } ?>>
							<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $no; } ?></span>
					</div>

					<div class="col">
						<span>Complain type</span><span class="text-danger">*</span>
						<select name="complain" class="form-control">
							<option value="">Select</option>
							<option value="staff">Staff</option>
							<option value="job">Job</option>
						</select>
						<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $complain; } ?></span>
					</div>

					<div class="col">
						<span>Priority</span><span class="text-danger">*</span>
						<select name="priority" class="form-control">
							<option value="">Select</option>
							<option value="High">High</option>
							<option value="Low">Low</option>

						</select>
						<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $Priority; } ?></span>
					</div>

					<div class="col">
						<span>Message</span><span class="text-danger">*</span>
						<textarea name="Message" class="form-control"></textarea>
						<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $Message; } ?></span>

					</div>

					<div class="col">
						<span>Upload file</span><span class="text-danger">*</span>
						<input type="file" name="file" class="form-control">
						<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $file; } ?></span>
					</div>
				</div>
				<input type="submit" name="submit" class="btn btn-success mt-3">
			</form>
	</div>




</body>
</html>

