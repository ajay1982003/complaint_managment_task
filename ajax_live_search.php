<?php

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
          <form action="">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">

                <input type="text" 
                       name="search" 
                       id="search" 
                       class="form-control border-dark  px-4"
                       placeholder="Search here...">

            </div>
        </div>
    </form>
        <div id="search_data"></div>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function(){

    $("#search").keyup(function(){

        var txt = $(this).val();

        $.ajax({
            url:'live_search.php',
            type:'post',
            data:{serach_data:txt},
            success: function(data){

                $('#search_data').html(data);

            }
        })


    })

})

</script>