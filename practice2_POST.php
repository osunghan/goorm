<?php
$host = 'localhost'; // MySQL 호스트
$db = 'practice2'; // 사용할 데이터베이스 이름
$user = 'root'; // 데이터베이스 사용자 이름
$pass = ''; // 데이터베이스 암호

// MySQLi 객체 생성
$mysqli = new mysqli($host, $user, $pass, $db);

// 연결 오류 확인
if ($mysqli->connect_error) {
    die("연결 실패: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 사용자 입력 받기
    $user_id = $_POST['user_id']; 
    $title = $_POST['title'];
    $body = $_POST['body'];

    // 게시글 삽입
    $insertQuery = "INSERT INTO posts (user_id, title, body) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($insertQuery);
    $stmt->bind_param('iss', $user_id, $title, $body);

    if ($stmt->execute()) {
        echo "게시글이 성공적으로 작성되었습니다.";
    } else {
        echo "게시글 작성 중 오류가 발생했습니다.";
    }

    // 문 닫기
    $stmt->close();
}

// 연결 종료
$mysqli->close();
?>
