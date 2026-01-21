<?php

$conn = mysqli_connect("localhost","root","","creart");

if($conn)
{
	echo "Connted";
}

else
{
	echo "not Connted";
}


?>