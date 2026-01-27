<?php
$database = "mysql:host=localhost;dbname=creart;";
$conn = new PDO($database,"root","");
if(isset($_POST['serach_data']))
    {
$serach_data = "%".$_POST['serach_data']."%";
$mysql = $conn->prepare("Select * from login where email LIKE ?");
$mysql->bindParam(1,$serach_data,PDO::PARAM_STR);
$mysql->execute();

$result = $mysql->fetchAll(PDO::FETCH_ASSOC);
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
  <div class="container">
    <table class="table table-bordered table-striped mt-5 ">
      <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Passoword</th>
       
      </tr>
 

<?php

  foreach($result as $a)
{   
  
  ?>
  
 <tr>
  <th><?php echo $a['id'] ; ?></th>
  <th><?php echo $a['email'] ; ?></th>
  <th><?php echo $a['password'] ; ?></th>
  
 </tr>
    
<?php
}

    }

?>
</table>
 </div>
</body>
</html>