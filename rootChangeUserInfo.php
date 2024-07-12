<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['modifyMemberIdInput'];
    $newEmail = $_POST['newEmail'];
    $newPassword = $_POST['newPassword'];
    $newUsername = $_POST['newUsername'];
    $newRole = $_POST['newRole'];

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
    if (!empty($newRole)) {
        $updateFields[] = "role=?";
        $values[] = $newRole;
    }

    // 如果有要更新的字段，则执行更新
    if (!empty($updateFields)) {
        $query = "UPDATE userinfo SET " . implode(",", $updateFields) . " WHERE member_id=?";
        $stmt = mysqli_prepare($link, $query);
        if ($stmt) {
            // 绑定参数
            $paramTypes = str_repeat("s", count($values)) . "i"; // 字符串参数后跟整数参数
            $params = array_merge($values, [(int)$id]); // 将 ID 转为整数类型

            echo "Query: $query<br>";
            echo "Params: ";
            print_r($params);

            mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);

            // 执行更新
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('User information updated successfully.');</script>";
                header("Location: viewAll_UserInfo.php");
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
