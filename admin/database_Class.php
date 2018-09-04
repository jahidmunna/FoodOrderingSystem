<?php
	define('server','localhost');
    define('user','root');
    define('pass','');
    define('db','restaurant');
	
	class DB{
		public $con;
		public function __construct()
		{
			$this->con = mysqli_connect(server,user,pass,db);
            if($this->con===false)
            {
                die("connect failed ").mysqli_connect_error($con);
            }
            else
            {
               // echo"connected";
            }
		}

		public function insert($itemName,$itemPrice,$itemCategory,$itemPath,$itemDetails){
			$res = mysqli_query($this->con," INSERT INTO item (name, price, category, path, details) VALUES ('$itemName','$itemPrice','$itemCategory','$itemPath','$itemDetails')");
			return $res;
		}

		public function update($itemID, $itemName,$itemPrice,$itemCategory,$itemPath,$itemDetails){
			$res = mysqli_query($this->con," UPDATE  item  SET name = '$itemName', price = '$itemPrice', category = '$itemCategory', path = '$itemPath', details = '$itemDetails' WHERE id = '$itemID' ");
			return $res;
		}

		public function updateWithoutImage($itemID, $itemName,$itemPrice,$itemCategory,$itemDetails){
			$res = mysqli_query($this->con," UPDATE  item  SET name = '$itemName', price = '$itemPrice', category = '$itemCategory', details = '$itemDetails' WHERE id = '$itemID' ");
			return $res;
		}

		public function delete($itemID){
			$res = mysqli_query($this->con," DELETE FROM item WHERE id = '$itemID'");
			return $res;
		}

	}
?>