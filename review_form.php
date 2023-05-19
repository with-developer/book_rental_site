<?php
session_start();

// 사용자가 로그인되어 있는지 확인합니다.
if (!isset($_SESSION['user_id'])) {
    // 로그인 페이지로 리디렉션하거나 오류 메시지를 표시합니다.
    echo '<script>alert("로그인 후 시도해주세요.");</script>';
    echo '<script>window.location.href = "login.php";</script>';
    exit();
}

// book_id가 전달되었는지 확인합니다.
if (!isset($_GET['book_id'])) {
    // book_id가 전달되지 않았을 경우, 오류 메시지를 표시하거나 리디렉션합니다.
    echo '<script>alert("잘못된 요청입니다.");</script>';
    echo '<script>window.location.href = "mypage.php";</script>';
    exit();
}

// book_id 값을 가져옵니다.
$book_id = $_GET['book_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>리뷰 작성</title>
    <!-- 부트스트랩 CSS 링크 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <!-- 네비게이션 바 -->
    <?php include 'header.php'; ?>
    <!-- 리뷰 작성 폼 -->
    <div class="container mt-5">
        <h2 class="mb-4">리뷰 작성</h2>
        <form action="review_submit.php" method="POST">
            <div class="form-group">
                <label for="review_content">리뷰 내용</label>
                <textarea class="form-control" id="review_content" name="review_content" rows="5" required></textarea>
            </div>
            <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
            <button type="submit" class="btn btn-primary">리뷰 작성</button>
        </form>
    </div>
    <!-- 부트스트랩 JS 링크 -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

