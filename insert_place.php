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
<div class="m-3 mt-4 ms-5 row  w-100 ">
    <div class="border border-dark w-25 p-4 ms-2 mt-4">
            <h1>Insert Country</h1>
            <div class="row">
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="Post">
                <div class="col-auto">
                    <label class="form-label">Enter Country</label>
                    <input type="text" name="country_name" class="form-control" >
                </div>

                 <div class="col-auto">
                    <input type="submit" value="Insert" name="insert_country" class="btn btn-success mt-3">
                </div>
                </form>
            </div>

    </div>

    <div class="border border-dark w-25 p-4 ms-2 mt-4">
            <h1>Insert State</h1>
            <div class="row">
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="Post">
                <div class="col-auto">
                    <label class="form-label">Enter State</label>
                    <input type="text" name="state_name" class="form-control" >
                </div>
              
                 <div class="col-auto">
                    <label class="form-label">Select Country</label>
                      
        
            <select class="form-control form-select" name="country_id">
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

                 <div class="col-auto">
                    <input type="submit" name="insert_state" value="Insert" class="btn btn-success mt-3">
                </div>
                </form>
            </div>

    </div>

        <div class="border border-dark w-25 p-4 ms-2 mt-4">
            <h1>Insert City</h1>
            <div class="row">
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="Post">
                <div class="col-auto">
                    <label class="form-label">Enter City</label>
                    <input type="text" name="city_name" class="form-control" >
                </div>

                 <div class="col-auto">
                    <label class="form-label">Select State</label>
                      
        
            <select class="form-control form-select" id="state" name="state_id">
                <option>State</option>
                
            </select>
        
                </div>
                <div class="col-auto">
                    <label class="form-label">Select Country</label>
                      
        
            <select class="form-control form-select" id="country_id" name="country_id">
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

                 <div class="col-auto">
                    <input type="submit" value="Insert" name="insert_city" class="btn btn-success mt-3">
                </div>
                </form>
            </div>

    </div>

</div>
</body>
</html>


<?php

if(isset($_POST['insert_country']))
    {
        
        $country_name = $_POST['country_name'];

        $sql = $conn->prepare("insert into country (country_name) VALUES(?)");
        $sql->bindParam(1,$country_name,PDO::PARAM_STR);

        $sql->execute();

        if($sql->rowCount()>0)
            {
               echo"done";
            }
        else
            {
                echo "not";
            }
    }


    if(isset($_POST['insert_state']))
    {
        
        $state_name = $_POST['state_name'];
        $country_id= $_POST['country_id'];
        $sql = $conn->prepare("insert into state (country_id,state_name) VALUES(?,?)");
        $sql->bindParam(1,$country_id,PDO::PARAM_INT);
        $sql->bindParam(2,$state_name,PDO::PARAM_STR);

        $sql->execute();

        if($sql->rowCount()>0)
            {
               echo"done";
            }
        else
            {
                echo "not";
            }
    }

     if(isset($_POST['insert_city']))
    {
        
        $city_name = $_POST['city_name'];
        $country_id= $_POST['country_id'];
        $state_id= $_POST['state_id'];
        $sql = $conn->prepare("insert into city (country_id,state_id,city_name) VALUES(?,?,?)");
        $sql->bindParam(1,$country_id,PDO::PARAM_INT);
        $sql->bindParam(2,$state_id,PDO::PARAM_INT);
        $sql->bindParam(3,$city_name,PDO::PARAM_STR);

        $sql->execute();

        if($sql->rowCount()>0)
            {
               echo"done";
            }
        else
            {
                echo "not";
            }
    }


?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(Document).ready(function(){

    $('#country_id').change(function(){
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


    


});


</script>