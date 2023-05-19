<?php
// book_rental.php
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
session_start();

// POST 방식으로 전송된 데이터를 변수에 저장
$book_id = $_POST['book_id'];
$user_name = $_SESSION['user_id'];

// 대여 중인 책인지 확인
$sql_rental = "SELECT COUNT(*) FROM book_rental WHERE book_rental_name = (SELECT book_name FROM books WHERE id = '$book_id') AND book_rental_end >= NOW()";
$result_rental = mysqli_query($con, $sql_rental);
$row_rental = mysqli_fetch_array($result_rental);

if($row_rental[0] > 0){
    // 이미 대여중인 책이므로 대여 처리 불가능
    echo '<script>alert("이미 대여중인 책입니다."); history.back();</script>';
} else {
    // 대여 정보를 book_rental 테이블에 추가
    $rental_start = date('Y-m-d H:i:s'); // 현재 날짜
    //$rental_end = date('Y-m-d H:i:s', strtotime('+3 minutes')); // 현재로부터 3분뒤
    $rental_end = date('Y-m-d H:i:s', strtotime('+1 days')); // 현재로부터 7일 뒤 날짜
    $sql_book = "SELECT book_name FROM books WHERE id='$book_id'";
    $result_book = mysqli_query($con, $sql_book);
    $row_book = mysqli_fetch_array($result_book);
    $book_name = $row_book['book_name'];
    $sql = "INSERT INTO book_rental (book_rental_name, book_rental_id, book_rental_start, book_rental_end) VALUES ('$book_name', '$user_name', '$rental_start', '$rental_end')";
    $result = mysqli_query($con, $sql);

    if($result){
        // 대여 정보 추가 성공
        echo '<script>alert("책이 대여되었습니다."); location.replace("/mypage.php");</script>';
    } else {
        // 대여 정보 추가 실패
        echo '<script>alert("책 대여에 실패했습니다."); history.back();</script>';
    }
}

// 데이터베이스 연결 종료
mysqli_close($con);
?>
