<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $newEmail = $_POST['newEmail'];
    $newPassword = $_POST['newPassword'];
    $newUsername = $_POST['newUsername'];

    // 准备更新字段数组
    $updateFields = [];
    $values = [];

    // 检查哪些字段有新的值，并添加到更新数组中
    if (!empty($newEmail)) {
        $updateFields[] = "account=?";
        $values[] = $newEmail;
    }
    if (!empty($newPassword)) {
        $updateFields[] = "password=?";
        $values[] = $newPassword;
    }
    if (!empty($newUsername)) {
        $updateFields[] = "username=?";
        $values[] = $newUsername;
    }

    // 如果有要更新的字段，则执行更新
    if (!empty($updateFields)) {
        $query = "UPDATE userinfo SET " . implode(",", $updateFields) . " WHERE username=?";
        $stmt = mysqli_prepare($link, $query);
        if ($stmt) {
            // 绑定参数
            // 绑定参数
            $params = array_merge($values, [$username]);
            mysqli_stmt_bind_param($stmt, str_repeat("s", count($values) + 1), ...$params);

            // 执行更新
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['username'] = $newUsername;
                echo "<script>alert('User information updated successfully.');</script>";
                header("Location: user_account.php");
                exit();
            } else {
                echo "Error updating user information: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($link);
        }
    } else {
        echo "No new information provided for updating.";
    }

    mysqli_close($link);
}
?>
