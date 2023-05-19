<?php
        // 데이터베이스 연결
        $host = 'localhost'; // 데이터베이스 서버 호스트명
        $user = 'root'; // 데이터베이스 사용자명
        $password = 'root123'; // 데이터베이스 패스워드
        $dbname = 'book'; // 데이터베이스명

        $con = mysqli_connect($host, $user, $password, $dbname);
        if(mysqli_connect_errno($con)){
              echo "MySQL 연결 실패: " . mysqli_connect_error();
              exit;
	}


?>
