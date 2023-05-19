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
session_start();
$user_id = $_SESSION['user_id'];
$book_name = $_POST['book_name'];

// 해당 책의 대여 기록을 찾습니다.
$sql = "SELECT * FROM book_rental WHERE book_rental_id='$user_id' AND book_rental_name='$book_name'";
$result = mysqli_query($con, $sql);
if($result){
    $row = mysqli_fetch_array($result);
    $rental_id = $row['book_rental_id'];
    $rental_end = date('Y-m-d H:i:s');
    
    // book_rental_end를 현재 시간으로 변경합니다.
    $sql_update = "UPDATE book_rental SET book_rental_end='$rental_end' WHERE book_rental_id='$rental_id' AND book_rental_name='$book_name'";
    $result_update = mysqli_query($con, $sql_update);
    if($result_update){
    	echo '<script>alert("책 반납에 성공했습니다.");location.replace("/mypage.php");</script>';
    } else {
        echo '<script>alert("책 반납에 실패했습니다."); location.replace("/mypage.php");</script>';
    }
} else {
    echo '<script>alert("해당 책을 대여하고 있지 않습니다."); location.replace("/mypage.php");</script>';
}

mysqli_close($con);
?>

