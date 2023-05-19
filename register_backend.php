<?php
	include './dbconn.php';

	// POST로 전송된 회원가입 정보 받아오기
	$user_id = $_POST['user_id'];
	$user_pw = $_POST['user_pw'];
	$user_pw2 = $_POST['user_pw2'];
	$user_name = $_POST['user_name'];
	$user_phonenumber = $_POST['user_phonenumber'];

	// 모든 필드가 입력되었는지 확인
    	if (empty($user_id) || empty($user_pw) || empty($user_pw2) || empty($user_name) || empty($user_phonenumber)) {
        	echo '<script>alert("모든 정보를 입력해주세요."); history.back();</script>';
        	exit;
    	}
	// 비밀번호 확인
    	if($user_pw !== $user_pw2) {
        	echo '<script>alert("비밀번호가 일치하지 않습니다."); history.back();</script>';
        	exit;
    	}
	// 중복 체크
	$sql = "SELECT * FROM users WHERE user_id='$user_id'";
	$result = mysqli_query($con, $sql);
	if(mysqli_num_rows($result) > 0){
		echo '<script>alert("이미 등록된 아이디입니다."); history.back();</script>';
		exit;
	}

	// 데이터베이스에 회원 정보 저장
	$sql = "INSERT INTO users (user_id, user_pw, user_name, user_phonenumber) VALUES ('$user_id', '$user_pw', '$user_name', '$user_phonenumber')";
	if(mysqli_query($con, $sql)){
		echo '<script>alert("회원가입 성공!"); location.replace("/login.php");</script>';
	} else {
		echo '<script>alert("회원가입 실패!"); history.back();</script>';
	}

	// 데이터베이스 연결 종료
	mysqli_close($con);
?>
