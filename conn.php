<?php
$database = "mysql:host=localhost;dbname=creart;";
$conn = new PDO($database,"root","");

if(!$conn)
{
	die("not Connted");
}

else
{
	echo "Connted";
}


?>