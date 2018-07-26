<?php
	
	session_start();

	function PDOconnect(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "cros_db";
		
		return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	}
	
	
	//==============================================================
	//PDO prepared statements for different databases
	//==============================================================
	
	//==============================================================
	//USERS functions
	//==============================================================
	
	function checkUser($email){
		
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT email from users where email= :email;");
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			
			$stmt->execute();
			$row = $stmt->fetch();
			if($row!=NULL)
				return true;
			return false;
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
	
	function getPassword($username){
		
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT password from users where email= :username;");
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			
			$stmt->execute();
			$row = $stmt->fetch();
			return $row[0];
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
	
	function getUserID($username){
	
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT userid from users where email= :username;");
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			
			$stmt->execute();
			$row = $stmt->fetch();
			return $row[0];
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
	
	function getAllUsers(){
	
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT * from users;");
			
			$stmt->execute();
			$row = $stmt->fetchAll();
			return $row;
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
	
	function getUserInfo($userid){
	
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT * from users where userid = :userid;");
			$stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
			
			$stmt->execute();
			$row = $stmt->fetch();
			return $row;
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
	
	function addUser($email,$password,$fname,$lname,$bdate){
		
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("INSERT INTO users
				(email,password,fname,lname,birthdate,usertype)
				VALUES
				(:email,:password,:fname,:lname,:bdate,:usertype);");
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':password', $password, PDO::PARAM_STR);
			$stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
			$stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
			$stmt->bindParam(':bdate', $bdate, PDO::PARAM_STR);
			$stmt->bindParam(':usertype', $usertype, PDO::PARAM_STR);
			
			$usertype = "client";
			
			return $stmt->execute();
			
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	function updateUser($email,$password,$fname,$lname,$bdate){
	
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("UPDATE users SET
					password = :password,
					fname = :fname,
					lname = :lname,
					birthdate = :bdate
					where email = :email;");
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':password', $password, PDO::PARAM_STR);
			$stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
			$stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
			$stmt->bindParam(':bdate', $bdate, PDO::PARAM_STR);
			
			return $stmt->execute();
			
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	//==============================================================
	//PRODUCTS functions
	//==============================================================
	function getDateTime(){
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT now();");
			
			$stmt->execute();
			$row = $stmt->fetch();
			return $row[0];
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	function addProduct($prodcode,$category,$imgname,$imgurl,$name,$ctype,$quantity,$size,$minchest,$maxchest,$minwaist,$maxwaist,$length,$price,$desc){
		
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("INSERT INTO products
				(productcode,image_name,image_url,name,clothtype,quantity,description,size_fit,min_chest,max_chest,min_waist,max_waist,overall_length,amount,category)
				VALUES
				(:prodcode,:imgname,:imgurl,:name,:ctype,:quantity,:desc,:size,:minchest,:maxchest,:minwaist,:maxwaist,:length,:price,:category);");
			
			$stmt->bindParam(':prodcode',$prodcode, PDO::PARAM_STR);
			$stmt->bindParam(':imgname',$imgname, PDO::PARAM_STR);
			$stmt->bindParam(':imgurl',$imgurl, PDO::PARAM_STR);
			$stmt->bindParam(':name',$name, PDO::PARAM_STR);
			$stmt->bindParam(':ctype',$ctype, PDO::PARAM_STR);
			$stmt->bindParam(':quantity',$quantity, PDO::PARAM_INT);
			$stmt->bindParam(':desc',$desc, PDO::PARAM_STR);
			$stmt->bindParam(':size',$size, PDO::PARAM_STR);
			$stmt->bindParam(':minchest',$minchest, PDO::PARAM_INT);
			$stmt->bindParam(':maxchest',$maxchest, PDO::PARAM_INT);
			$stmt->bindParam(':minwaist',$minwaist, PDO::PARAM_INT);
			$stmt->bindParam(':maxwaist',$maxwaist, PDO::PARAM_INT);
			$stmt->bindParam(':length',$length, PDO::PARAM_INT);
			$stmt->bindParam(':price',$price, PDO::PARAM_INT);
			$stmt->bindParam(':category',$category, PDO::PARAM_STR);
			
			return $stmt->execute();
			
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	function updateProduct($productid,$prodcode,$category,$name,$ctype,$quantity,$size,$minchest,$maxchest,$minwaist,$maxwaist,$length,$price,$desc){
		
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("UPDATE products SET
				productcode = :prodcode,
				name = :name,
				clothtype = :ctype,
				quantity = :quantity,
				description = :desc,
				size_fit = :size,
				min_chest = :minchest,
				max_chest = :maxchest,
				min_waist = :minwaist,
				max_waist = :maxwaist,
				overall_length = :length,
				amount = :price,
				category = :category
				where productid = :productid;");
			
			$stmt->bindParam(':productid',$productid, PDO::PARAM_INT);
			$stmt->bindParam(':prodcode',$prodcode, PDO::PARAM_STR);
			$stmt->bindParam(':name',$name, PDO::PARAM_STR);
			$stmt->bindParam(':ctype',$ctype, PDO::PARAM_STR);
			$stmt->bindParam(':quantity',$quantity, PDO::PARAM_INT);
			$stmt->bindParam(':desc',$desc, PDO::PARAM_STR);
			$stmt->bindParam(':size',$size, PDO::PARAM_STR);
			$stmt->bindParam(':minchest',$minchest, PDO::PARAM_INT);
			$stmt->bindParam(':maxchest',$maxchest, PDO::PARAM_INT);
			$stmt->bindParam(':minwaist',$minwaist, PDO::PARAM_INT);
			$stmt->bindParam(':maxwaist',$maxwaist, PDO::PARAM_INT);
			$stmt->bindParam(':length',$length, PDO::PARAM_INT);
			$stmt->bindParam(':price',$price, PDO::PARAM_INT);
			$stmt->bindParam(':category',$category, PDO::PARAM_STR);
			
			return $stmt->execute();
			
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	function updateProductWithImage($productid,$prodcode,$category,$imgname,$imgurl,$name,$ctype,$quantity,$size,$minchest,$maxchest,$minwaist,$maxwaist,$length,$price,$desc){
		
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("UPDATE products SET
				image_name = :imgname,
				image_url = :imgurl,
				productcode = :prodcode,
				name = :name,
				clothtype = :ctype,
				quantity = :quantity,
				description = :desc,
				size_fit = :size,
				min_chest = :minchest,
				max_chest = :maxchest,
				min_waist = :minwaist,
				max_waist = :maxwaist,
				overall_length = :length,
				amount = :price,
				category = :category
				where productid = :productid;");
			
			$stmt->bindParam(':productid',$productid, PDO::PARAM_INT);
			$stmt->bindParam(':prodcode',$prodcode, PDO::PARAM_STR);
			$stmt->bindParam(':imgname',$imgname, PDO::PARAM_STR);
			$stmt->bindParam(':imgurl',$imgurl, PDO::PARAM_STR);
			$stmt->bindParam(':name',$name, PDO::PARAM_STR);
			$stmt->bindParam(':ctype',$ctype, PDO::PARAM_STR);
			$stmt->bindParam(':quantity',$quantity, PDO::PARAM_INT);
			$stmt->bindParam(':desc',$desc, PDO::PARAM_STR);
			$stmt->bindParam(':size',$size, PDO::PARAM_STR);
			$stmt->bindParam(':minchest',$minchest, PDO::PARAM_INT);
			$stmt->bindParam(':maxchest',$maxchest, PDO::PARAM_INT);
			$stmt->bindParam(':minwaist',$minwaist, PDO::PARAM_INT);
			$stmt->bindParam(':maxwaist',$maxwaist, PDO::PARAM_INT);
			$stmt->bindParam(':length',$length, PDO::PARAM_INT);
			$stmt->bindParam(':price',$price, PDO::PARAM_INT);
			$stmt->bindParam(':category',$category, PDO::PARAM_STR);
			
			return $stmt->execute();
			
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	function getAllProducts(){
	
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT * from products;");
			
			$stmt->execute();
			$row = $stmt->fetchAll();
			return $row;
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
	
	function getProductId($prodcode){
	
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT productid from products where productcode = :prodcode;");
			$stmt->bindParam(':prodcode', $prodcode, PDO::PARAM_STR);
			
			$stmt->execute();
			$row = $stmt->fetch();
			return $row[0];
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
	
	function getProductInfo($prodid){
	
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT * from products where productid = :prodid;");
			$stmt->bindParam(':prodid', $prodid, PDO::PARAM_INT);
			
			$stmt->execute();
			$row = $stmt->fetch();
			return $row;
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
	function getProductByCategory($category){
	
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT * from products where category = :category;");
			$stmt->bindParam(':category', $category, PDO::PARAM_STR);
			
			$stmt->execute();
			$row = $stmt->fetchAll();
			return $row;
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
	function getQuantity($prodid){
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT quantity from products where productid = :prodid;");
			$stmt->bindParam(':prodid', $prodid, PDO::PARAM_INT);
			
			$stmt->execute();
			$row = $stmt->fetch();
			return $row[0];
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		return false;
	}
	
	function getImageUrl($prodid){
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT image_url from products where productid = :prodid;");
			$stmt->bindParam(':prodid', $prodid, PDO::PARAM_INT);
			
			$stmt->execute();
			$row = $stmt->fetch();
			return $row[0];
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		return false;
	}
	
	function isProductAvailable($prodid){
	
		if(getQuantity($prodid)!=0)
			return true;
		else return false;
	}
	
	//==============================================================
	//ORDERS functions
	//==============================================================
	function addOrder($refnum,$userid,$dateofdeliver,$address,$contactno,$mop,$total){
		
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("INSERT INTO orders
				(refnum,userid,date_created,delivery_date,address,contactno,mode_of_pay,total_amount,status)
				VALUES
				(:refnum,:userid,now(),:dod,:address,:contactno,:mop,:total,:status);");
			
			$stmt->bindParam(':refnum', $refnum, PDO::PARAM_STR);
			$stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
			$stmt->bindParam(':dod', $dateofdeliver, PDO::PARAM_STR);
			$stmt->bindParam(':address', $address, PDO::PARAM_STR);
			$stmt->bindParam(':contactno', $contactno, PDO::PARAM_STR);
			$stmt->bindParam(':mop', $mop, PDO::PARAM_STR);
			$stmt->bindParam(':total', $total, PDO::PARAM_INT);
			$stmt->bindParam(':status', $status, PDO::PARAM_STR);
			
			$status = "Pending";
			
			return $stmt->execute();
			
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	function confirmOrder($orderno){
		
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("UPDATE orders SET
				status = :status
				where ordernum = :orderno;");
			
			$stmt->bindParam(':orderno',$orderno, PDO::PARAM_INT);
			$stmt->bindParam(':status',$status, PDO::PARAM_STR);
			
			$status = "Confirmed";
			
			return $stmt->execute();
			
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	function addOrderedProducts($ordernum,$productid){
		
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("INSERT INTO orderedproducts
				(ordernum,productid)
				VALUES
				(:ordernum,:productid);");
			
			$stmt->bindParam(':ordernum', $ordernum, PDO::PARAM_INT);
			$stmt->bindParam(':productid', $productid, PDO::PARAM_INT);
			
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	function getOrderInfo($orderno){
	
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT * from orders where ordernum = :orderno;");
			$stmt->bindParam(':orderno', $orderno, PDO::PARAM_INT);
			
			$stmt->execute();
			$row = $stmt->fetch();
			return $row;
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	function getOrderNoByRefno($refnum){
	
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT ordernum from orders where refnum = :refnum;");
			$stmt->bindParam(':refnum', $refnum, PDO::PARAM_STR);
			
			$stmt->execute();
			$row = $stmt->fetch();
			return $row[0];
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	function getOrdersByStatus($status){
	
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT * from orders where status = :status ORDER BY delivery_date ASC;");
			$stmt->bindParam(':status', $status, PDO::PARAM_STR);
			
			$stmt->execute();
			$row = $stmt->fetchAll();
			return $row;
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
	
	function getOrdersByClient($client){
	
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT * from orders where userid = :client ORDER BY delivery_date ASC;");
			$stmt->bindParam(':client', $client, PDO::PARAM_INT);
			
			$stmt->execute();
			$row = $stmt->fetchAll();
			return $row;
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
	
	function getOrdersByProduct($productid){
	
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT * from orders 
				where ordernum in (SELECT ordernum from orderedproducts 
				where productid = :productid) ORDER BY delivery_date ASC;");
			$stmt->bindParam(':productid', $productid, PDO::PARAM_INT);
			
			$stmt->execute();
			$row = $stmt->fetchAll();
			return $row;
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
	
	function getProductsOrdered($orderno){
	
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("SELECT * from products
				where productid in (SELECT productid from orderedproducts where ordernum = :orderno);");
			$stmt->bindParam(':orderno', $orderno, PDO::PARAM_INT);
			
			$stmt->execute();
			$row = $stmt->fetchAll();
			return $row;
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
	
	function reduceProductQuantity($productid){
		try {
			$conn = PDOconnect();
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// prepare sql and bind parameters
			$stmt = $conn->prepare("UPDATE products SET
				quantity = :quantity
				where productid = :productid;");
			
			$stmt->bindParam(':quantity',$quantity, PDO::PARAM_INT);
			$stmt->bindParam(':productid',$productid, PDO::PARAM_INT);
			
			$quantity = 0;
			if(isProductAvailable($productid)){
				$quantity = getQuantity($productid)-1;
			}else return false;
			
			return $stmt->execute();
			
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	//==============================================================
	//CARTING
	//==============================================================
	function addToCart($id){
		
		for($i = 0 ; $i < $_SESSION['cartIndex'] ; $i++){
			if($_SESSION['cart'][$i]==$id){
				return false;
			}
		}
		$_SESSION['cart'][$_SESSION['cartIndex']++] = $id;
		return true;
	}
	
	function removeFromCart($id){
		for($i = 0 ; $i < $_SESSION['cartIndex'] ; $i++){
			if($_SESSION['cart'][$i]==$id){
				$_SESSION['cart'][$i] = 0;
				return true;
			}
		}
		return false;
	}
	
	function isInCart($id){
		for($i = 0 ; $i < $_SESSION['cartIndex'] ; $i++){
			if($_SESSION['cart'][$i]==$id){
				return true;
			}
		}
		return false;
	}
	
	function countCart(){
		$count = 0;
		for($i = 0 ; $i < $_SESSION['cartIndex'] ; $i++){
			if($_SESSION['cart'][$i]!=0)
				$count++;
		}
		return $count;
	}
	
	function getCart(){
		$cart = array();
		$j = 0;
		for($i = 0 ; $i < $_SESSION['cartIndex'] ; $i++){
			if($_SESSION['cart'][$i]!=0){
				$cart[$j++] = $_SESSION['cart'][$i];
			}
		}
		return $cart;
	}
	
	function cartAmount(){
		$sum = 0;
		for($i = 0 ; $i < $_SESSION['cartIndex'] ; $i++){
			if($_SESSION['cart'][$i]!=0){
				$amount = getProductInfo($_SESSION['cart'][$i])["amount"];
				$sum += $amount;
			}
		}
		return $sum;
	}
	
	function resetCart(){
		for($i = 0 ; $i < $_SESSION['cartIndex'] ; $i++){
			$_SESSION['cart'][$i] = 0;
		}
		$_SESSION['cartIndex'] = 0;
	}
	
	//==============================================================
	//Useful functions
	//==============================================================
	function getResizedImageSize($image){
		$imageSize = array();
		list($width, $height, $type, $attr) = getimagesize($image);
		//echo $width." width resized: ". $width/35 ."<br/>";
		//echo $height." height resized: ". $height/35 ."<br/>";
		//while($height>150){
			//$height = $height/7;
			//$width /= 7;
		//}
		
		//$imageSize["width"] = $width/35;
		//$imageSize["height"] = $height/35;
		
		return $imageSize;	
	}
	//==============================================================
	
?>
