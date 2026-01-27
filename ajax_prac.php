<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		#insert_mess{
			color:green;
		}
	</style>
    <title>Document</title>
</head>
<body>
	<div class="border-1 border-danger w-50 ">
		<form method="post">
			<div class="form-floating mt-4">
			<input type="email" placeholder="name@example.com" id="floatingInputValue" name="email" id="floatingInput" class="form-control">
			<label for="floatingInput">Enter email</label>
			</div>
			<div class="form-form-floating mt-3">
			
			<input type="password" name="password" id="floatingInputValue"  class="form-control" placeholder="Password">
			<label for="floatingInput">Enter Password</label>
			</div>

			<input type="submit" id="insert" value="Insert" class="btn btn-success m-2">
		</form>
	</div>

    <button id="show-data" class="btn btn-success m-2">Show Data</button>

<div id="data-show" >
	
</div>

<div id="insert_mess" >

</div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>



$(document).ready(function(){

// $("#show-data").click(function(){

// 	alert("Data is show ");

// });
function loadData()
{		

	$.ajax({
		url:"fetch_data.php",
		type:"POST",
		success: function(data)
		{
			$("#data-show").html(data);


		}
	});


}
 loadData();

$("#insert").click(function(e)
{	
	e.preventDefault();
	var email = $("#email").val();
	var password = $("#password").val();

	$.ajax({
		url:"ajax_insert.php",
		type:"POST",
		data:{email_data:email,password_data:password},

		success : function(data)
		{
			if(data== "1")
			{
				loadData();
				$("#insert_mess").html("Insert sucessfullys");
			}
			else
			{
				
			}
		}
	});
});



});

</script>