<?php
    require 'db.php';

    // 獲取表單提交的值
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    // 將用戶資料插入到資料庫中
    $query = "INSERT INTO userinfo (account, password, username, role) VALUES ('$email', '$password', '$username', '$role')";
    // 执行 SQL 查询
    $result = mysqli_query($link, $query);
    if ($result) {
        echo "<script>
            alert('註冊成功！');
            window.location.href = 'login.php';
        </script>";
    } else {
        echo "<script>
        alert('註冊失敗！');
        window.location.href = 'register.php';
    </script>";;
    }
?>