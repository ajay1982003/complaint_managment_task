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
        $id_get = $_GET['id'];
		$name_data = $_POST['name'];
		$email_data = $_POST['email'];
		$no_data = $_POST['no'];
		$complain_data = $_POST['complain'];
		$priority_data = $_POST['priority'];
		$Message_data = $_POST['Message'];


		


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

		  if(!empty($_FILES['file']['tmp_name']))
            {
                $filename = $_FILES['file']['name'];
		$tmpname = $_FILES['file']['tmp_name'];
		move_uploaded_file($tmpname, "upload/".$filename);
            }
            	elseif($_FILES['file']["size"]<1000)
		{
			$file="file is larger";
		}
            else
            {
                    $filename= $_POST['old_file'];
            }
	
	$file_data = "upload/".$filename;

		if($name==""&&$email=="" && $no=="" && $complain=="" && $Priority=="" && $Message=="")
		{

			$sql = $conn->prepare("update complaint_form set name=?,email=?,mobil=? , complain =? , priority=? , message=? , file=? where id=?");
			$sql->bindParam(1,$name_data,PDO::PARAM_STR);
			$sql->bindParam(2,$email_data,PDO::PARAM_STR);
			$sql->bindParam(3,$no_data,PDO::PARAM_STR);
			$sql->bindParam(4,$complain_data,PDO::PARAM_STR);
			$sql->bindParam(5,$priority_data,PDO::PARAM_STR);
			$sql->bindParam(6,$Message_data,PDO::PARAM_STR);
			$sql->bindParam(7,$file_data,PDO::PARAM_STR);
            $sql->bindParam(8,$id_get,PDO::PARAM_INT);
			//$result = mysqli_query($conn,$sql);
			$sql->execute();

			if($sql->rowCount()>0)
			{
					header("Location:display_data.php");

			}
		}

        


}

        $id_get = $_GET['id'];
	

		$file_data = "upload".$filename;
$sql1 = $conn->prepare("select * from complaint_form where id=?");
$sql1->bindParam(1,$id_get,PDO::PARAM_INT);
$sql1->execute();

$result = $sql1->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $a)
    {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    <div class="container border mt-3 p-4">
		<div class="row">
		<div class="col-2">
			<a href="display_data.php" ><button class="btn btn-primary">View data</button></a>
		</div>

		<div class="col-2">
		<a href="logout.php"><button class="btn btn-danger">Logout</button></a>

		</div>
	</div>

		<h1>Complaint form</h1>
			<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" >
				<div class="row row-cols-2">
					<div class="col">
						<span>Enter Name</span><span class="text-danger">*</span>
						<input class="form-control" type="text" name="name" value="<?php echo $a['name']; ?>" <?php if(isset($_POST['submit'])){ echo $name; } ?>>
						<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $name; } ?></span>
					</div>

					<div class="col">
						<span>Enter Email</span><span class="text-danger">*</span>
						<input class="form-control" type="text" name="email" value="<?php echo $a['email']; ?>" <?php if(isset($_POST['submit'])){ echo $email1; } ?>>
						<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $email; } ?></span>
					</div>

					<div class="col">
						<span>Enter Mobile Number</span><span class="text-danger">*</span>
						<input class="form-control" type="text" name="no" value="<?php echo $a['mobil']; ?>" <?php if(isset($_POST['submit'])){ echo $no; } ?>>
							<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $no; } ?></span>
					</div>

					<div class="col">
						<span>Complain type</span><span class="text-danger">*</span>
						<select name="complain" class="form-control">
							<option value="">Select</option>
							<option value="staff" <?php if($a['complain']=="staff"){ echo "selected"; } ?>>Staff</option>
							<option value="job" <?php if($a['complain']=="job"){ echo "selected"; } ?>>Job</option>
						</select>
						<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $complain; } ?></span>
					</div>

					<div class="col">
						<span>Priority</span><span class="text-danger">*</span>
						<select name="priority" class="form-control">
							<option value="">Select</option>
							<option value="High" <?php if($a['priority']=="High"){ echo "selected"; } ?>>High</option>
							<option value="Low" <?php if($a['priority']=="Low"){ echo "selected"; } ?>>Low</option>

						</select>
						<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $Priority; } ?></span>
					</div>

					<div class="col">
						<span>Message</span><span class="text-danger">*</span>
						<textarea name="Message" value="<?php echo $a['message']; ?>" class="form-control"></textarea>
						<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $Message; } ?></span>

					</div>

					<div class="col">
						<span>Upload file</span><span class="text-danger">*</span>
						<input type="file" name="file" class="form-control" >
                        <input type="hidden" name="old_file" value="<?php echo $a['file'] ?>">
						<span class="text-danger"><?php if(isset($_POST['submit'])){ echo $file; } ?></span>

                        <img class="card-img w-25" src="<?php echo $a['file'] ?>"></img>

					</div>
                    
				</div>
				<input type="submit" name="submit" class="btn btn-success mt-3">
			</form>
			<?php echo $_SESSION['email'] ; ?>
	</div>
    <?php } ?>
</body>
</html>