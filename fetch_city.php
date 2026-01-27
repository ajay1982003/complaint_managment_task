


<?php

include('conn.php');

if(isset($_POST['state_id']))
    {
        $state_id = $_POST['state_id'];

        $sql = $conn->prepare("select * from city where state_id = ?");
        $sql->bindParam(1,$state_id,PDO::PARAM_STR);
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $a)
            {
?>

    <option value="<?php echo $a['city_id']?>"><?php echo $a['city_name']; ?></option>
<?php
            }
            
    }

?>