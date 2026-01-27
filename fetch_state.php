<?php

include('conn.php');

if(isset($_POST['country_id']))
    {
        $country_id = $_POST['country_id'];

        $sql = $conn->prepare("Select * from state where country_id=?");
        $sql->bindParam(1,$country_id,PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
    <option >State</option>

<?php
        foreach($result as $a)
            {
    ?>

    <option value="<?php echo $a['state_id']?>"><?php echo $a['state_name']; ?></option>

                <?php
            }
            echo $output;
    }
?>