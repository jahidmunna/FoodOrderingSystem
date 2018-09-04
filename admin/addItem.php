<?php
	session_start();
	if($_SESSION['user']){
		$name = $_SESSION['user'];
	}
	else 
		header("location: index.php");
?>

<?php
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $exploded = explode('.',$_FILES['image']['name']);
      $file_ext=strtolower(end($exploded));
     // $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){

         move_uploaded_file($file_tmp,"../restaurant/images/".$file_name);

         session_start();
         $_SESSION['path'] = $file_name;
         $_SESSION['name'] = $_POST['name'];
         $_SESSION['price'] = $_POST['price'];
         $_SESSION['category'] = $_POST['category'];
         $_SESSION['details'] = $_POST['details'];
         header("Location:uploadData.php");
        // echo "Success";
      }else{
         print_r($errors);
      }
   }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add new item</title>
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" type="text/css" href="css/style-btnOptions.css">
	<link href="css/font.css" rel='stylesheet' type='text/css'>
	
</head>
<body>

	<div class="w3-container w3-green" >
		<div class="w3-display-container w3-green" style="height:80px;">
	  		<div class="w3-display-middle"><h1>Add new item</h1></div>
	  		<div class="w3-display-right"><a id="logout" href="Logout.php" style="text-decoration: none;">Logout</a></div>
	  		<div class="w3-display-left"><a id="logout" href="welcome.php" style="text-decoration: none;">home</a></div>
	  	</div>
	</div>

	<form class="w3-container w3-card-4" id= "container" method="POST" enctype="multipart/form-data" style="width: 450px; padding: 20px 30px;">
	  <h2 class="w3-text-blue">NEW ITEM</h2>

	  <p>      
		<label class="w3-text-blue"><b>Name</b></label>
		<input class="w3-input w3-border" name="name" type="text" maxlength="50" required="">
	  </p>

	  <p>      
	  	<label class="w3-text-blue"><b>Price (bdt)</b></label>
	  	<input class="w3-input w3-border" name="price" type="number" required="">
	  </p>

	  <p>
	  	<label class="w3-text-blue "><b>Category</b></label>
	    <select class="w3-select w3-border" name="category" required="">
		    <option value="" disabled selected><b>Select Category</b></option>
		    <option value="1">Pizza</option>
		    <option value="2">Pasta</option>
		    <option value="3">Burger</option>
		    <option value="4">Beverage</option>
		</select>    
	  </p>

	  <p>      
	  	<label class="w3-text-blue"><b>Select a photo</b></label>
	  	<input class="w3-input w3-border" type="file" accept="image/*" name="image" required="">
	  </p>

	  <p>  
	  	<label class="w3-text-blue"><b>details</b></label>
	  	<textarea class="w3-input w3-border" name="details" type="textarea" required="" maxlength="150" placeholder="write some details about the item..."></textarea>    
	  </p>


	  <p>      
	  	<button class="w3-btn w3-blue">Add item</button>
	  </p>

  	</form>

</body>
</html>