<?php
session_start();

// 사용자가 로그인되어 있는지 확인합니다.
if (!isset($_SESSION['user_id'])) {
    // 로그인 페이지로 리디렉션하거나 오류 메시지를 표시합니다.
    echo '<script>alert("로그인 후 시도해주세요.");</script>';
    echo '<script>window.location.href = "login.php";</script>';
    exit();
}

// POST 요청으로 전달받은 리뷰 내용과 책 ID를 가져옵니다.
$review_content = $_POST['review_content'];
$book_id = $_POST['book_id'];

// 데이터베이스 연결 설정
include './dbconn.php';

// 리뷰 정보를 데이터베이스에 저장합니다.
$user_id = $_SESSION['user_id'];
$sql = "INSERT INTO reviews (book_id, user_id, review_content) VALUES ('$book_id', '$user_id', '$review_content')";
$result = mysqli_query($con, $sql);

// 데이터베이스 연결 종료
mysqli_close($con);

if ($result) {
    // 리뷰 저장에 성공한 경우, 성공 메시지를 표시하고 마이페이지로 리디렉션합니다.
    echo '<script>alert("리뷰가 작성되었습니다.");</script>';
    echo '<script>window.location.href = "mypage.php";</script>';
    exit();
} else {
    // 리뷰 저장에 실패한 경우, 오류 메시지를 표시하고 이전 페이지로 이동합니다.
    echo '<script>alert("리뷰 작성에 실패했습니다.");</script>';
    echo '<script>window.history.back();</script>';
    exit();
}
?>

