<!-- 네비게이션 바 -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">책 대여 사이트</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                // 세션 시작
                session_start();

                if(isset($_SESSION['user_id'])) {
                    // 세션에 사용자 정보가 있는 경우, 사용자 아이디 출력 및 로그아웃 버튼 생성
                    $user_id = $_SESSION['user_id'];
                    echo '<li class="nav-item"><a class="nav-link" href="/mypage.php">' . $user_id . '님</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="/logout.php">로그아웃</a></li>';
                } else {
                    // 세션에 사용자 정보가 없는 경우, 로그인/회원가입 버튼 출력
                    echo '<li class="nav-item"><a class="nav-link" href="/login.php">로그인</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="/register.php">회원가입</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

