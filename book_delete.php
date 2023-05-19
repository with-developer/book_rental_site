<?php
include './dbconn.php';

// 선택한 책의 ID 가져오기
$book_id = $_GET['id'];

// 책 삭제 쿼리 실행
$sql_delete = "DELETE FROM books WHERE id=$book_id";
$result_delete = mysqli_query($con, $sql_delete);

// 데이터베이스 연결 종료
mysqli_close($con);

// 삭제 성공 시 메시지 출력 후 책 목록 페이지로 리디렉션
if ($result_delete) {
    echo '<script>alert("책이 삭제되었습니다.");</script>';
    echo '<script>window.location.href = "/";</script>';
    exit();
} else {
    echo '<script>alert("책 삭제에 실패했습니다.");</script>';
    echo '<script>window.location.href = "/";</script>';
    exit();
}
?>

