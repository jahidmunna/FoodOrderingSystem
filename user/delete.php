<?php
	session_start();
	if($_SESSION['username']){
		$name = $_SESSION['username'];
	}
	else 
		header("location: home.php");
?>

<?php
	$itemID = $_GET['id'];
    include('config.php');
    $dates = date('Y-m-d');
    $sql = "DELETE FROM orderList  WHERE id='$itemID' ";
    $result = $conn->query($sql);
    if($result === true)
    {
        //echo  "<h1> successfully Added!</h1>";
        $conn->close();
        header("location:cart.php");

    }


?>