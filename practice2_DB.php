<?php
$host = 'localhost'; // MySQL 호스트
$db = 'practice2'; // 사용할 데이터베이스 이름
$user = 'root'; // 데이터베이스 사용자 이름
$pass = ''; // 데이터베이스 암호

// MySQLi 객체 생성
$mysqli = new mysqli($host, $username, $password, $database);

// 연결 확인
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// 게시글 테이블 생성
$createTableQuery = "
CREATE TABLE IF NOT EXISTS posts (
    user_id VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)

";

if ($mysqli->query($tableQuery) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $mysqli->error;
}

$mysqli->close();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 사용자 입력 받기
    $user_id = $_POST['user_id']; 
    $title = $_POST['title'];
    $body = $_POST['body'];

    // 게시글 삽입
    $insertQuery = "INSERT INTO posts (user_id, title, body) VALUES (:user_id, :title, :body)";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT); 
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':body', $body, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "게시글이 성공적으로 작성되었습니다.";
    } else {
        echo "게시글 작성 중 오류가 발생했습니다.";
    }
}
?>
