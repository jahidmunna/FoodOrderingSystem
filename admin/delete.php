<?php
	session_start();
	if($_SESSION['user']){
		$name = $_SESSION['user'];
	}
	else 
		header("location: index.php");
?>

<?php
	$itemID = $_GET['id'];
    include_once 'database_Class.php';
    $d = new DB();
    $res = $d->delete($itemID);
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