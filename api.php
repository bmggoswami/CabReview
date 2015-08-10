<?php
include_once 'Database.php';
$db = Database::getInstance();
$mysqli = $db->getConnection();
if( $_GET['number'] ){
	$sql = 'select * from user_rating where number = '.$_GET['number'];
	$result = $mysqli->query($sql);
	$rows = array();
	$count = 0;
	while($row = $result->fetch_array(MYSQLI_ASSOC) ){
		$count++;
		$sum += $row['rating'];
		array_push($rows,array('rating' => $row['rating'],'comment' => $row['comment']));
	}
	$avg = round($sum/$count,2);
	echo json_encode(array('average'=>$avg,'result' => $rows));
}

$str = "<form name='abc' method='post'>";
$str .= "<input type='text' name='number'>";
$str .= "<input type='text' name='rating'>";
$str .= "<input type='text' name='comment'>";
$str .= "<input type='text' name='userinfo'>";
$str .= "<input type='submit' value='Submit'>";
$str .="</form>";
//echo $str;
if( $_POST['number'] ){
		$number = $_POST['number'];
		$rating = $_POST['rating'];
		$comment = $_POST['comment'];
		$userinfog = $_POST['userinfo'];
		
		$sql = "INSERT INTO user_rating(number,rating,`comment`,`user_info`)
				VALUES($number,$rating,'$comment','$userinfog')";
		$result = $mysqli->query($sql);
		echo json_encode(array("success"=>$result));;
}
?>
