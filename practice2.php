<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>게시판</title>
</head>
<body>
    <h1>게시판</h1>

    <!-- 게시글 목록 표시 -->
    <h2>게시글 목록</h2>
    <?php
    // MySQLi 객체 생성
    $mysqli = new mysqli("localhost", "root", "", "practice2");

    // 연결 확인
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // 게시글 목록 조회 쿼리
    $selectQuery = "SELECT * FROM posts ORDER BY created_at DESC";
    $result = $mysqli->query($selectQuery);

    // 결과 출력
    while ($row = $result->fetch_assoc()) {
        echo "
        <div>
            <h3>제목: {$row['title']}</h3> <p>작성자: {$row['user_id']} 작성일: {$row['created_at']}</p>
            <p>{$row['body']}</p> 
        </div>
        ";
    }
    
    $mysqli->close();
    ?>

    <!-- 게시글 작성 폼 -->
    <h2>게시글 작성</h2>
    <form action="practice2_POST.php" method="post">
        <label for="user_id">사용자 이름:</label>
        <input type="text" name="user_id" required /><br />

        <label for="title">게시글 제목:</label>
        <input type="text" name="title" required /><br />

        <label for="body">게시글 내용:</label>
        <textarea name="body" rows="4" required></textarea><br />

        <input type="submit" value="게시글 작성" />
    </form>
</body>
</html>
