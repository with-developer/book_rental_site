<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>로그인 페이지</title>
	<!-- 부트스트랩 CSS 링크 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<!-- 네비게이션 바 -->
	<?php include 'header.php'; ?>
	<!-- 로그인 폼 -->
	<div class="container mt-5">
		<h2 class="mb-4">로그인</h2>
		<form method="post" action="login_backend.php">
			<div class="form-group">
				<label for="user_id">아이디</label>
				<input type="text" class="form-control" id="user_id" name="user_id" placeholder="아이디를 입력하세요">
			</div>
			<div class="form-group">
				<label for="user_pw">비밀번호</label>
				<input type="password" class="form-control" id="user_pw" name="user_pw" placeholder="비밀번호를 입력하세요">
			</div>
			<div class="form-group text-right">
				<button type="submit" class="btn btn-primary">로그인</button>
			</div>
		</form>
	</div>
	<!-- 부트스트랩 JS 링크 -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

