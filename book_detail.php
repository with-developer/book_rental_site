<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>책 대여 페이지</title>
    <!-- 부트스트랩 CSS 링크 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <!-- 네비게이션 바 -->
    <?php include 'header.php'; ?>
    <!-- 책 상세보기 -->
    <div class="container mt-5">
        <h2 class="mb-4">책 상세보기</h2>
        <?php
        include './dbconn.php';
        // 선택한 책 정보 가져오기
        $book_id = $_GET['id'];
        $sql = "SELECT * FROM books WHERE id=$book_id";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        // 책 대여 여부 확인
        $book_name = $row['book_name'];
        $sql_rental = "SELECT * FROM book_rental WHERE book_rental_name = '$book_name' AND book_rental_end >= NOW()";
        $result_rental = mysqli_query($con, $sql_rental);

        // 리뷰 정보 가져오기 (조인 사용)
        $sql_reviews = "SELECT reviews.review_content, users.user_id FROM reviews JOIN users ON reviews.user_id = users.user_id WHERE reviews.book_id = '$book_name'";
        $result_reviews = mysqli_query($con, $sql_reviews);

        // 데이터베이스 연결 종료
        mysqli_close($con);
        ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['book_name']; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['book_author']; ?></h6>
                <p class="card-text">출판사: <?php echo $row['book_publisher']; ?></p>
                <p class="card-text">언어: <?php echo $row['book_language']; ?></p>
                <p class="card-text">업데이트 날짜: <?php echo $row['book_update_date']; ?></p>
                <p class="card-text"><?php echo $row['book_description']; ?></p>
            </div>
        </div>
        <!-- 대여 버튼 -->
        <?php
        session_start();
        // 로그인 여부 확인
        if (isset($_SESSION['user_id'])) {
            // 대여 버튼
            if (mysqli_num_rows($result_rental) > 0) {
                echo '<div class="alert alert-warning mt-3" role="alert">';
                echo '이미 대여중인 책입니다.';
                echo '</div>';
            } else {
                echo '<form action="book_rental.php" method="post">';
                echo '<input type="hidden" name="book_id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="btn btn-primary mt-3">대여하기</button>';
                echo '</form>';
            }

            // 수정하기 버튼
	    echo '<a href="book_update.php?id=' . $row['id'] . '" class="btn btn-info mt-2">수정하기</a>';
	    echo '<p>';
	    echo '<a href="book_delete.php?id=' . $row['id'] . '" class="btn btn-danger mt-2">삭제하기</a>';
        }
        ?>
    </div>

    <!-- 리뷰 정보 출력 -->
    <div class="container mt-5">
        <h5 class="my-4">리뷰</h5>
        <?php
        if (mysqli_num_rows($result_reviews) > 0) {
            while ($row_review = mysqli_fetch_array($result_reviews)) {
                echo '<div class="card mb-3">';
                echo '<div class="card-body">';
                echo '<h6 class="card-title">' . $row_review['user_id'] . '님께서 작성하신 리뷰</h6>';
                echo '<p class="card-text">' . $row_review['review_content'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>리뷰가 없습니다.</p>';
        }
        ?>
    </div>

    <!-- 부트스트랩 JS 링크 -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

