<?php
$database = "mysql:host=localhost;dbname=creart;";
$conn = new PDO($database,"root","");

$mysql = $conn->prepare("Select * from login");
$mysql->execute();

$result = $mysql->fetchAll(PDO::FETCH_ASSOC);


  foreach($result as $a)
{
    echo "<tr><td>". $a['email'] . "</td>";
    echo "<td>". $a['password'] . "</td></tr>";
}


?>