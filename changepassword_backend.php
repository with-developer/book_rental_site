<?php
include './dbconn.php';
session_start();

// 현재 로그인 중인 사용자의 id
$user_id = $_SESSION['user_id'];

// 폼에서 전달받은 값들
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// 현재 비밀번호가 맞는지 확인
$sql = "SELECT user_pw FROM users WHERE user_id='$user_id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
if ($current_password != $row['user_pw']) {
    // 현재 비밀번호가 일치하지 않는 경우
    echo '<script>alert("현재 비밀번호가 일치하지 않습니다."); history.back();</script>';
    exit();
}

// 새로운 비밀번호와 비밀번호 확인이 일치하는지 확인
if ($new_password != $confirm_password) {
    // 일치하지 않는 경우
    echo '<script>alert("새로운 비밀번호와 비밀번호 확인이 일치하지 않습니다."); history.back();</script>';
    exit();
}

// 새로운 비밀번호를 데이터베이스에 저장
$sql = "UPDATE users SET user_pw='$new_password' WHERE user_id='$user_id'";
if (!mysqli_query($con, $sql)) {
    // 데이터베이스 업데이트에 실패한 경우
    echo '<script>alert("비밀번호 변경에 실패했습니다."); history.back();</script>';
    exit();
}

// 데이터베이스 연결 종료
mysqli_close($con);

// 비밀번호 변경에 성공한 경우, 마이페이지로 이동
echo '<script>alert("비밀번호가 변경되었습니다."); location.href="/mypage.php";</script>';
?>
