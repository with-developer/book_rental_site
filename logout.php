<?php
// 세션 시작
session_start();

// 세션 변수 제거
unset($_SESSION['user_id']);

// 세션 파괴
session_destroy();

// 로그인 페이지로 이동
echo "<script>alert('로그아웃에 성공했습니다.'); location.href='/login.php';</script>";
?>

