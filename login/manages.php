<?php require_once '../db/config.php';


if (mysqli_real_escape_string($conn,$_POST['login'] == 'login')) {
	session_start(); 

	if(isset($_POST['username']) && isset($_POST['pass'])){

		$username = mysqli_real_escape_string($conn,$_POST['username']);
		$password = mysqli_real_escape_string($conn,sha1($_POST['pass']));

		$sql = "SELECT username FROM member WHERE   username = '$username' and password = '$password'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$active = $row['username'];

		$count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

		if($count == 1) {
    
			$_SESSION['login_user'] = $active;
			$number = "1";
			$url = 'home/index.php';
		}else {
			
			$number = "0";
			$url = "-";
		}
		$xx = array(
			'number'  => $number,
			'url'     => $url
		);
		echo json_encode($xx);
	}
	
}

 ?>