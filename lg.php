<?php
// 包含資料庫連接
require_once 'db.php';


// 檢查是否收到使用者提交的表單
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 接收使用者提交的帳號和密碼
    $account = $_POST['account'];
    $password = $_POST['password'];

    // 在資料庫中查詢是否存在該帳號
    $query = "SELECT * FROM userinfo WHERE account = '$account' AND password = '$password'";
    $result = mysqli_query($link, $query);

    // 檢查查詢結果是否為空
    if (mysqli_num_rows($result) == 1) {
        // 登入成功，導向到 index.php 頁面
        $row = mysqli_fetch_assoc($result); // 獲取資料庫結果的一行
        $_SESSION['member_id'] = $row['member_id'];// 將使用者id存入 session
        $_SESSION['username'] = $row['username']; // 將使用者名稱存入 session
        $_SESSION['role'] = $row['role']; // 將使用者角色存入 session
        // 釋放查詢結果
        mysqli_free_result($result);  

        header("Location: index.php");
        exit();
    } else {
        // 帳號不存在或密碼錯誤，彈出 Modal 提示用戶
        echo "<script>
                alert('查無此帳號或密碼錯誤');
                window.location.href = 'login.php';
              </script>";
    }
}


// 檢查是否有收到登出請求
if (isset($_GET['logout'])) {
    // 清除 session 中的使用者名稱
    unset($_SESSION['username']);
    session_destroy();
    mysqli_close($link);

    // 重新導向到登入頁面
    header("Location: login.php");
    exit();
}
else
{
    mysqli_close($link);

    header("Location: login.php");
    exit();
}

?>
