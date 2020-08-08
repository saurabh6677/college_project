<?php
$db = new database();
$db = $db->db();
$auth_id = base64_decode($_COOKIE['_aid_']);
$auth_id = htmlspecialchars($auth_id,ENT_QUOTES);
$auth_id = mysqli_real_escape_string($db,$auth_id);
$auth_pass = base64_decode($_COOKIE['_ap_']);
$auth_pass= htmlspecialchars($auth_pass,ENT_QUOTES);
$auth_pass = mysqli_real_escape_string($db,$auth_pass);
$query = $db->prepare("SELECT * FROM users_auth WHERE auth_id=? AND auth_password=?");
$query->bind_param('ss',$auth_id,$auth_pass);
$query->execute();
$response = $query->get_result();
if($response->num_rows !=0)
{
	$data = $response->fetch_assoc();
	$user_id = $data['user_id'];
	$otp = $data['otp'];
	$query = $db->prepare("SELECT * FROM users_info WHERE user_id=?");
	$query->bind_param('i',$user_id);
	$query->execute();
	$response = $query->get_result();
	if($response->num_rows !=0)
	{
		$data = $response->fetch_assoc();
		$fullname = $data['fullname'];
		$email = $data['email'];
		$gender = $data['gender'];
		$city = $data['city'];
		$college = $data['college'];
		$board = $data['board'];
		$course = $data['course'];
		$mobile = $data['mobile'];
		$pic = $data['photo'];
		$address = $data['address'];
		$dob = $data['dob'];
		$reg_date = $data['reg_date'];
	}
}


?>