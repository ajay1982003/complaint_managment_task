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
		return "done";
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
 	return "done";
 }
}

?>