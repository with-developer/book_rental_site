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
    <!-- 책 리스트 -->
    <div class="container mt-5">
        <h2 class="mb-4">책 리스트</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>번호</th>
                    <th>제목</th>
                    <th>저자</th>
                    <th>출판사</th>
                    <th>대여 가능 여부</th>
                    <th>상세보기</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include './dbconn.php';
                // 책 리스트 가져오기
                $sql = "SELECT * FROM books";
                $result = mysqli_query($con, $sql);
                $row_count = mysqli_num_rows($result);
                $per_page = 10;
                $pages = ceil($row_count / $per_page);

                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }

                $start = ($page - 1) * $per_page;
                $sql = "SELECT * FROM books LIMIT $start, $per_page";
                $result = mysqli_query($con, $sql);

                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['book_name'] . "</td>";
                    echo "<td>" . $row['book_author'] . "</td>";
                    echo "<td>" . $row['book_publisher'] . "</td>";
                    echo "<td>";
                    $sql_rental = "SELECT COUNT(*) FROM book_rental WHERE book_rental_name = '{$row['book_name']}' AND book_rental_end >= NOW()";
                    $result_rental = mysqli_query($con, $sql_rental);
                    $row_rental = mysqli_fetch_array($result_rental);
                    if ($row_rental[0] > 0) {
                        echo "대여 불가능";
                    } else {
                        echo "대여 가능";
                    }
                    echo "</td>";
                    echo "<td><a href='book_detail.php?id=" . $row['id'] . "'>상세보기</a></td>";
                    echo "</tr>";
                }
                // 데이터베이스 연결 종료
                mysqli_close($con);
                ?>
            </tbody>
        </table>

        <?php
        if ($pages > 1) {
            echo '<ul class="pagination justify-content-center">';
            for ($i = 1; $i <= $pages; $i++) {
                echo '<li class="page-item">';
                echo '<a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a>';
               
                echo '</li>';
            }
            echo '</ul>';
        }
        ?>

        <?php
        session_start();
        // 로그인 여부 확인
        if (isset($_SESSION['user_id'])) {
            echo '<div class="text-right">';
            echo '<a href="/book_upload.php" class="btn btn-primary">책 등록</a>';
            echo '</div>';
        }
        ?>
    </div>
    <!-- 부트스트랩 JS 링크 -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

