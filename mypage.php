<?php
session_start();

// 사용자가 로그인되어 있는지 확인합니다.
if (!isset($_SESSION['user_id'])) {
    // 로그인 페이지로 리디렉션하거나 오류 메시지를 표시합니다.
    echo '<script>alert("로그인 후 시도해주세요.");</script>';
    echo '<script>window.location.href = "login.php";</script>';
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>마이페이지</title>
    <!-- 부트스트랩 CSS 링크 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
	.card-body {
    		flex-direction: row;
    		justify-content: space-between;
    		align-items: center;
	}

</style>
</head>
<body>
    <!-- 네비게이션 바 -->
    <?php include 'header.php'; ?>
    <!-- 마이페이지 -->
    <div class="container mt-5">
        <h2 class="mb-4">마이페이지</h2>
        <?php
        include './dbconn.php';
        session_start();
        // 로그인한 사용자의 정보를 가져오기 위해 세션에서 user_id를 가져온다.
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE user_id='$user_id'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        // 데이터베이스 연결 종료
        mysqli_close($con);
        ?>
        <p><strong>아이디:</strong> <?php echo $row['user_id']; ?></p>
        <p><strong>이름:</strong> <?php echo $row['user_name']; ?></p>
        <p><strong>전화번호:</strong> <?php echo $row['user_phonenumber']; ?></p>
        <!-- 패스워드 변경 버튼 -->
        <a href="/changepassword.php" class="btn btn-primary">패스워드 변경</a>

        <h5 class="my-4">대여중인 책 정보</h5>
        <?php
        include './dbconn.php';
        // 사용자가 대여중인 책 정보 가져오기
        $sql_rental = "SELECT book_rental_name, book_rental_start, book_rental_end FROM book_rental WHERE book_rental_id='$user_id'";
        $result_rental = mysqli_query($con, $sql_rental);
        while($row_rental = mysqli_fetch_array($result_rental)){
            $rental_end = $row_rental['book_rental_end'];
            $now = date('Y-m-d H:i:s');
	    if($rental_end >= $now){
		    echo '<div class="card mb-3">';
                echo '<div class="card-body d-flex justify-content-between">';
                echo '<div>';
                echo '<h6 class="card-subtitle mb-2 text-muted">' . $row_rental['book_rental_name'] . '</h6>';
                echo '<p class="card-text">대여일: ' . $row_rental['book_rental_start'] . '</p>';
                echo '<p class="card-text">반납일: ' . $rental_end . '</p>';
                echo '</div>';
                echo '<div>';
                echo '<form action="/return_book.php" method="post">';
                echo '<input type="hidden" name="book_name" value="' . $row_rental['book_rental_name'] . '">';
                echo '<input type="submit" value="책 반납하기" class="btn btn-primary">';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
	    }
	}
?>
<h5 class="my-4">읽었던 책</h5>
<div class="card-columns">
    <?php
    include './dbconn.php';
    // 사용자가 읽은 책 정보 가져오기
    $sql_read = "SELECT * FROM book_rental WHERE book_rental_id='$user_id'";
    $result_read = mysqli_query($con, $sql_read);

    while($row_read = mysqli_fetch_array($result_read)){
        // 읽은 날짜와 현재 날짜 비교
        $read_date = $row_read['book_rental_end'];
        $now = date('Y-m-d H:i:s');
        if ($read_date < $now) {
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo '<h6 class="card-title">' . $row_read['book_rental_name'] . '</h6>';
            echo '<p class="card-text" style="font-size: 14px;">읽은 날짜: ' . $row_read['book_rental_end'] . '</p>';

            // 리뷰가 있는지 확인하는 서브쿼리
            $book_id = $row_read['book_rental_name'];
            $review_query = "SELECT * FROM reviews WHERE book_id='$book_id' AND user_id='$user_id'";
            $review_result = mysqli_query($con, $review_query);
            $has_review = mysqli_num_rows($review_result) > 0;

            if(!$has_review) {
                // 리뷰 남기기 버튼
                echo '<a href="review_form.php?book_id=' . $row_read['book_rental_name'] . '" class="btn btn-primary btn-sm">리뷰 작성하기</a>';
            }else{
                echo '<p class="card-text" style="font-size:20px">리뷰 작성완료</p>';
            }

            echo '</div>';
            echo '</div>';
        }
    }
    // 데이터베이스 연결 종료
    mysqli_close($con);
    ?>
</div>


    <!-- 부트스트랩 JS 링크 -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

