<?php
require 'db.php';


// 检查用户是否已登录
if (!isset($_SESSION['username'])) {
    // 如果用户未登录，则重定向到登录页面
    header("Location: login.php");
    exit(); // 确保重定向后，后续代码不会被执行
}

// 检查是否通过 POST 方法提交了表单，并且检查 cart_id 和 quantity 是否存在
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id']) && isset($_POST['quantity'])) {
    // 获取传递的 cart_id 和 quantity
    $cart_id = intval($_POST['cart_id']);
    $quantity = intval($_POST['quantity']);

    // 确保数量不小于1
    if ($quantity < 1) {
        $quantity = 1;
    }

    // 更新购物车中产品的数量
    $update_query = "UPDATE cart SET quantity = $quantity WHERE cart_id = $cart_id";
    $update_result = mysqli_query($link, $update_query);

    if ($update_result) {
        // 数量成功更新，可以提供适当的反馈
        echo '<script>alert("產品數量已成功更新"); window.location.href = "cart.php";</script>';
    } else {
        // 更新失败时提供错误消息
        echo '<script>alert("更新產品數量時出現問題，請稍後重試。"); window.location.href = "cart.php";</script>';
    }
} else {
    // 如果未通过 POST 方法提交表单，提供相应的错误消息
    echo '<script>alert("無效的請求。"); window.location.href = "cart.php";</script>';
}

// 关闭数据库连接
mysqli_close($link);
?>
