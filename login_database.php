<?php 
session_start();
if(isset($_SESSION['email']))
{
	header("Location:complaint_form.php");
}



if(isset($_POST['submit']))
{
	include("validate.php");
	include("conn.php");
	$email = email($_POST['email']);
	$password = password($_POST['password']);
	$email_data = $_POST['email'];
	$password_data = $_POST['password'];
	if($_POST['check'] == 'checked')
	{
		setcookie("email",$email_data,time()+3600);
		setcookie("password",$password_data,time()+3600);

	}

	if($_POST['not_check'] == 'checked')
	{
		setcookie("email",$email_data,time()-3600);
		setcookie("password",$password_data,time()-3600);

	}

	if($email ==" " && $password==" ")
	{
	header("Location:complaint_form.php");

	$_SESSION['email'] = $email_data;

		// $sql="insert into login (email , password) VALUES('$email_data','$password_data')";
		$sql="Select * from login where email='$email' and password='$password'";
		$result = mysqli_query($conn , $sql);


	// $sql=$conn->prepare("Select * from login where email=? AND password=?");

	// 	$sql->bind_param("ss",$email,$password);
	// 	 $sql->execute();
	// 	 $result = $sql->get_result();
		 
		if(mysqli_num_rows($result)>0)
		{
			

			$_SESSION['email'] = $email_data;

			header("Location:complaint_form.php");
		}

		else
		{
			$not_found = "No User Found";
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
	<style type="text/css">
		/*.red_color
		{
			color: red;
		}
		.form_box
		{
			width: 40%;
			height: 200px;
			background-color: whitesmoke;
			border: 1px solid black;
		}*/
	</style>
</head>
<body>
		<div class="container-md border mt-5 bg-info-subtle">
			<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="Post">
				<span class="fs-1">Login Form</span>
				<div class="row">
					<div class="col p-2">
						<span >Enter name <span class="text-danger">*</span></span>
						<input class="form-control mt-2" type="text" name="email" placeholder="Enter your email" value="<?php if(isset($_COOKIE['email'] )){ echo $_COOKIE['email']; }?>">
						<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $email; } ?></span>

						
					</div>

					<div class="col p-2">
						<span>Enter Password <span class="text-danger">*</span></span>
						<input class="form-control mt-2" type="password" name="password" placeholder="Enter your Password" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>">
						<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $password; } ?></span>


					</div>


				</div>

				<div class="col from-check">
						<input type="checkbox" class="form-check-input" value="checked"  name="check">
						<label class= "form-check-label">Rember me</label>

				</div>

				<div class="col from-check">
						<input type="checkbox" class="form-check-input" value="checked"  name="not_check">
						<label class= "form-check-label"> not Rember me</label>

				</div>
				<div class="row">
				<span class="row text-danger mt-2 alert "><?php if(isset($_POST['submit'])){ echo $not_found; } ?></span>

				
				</div>
				<input  type="submit" name="submit" value="Login" class="btn btn-success mt-4 mb-2">
			</form>
		</div>

		
</body>
</html>





