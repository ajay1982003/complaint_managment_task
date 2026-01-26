<?php

function email($email_data)
{
	
	if(empty($email_data))
	{
		return "email required";
	}
	elseif(!filter_var($email_data, FILTER_VALIDATE_EMAIL))
	{
		return "email is not proper";
	}
	else
	{
		return " ";
	}

}


function password($password_data)
{
 if(empty($password_data))
 {
 	return "not empty";
 }

 elseif(preg_match("/^{8}$/", $password_data))
 {
 	return "password must of 8 letter";
 }

 else
 {
 	return " ";
 }
}

class first_class{
	public $a , $b , $c;



	function __construct($a,$b,$c)
	{
		$this->a = $a;
		$this->b = $b;
		$this->c = $c;
	}

	function __destruct()
	{
		echo "End of object";
	}
}


class second_class extends first_class
{
		function myfuc()
	{
		echo $this->a ."<br>" ;
		echo $this->b ."<br>";
		echo $this->c ."<br>" ;
	}
}

$c1 = new second_class(20,30,40);

// $c1->a = 20;
// $c1->b = 30;
// $c1->c = 40;

$c1->myfuc();

abstract class Vehicle {
    abstract function speed();
}

class Bike extends Vehicle {
    function speed() {
        echo "80 km/h";
    }
}

$c2 = new Bike();

$c2->speed();


interface a{
	
	function ab();
}

interface b{
	function ac();
}

class print_data implements a,b
{	
	public $data;
	function ab()
	{
		echo "<br>".$this->data."ab","<br>";
	}

	function ac()
	{
		echo "ac","<br>";
	}
}

$c3 = new print_data();

$c3->data = 100;

$c3->ab();

$c3->ac();
?>