<?php
$database = "mysql:host=localhost;dbname=creart";
$conn = new PDO($database,"root","");

$email = $_POST['email_data'];
$password = $_POST['password_data'];

$sql = $conn->prepare("insert into login (email,password) VALUES(?,?)");
$sql->bindParam(1,$email,PDO::PARAM_STR);
$sql->bindParam(2,$password,PDO::PARAM_STR);

$sql->execute();

if($sql->rowCount()>0)
    {
        echo "1";
    }
else
    {
        echo "0";
    }


?>