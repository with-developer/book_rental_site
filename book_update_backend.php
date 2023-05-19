<?php
session_start();

// 사용자가 로그인되어 있는지 확인합니다.
if (!isset($_SESSION['user_id'])) {
    // 로그인 페이지로 리디렉션하거나 오류 메시지를 표시합니다.
    echo '<script>alert("로그인 후 시도해주세요.");</script>';
    echo '<script>window.location.href = "login.php";</script>';
    exit();
}

include './dbconn.php';

$book_id = $_POST['book_id'];

$book_name = $_POST['book_name'];
$book_author = $_POST['book_author'];
$book_publisher = $_POST['book_publisher'];
$book_description = $_POST['book_description'];
$book_division = $_POST['book_division'];
$book_language = $_POST['book_language'];

$sql = "UPDATE books SET 
        book_name = '$book_name',
        book_author = '$book_author',
        book_publisher = '$book_publisher',
        book_description = '$book_description',
        book_division = '$book_division',
        book_language = '$book_language'
        WHERE id = $book_id";

if (mysqli_query($con, $sql)) {
    echo "<script>alert('책 정보가 성공적으로 수정되었습니다.');</script>";
    echo "<script>window.location.href = 'book_detail.php?id=$book_id';</script>";
} else {
    echo "<script>alert('책 정보 수정에 실패하였습니다.');</script>";
    echo "<script>window.location.href = 'book_detail.php?id=$book_id';</script>";
}

mysqli_close($con);
?>

