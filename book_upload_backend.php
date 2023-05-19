<?php
session_start();

// 사용자가 로그인되어 있는지 확인합니다.
if (!isset($_SESSION['user_id'])) {
    // 로그인 페이지로 리디렉션하거나 오류 메시지를 표시합니다.
    echo '<script>alert("로그인 후 시도해주세요.");</script>';
    echo '<script>window.location.href = "login.php";</script>';
    exit();
}
// dbconn.php 파일을 include
include './dbconn.php';

// POST 방식으로 전송된 데이터를 변수에 저장
$book_name = $_POST['book_name'];
$book_author = $_POST['book_author'];
$book_publisher = $_POST['book_publisher'];
$book_description = $_POST['book_description'];
$book_division = $_POST['book_division'];
$book_language = $_POST['book_language'];

// 책 등록일을 현재 날짜로 설정
$book_update_date = date('Y-m-d');

// 데이터베이스에 데이터 삽입
$sql = "INSERT INTO books (book_name, book_author, book_publisher, book_description, book_division, book_language, book_update_date) VALUES ('$book_name', '$book_author', '$book_publisher', '$book_description', '$book_division', '$book_language', '$book_update_date')";
$result = mysqli_query($con, $sql);

if ($result) {
    // 책 등록 성공
	echo '<script>alert("책 등록에 성공했습니다."); location.replace("/");</script>';
} else {
	// 책 등록 실패
	echo '<script>alert("책 등록에 실패했습니다."); location.replace("/");</script>';
}

// 데이터베이스 연결 종료
mysqli_close($con);
?>

