<?php
// 在这里包含数据库连接的代码
require 'db.php';

// 检查是否收到 POST 请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取当前用户的用户ID
    $member_id = $_POST['deleteMemberIdInput'];

    // 开始一个事务，以确保删除操作的原子性
    mysqli_autocommit($link, false);

    // 删除与该用户相关联的购物车项目
    $query_delete_cart = "DELETE FROM cart WHERE member_id=?";
    $stmt_delete_cart = mysqli_prepare($link, $query_delete_cart);
    if ($stmt_delete_cart) {
        mysqli_stmt_bind_param($stmt_delete_cart, "i", $member_id);
        if (!mysqli_stmt_execute($stmt_delete_cart)) {
            // 如果删除购物车项目失败，则回滚事务并显示错误信息
            mysqli_rollback($link);
            echo "删除购物车项目时出错：" . mysqli_stmt_error($stmt_delete_cart);
            exit();
        }
        mysqli_stmt_close($stmt_delete_cart);
    } else {
        // 如果准备删除购物车项目的语句出错，则回滚事务并显示错误信息
        mysqli_rollback($link);
        echo "准备删除购物车项目时出错：" . mysqli_error($link);
        exit();
    }

    // 删除用户信息
    $query_delete_user = "DELETE FROM userinfo WHERE member_id=?";
    $stmt_delete_user = mysqli_prepare($link, $query_delete_user);
    if ($stmt_delete_user) {
        mysqli_stmt_bind_param($stmt_delete_user, "i", $member_id);
        if (!mysqli_stmt_execute($stmt_delete_user)) {
            // 如果删除用户信息失败，则回滚事务并显示错误信息
            mysqli_rollback($link);
            echo "删除用户信息时出错：" . mysqli_stmt_error($stmt_delete_user);
            exit();
        }
        mysqli_stmt_close($stmt_delete_user);
    } else {
        // 如果准备删除用户信息的语句出错，则回滚事务并显示错误信息
        mysqli_rollback($link);
        echo "准备删除用户信息时出错：" . mysqli_error($link);
        exit();
    }

    // 提交事务
    mysqli_commit($link);

    // 关闭数据库连接
    mysqli_close($link);

    // 删除成功后重定向到其他页面或显示成功信息
    echo "<script>window.alert('成功刪除')</script>";
    echo "<script>window.location.href='viewAll_UserInfo.php'</script>";
    exit();
}
?>
