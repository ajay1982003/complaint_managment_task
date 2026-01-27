<?php
$database = "mysql:host=localhost;dbname=creart;";
$conn = new PDO($database,"root","");

$mysql = $conn->prepare("Select * from login");
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
    <table class="table table-bordered table-striped ">
      <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Passoword</th>
        <th>Delete</th>
      </tr>
 

<?php

  foreach($result as $a)
{   
  
  ?>
  
 <tr>
  <th><?php echo $a['id'] ; ?></th>
  <th><?php echo $a['email'] ; ?></th>
  <th><?php echo $a['password'] ; ?></th>
  <th class="btn btn-danger" data-id="<?php echo $a['id'] ; ?>" >Delete</th>
 </tr>
    
<?php
}


?>
</table>
 </div>
</body>
</html>