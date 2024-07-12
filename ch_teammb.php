<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['memberId'];
    $newImage = $_POST['newImage'];
    $newName = $_POST['newName'];
    $newPosition = $_POST['newPosition'];
    $newRole = $_POST['newRole'];
    $newTeam = $_POST['newTeam'];

    // 准备更新字段数组
    $updateFields = [];
    $values = [];

    // 检查哪些字段有新的值，并添加到更新数组中
    if (!empty($newImage)) {
        $updateFields[] = "image_url=?";
        $values[] = $newImage;
    }
    if (!empty($newName)) {
        $updateFields[] = "name=?";
        $values[] = $newName;
    }
    if (!empty($newPosition)) {
        $updateFields[] = "position=?";
        $values[] = $newPosition;
    }
    if (!empty($newRole)) {
        $updateFields[] = "role=?";
        $values[] = $newRole;
    }
    if (!empty($newTeam)) {
        $updateFields[] = "teams=?";
        $values[] = $newTeam;
    }


    // 如果有要更新的字段，则执行更新
    if (!empty($updateFields)) {
        // 构建更新查询
        $query = "UPDATE team_member SET " . implode(",", $updateFields) . " WHERE id = ?";
        $stmt = mysqli_prepare($link, $query);
        if ($stmt) {
            // 绑定参数
            $paramTypes = str_repeat("s", count($values) + 1); // 包括隊員 ID 在内
            $params = array_merge($values, [$id]); // 隊員 ID  作为最后一个参数
            mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);

            // 执行更新
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>window.alert('隊員已經成功更新');</script>";
                header("Location: chTeammb.php?team=$newTeam");
                exit();
            } else {
                echo "Error updating teammember: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($link);
        }
    } else {
        echo "No new information provided for updating.";
    }

}
?>
