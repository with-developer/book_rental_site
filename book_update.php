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
    <title>책 수정</title>
    <!-- 부트스트랩 CSS 링크 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <!-- 네비게이션 바 -->
    <?php include 'header.php'; ?>
    <!-- 책 수정 폼 -->
    <div class="container mt-5">
        <h2 class="mb-4">책 수정</h2>
        <?php
        include './dbconn.php';
        // 선택한 책 정보 가져오기
        $book_id = $_GET['id'];
        $sql = "SELECT * FROM books WHERE id=$book_id";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        // 데이터베이스 연결 종료
        mysqli_close($con);
        ?>
        <form action="book_update_backend.php" method="post">
            <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="book_name">책 이름:</label>
                <input type="text" class="form-control" id="book_name" name="book_name" value="<?php echo $row['book_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="book_author">책 저자:</label>
                <input type="text" class="form-control" id="book_author" name="book_author" value="<?php echo $row['book_author']; ?>" required>
            </div>
            <div class="form-group">
                <label for="book_publisher">책 출판사:</label>
                <input type="text" class="form-control" id="book_publisher" name="book_publisher" value="<?php echo $row['book_publisher']; ?>" required>
            </div>
            <div class="form-group">
                <label for="book_description">책 설명:</label>
                <textarea class="form-control" id="book_description" name="book_description" rows="3" required><?php echo $row['book_description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="book_division">책 구분:</label>
                <select class="form-control" id="book_division" name="book_division" required>
                    <option value="소설" <?php if ($row['book_division'] == '소설') echo 'selected'; ?>>소설</option>
                    <option value="자기계발" <?php if ($row['book_division'] == '자기계발') echo 'selected'; ?>>자기계발</option>
		    <option value="역사" <?php if ($row['book_division'] == '역사') echo 'selected'; ?>>역사</option>
                    <option value="과학" <?php if ($row['book_division'] == '과학') echo 'selected'; ?>>과학</option>
                    <option value="예술" <?php if ($row['book_division'] == '예술') echo 'selected'; ?>>예술</option>
                    <option value="기타" <?php if ($row['book_division'] == '기타') echo 'selected'; ?>>기타</option>
                </select>
            </div>
            <div class="form-group">
                <label for="book_language">책 언어:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="book_language1" name="book_language" value="한국어" <?php if ($row['book_language'] == '한국어') echo 'checked'; ?> required>
                    <label class="form-check-label" for="book_language1">한국어</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="book_language2" name="book_language" value="영어" <?php if ($row['book_language'] == '영어') echo 'checked'; ?>>
                    <label class="form-check-label" for="book_language2">영어</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="book_language3" name="book_language" value="일본어" <?php if ($row['book_language'] == '일본어') echo 'checked'; ?>>
                    <label class="form-check-label" for="book_language3">일본어</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="book_language4" name="book_language" value="기타" <?php if ($row['book_language'] == '기타') echo 'checked'; ?>>
                    <label class="form-check-label" for="book_language4">기타</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">수정하기</button>
        </form>
    </div>
    <!-- 부트스트랩 JS 링크 -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

