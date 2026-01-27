<?php
include('conn.php');
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
    <div class="container row w-50 mt-3 p-3 ">
            <div class="btn btn-success col-auto m-lg-2">Insert Country</div>
            <div class="btn btn-success col-auto m-lg-2">Insert State</div>
            <div class="btn btn-success col-auto m-lg-2">Insert City</div>
    </div>
    <form action="">
    <div class=" container row border border-success mt-4 w-50 p-4 ms-3">
    <div class=" col-4 ">
        
            <select class="form-control form-select" id="country">
                <option>Country</option>
                <?php 
                    $sql1= $conn->prepare("select * from country");
                    $sql1->execute();

                    $result = $sql1->fetchAll(PDO::FETCH_ASSOC);
                    foreach($result as $a)
                        {
                
                ?>
                <option value="<?php echo $a['country_id']; ?>"  ><?php echo $a['country_name']; ?></option>
                <?php } ?>
            </select>
            
        
    </div>

    <div class=" col-4 ">
        
            <select class="form-control form-select" id="state">
                <option>State</option>
            
            </select>
        
    </div>

    <div class=" col-4 ">
     
            <select class="form-control form-select" id="city">
                <option>City</option>
              
            </select>

            <input type="submit" name="select" value="Select" class=" btn btn-light" >
    </div>
    
</div>
</form>
</body>
</html>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function(){

    $('#country').change(function(){

    var countryid = $(this).val();

    $.ajax({
        url:'fetch_state.php',
        type:'POST',
        data:{country_id:countryid},
        success: function(data)
        {
            $('#state').html(data);
        }
    });

    });

    $('#state').change(function(){
    var stateid = $(this).val();

    $.ajax({
        url:'fetch_city.php',
        type:'POST',
        data:{state_id:stateid},
        success : function(data)
        {
            $('#city').html(data);
        }   
    })
    });

});

</script>