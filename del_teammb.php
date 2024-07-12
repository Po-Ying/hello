<?php
// 在这里包含数据库连接的代码
require 'db.php';

// 检查是否收到 POST 请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取当前队员的 ID 和团队名称
    $id = $_POST['memberId'];
    $team = $_POST['team'];

    // 开始一个事务，以确保删除操作的原子性
    mysqli_autocommit($link, false);

    // 删除队员信息
    $query_delete_member = "DELETE FROM team_member WHERE id = ?";
    $stmt_delete_member = mysqli_prepare($link, $query_delete_member);
    if ($stmt_delete_member) {
        mysqli_stmt_bind_param($stmt_delete_member, "i", $id);
        if (!mysqli_stmt_execute($stmt_delete_member)) {
            // 如果删除队员信息失败，则回滚事务并显示错误信息
            mysqli_rollback($link);
            echo "刪除時錯誤：" . mysqli_stmt_error($stmt_delete_member);
            exit();
        }
        mysqli_stmt_close($stmt_delete_member);
    } else {
        // 如果准备删除队员信息的语句出错，则回滚事务并显示错误信息
        mysqli_rollback($link);
        echo "準備刪除時錯誤：" . mysqli_error($link);
        exit();
    }

    // 提交事务
    mysqli_commit($link);

    // 关闭数据库连接
    mysqli_close($link);

    // 删除成功后重定向到其他页面或显示成功信息
    header("Location: chTeammb.php?team=$team");
    exit();
}
?>
