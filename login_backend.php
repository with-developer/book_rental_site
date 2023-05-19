<?php
// dbconn.php 파일을 include하여 데이터베이스 연결
include './dbconn.php';

// POST로 전송된 로그인 정보 받아오기
$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];

// 데이터베이스에서 로그인 정보 검색
$sql = "SELECT * FROM users WHERE user_id='$user_id' AND user_pw='$user_pw'";
$result = mysqli_query($con, $sql);

// 검색 결과가 있는 경우 로그인 성공
if(mysqli_num_rows($result) > 0){
	// 로그인 성공 시 세션 생성
	session_start();
	$_SESSION['user_id'] = $user_id;
	$_SESSION['user_name'] = $user_name;
	echo '<script>alert("로그인에 성공했습니다."); location.replace("/");</script>';
} else {
        echo "로그인 실패: 아이디 또는 비밀번호가 잘못되었습니다.";
}

// 데이터베이스 연결 종료
mysqli_close($con);
?>

