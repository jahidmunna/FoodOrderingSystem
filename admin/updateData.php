<?php    
    session_start();
    if($_SESSION['name']){
        $itemID = $_SESSION['id'];
        $itemName = $_SESSION['name'];
        $itemPrice = $_SESSION['price'];
        $itemCategory =  $_SESSION['category'];
        $itemPath = $_SESSION['path'];
        $itemDetails = $_SESSION['details'];
    }
    else {
        header("Location:addItem.php");
    }

?>

<?php
    include_once 'database_Class.php';
    $d = new DB();
    $res = $d->update($itemID,$itemName,$itemPrice,$itemCategory,$itemPath,$itemDetails);
    if($res === true)
    {
        //echo  "<h1> successfully Added!</h1>";
        header("location:editItem.php");

    }
    else
    {
        echo mysqli_error($d->con);
    }
?>

