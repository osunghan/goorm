<!DOCTYPE html>
<html lang="en">
<head>
  <title>로그인 페이지 만들기</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .input-group + .input-group {
      margin-top: 10px;
    } 
  </style>
</head>
<body>
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <h1>Login</h1>
      <hr>
      <form method="GET" action="login.php"> 
        <div class="input-group flex-nowrap mb-1">
          <span class="input-group-text" id="addon-wrapping-username">ID</span>
          <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping-username">
        </div>
        <div class="input-group flex-nowrap mb-1">
          <span class="input-group-text" pw="addon-wrapping-password">PW</span>
          <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping-password">
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Login</button>
      </form>
    </div>
  </div>
</body>
</html>

<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "project";

// 연결 생성
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // 폼에서 값을 가져오기
    $username = $_GET["username"];
    $password = $_GET["password"];

    // SQL 쿼리를 생성하여 사용자의 ID와 비밀번호를 확인
    $sql = "SELECT * FROM User WHERE id = '$username' AND pw = '$password'";
    $result = $conn->query($sql);

    // 결과 확인
    if ($result->num_rows > 0) {
        // 로그인 성공 메시지
        echo "로그인 성공!";
    } else {
        // 로그인 실패 메시지
        echo "로그인 실패. 올바른 ID와 비밀번호를 입력하세요.";
    }
}

// 연결 종료
$conn->close();
?>
