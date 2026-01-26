<?php 

include("conn.php");

if(isset($_POST['submit']))
    {
$email = $_POST['email'];
$password = $_POST['password'];
$sql = $conn->prepare("Select * from login where email= ? and password =? ");

$sql->bindParam(1,$email , PDO::PARAM_STR);
$sql->bindParam(2,$password , PDO::PARAM_STR);
$sql->execute();

$result = $sql->fetchAll(PDO::FETCH_ASSOC);

// while($a = $result->fetch_row())
//     {
//         echo $a[2] ."<br>";
//     }

if(count($result)>0)
    {
        echo"Done";
    }
    else
        {
            echo"Not Done";
        }

}


$sql1 = $conn->prepare("SELECT * from login");
$sql1->execute();

$result1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
echo "<br> total result =  ".$sql1->rowCount();

echo "last id = ".$conn->lastInsertId();
foreach($result1 as $a)
    {
        echo "<br>".$a['password'].'<br>';
    }



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
    <div class="container w-25 border border-danger rounded-4 p-3 ">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])  ?>" method="post">

        <span class="form-label">Enter email</span>
        <input type="text" name="email" id="" class="form-control">

        <span class="form-label">Enter Password</span>
        <input type="password" name="password" id="" class="form-control">

        <input type="submit" value="Submit" class="btn btn-success mt-3" name="submit" >
        </form>
    </div>
</body>
</html>