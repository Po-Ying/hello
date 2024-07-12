<?php

require 'db.php';

// 首先启动会话以便使用$_SESSION变量

// 检查用户是否已登录
if (!isset($_SESSION['username'])) {
    // 如果用户未登录，则重定向到登录页面
    header("Location: login.php");
    exit(); // 确保重定向后，后续代码不会被执行
}

// 检查是否传递了产品ID
if (isset($_GET['id'])) {
    // 获取传递的产品ID
    $product_id = $_GET['id'];


    // 获取产品信息，您可能需要从数据库中检索产品的其他信息，例如价格等
    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($link, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        
        // 假设您的购物车表结构类似于之前提到的结构
        $member_id = $_SESSION['member_id']; // 获取当前登录用户的ID
        $quantity = $_GET['quantity']; // 假设默认添加一个产品

        // 插入产品到购物车表
        $insert_query = "INSERT INTO cart (member_id, product_id, quantity) VALUES ($member_id, $product_id, $quantity)";
        $insert_result = mysqli_query($link, $insert_query);

        if ($insert_result) {
            // 产品成功添加到购物车，可以提供适当的反馈
            echo '<script>alert("產品已成功添加至購物車"); window.location.href = "product_item.php?id=' . $product_id . '";</script>';
            exit();
        } else {
            // 添加失败时提供错误消息
            echo '<script>alert("添加到购物车时出现问题，请稍后重试。");</script>';
        }
    } else {
        // 未找到具有给定ID的产品，提供适当的错误消息
        echo '<script>alert("未找到产品。");</script>';
    }

    // 释放查询结果的内存
    mysqli_free_result($result);

    // 关闭数据库连接
    mysqli_close($link);
} else {
    // 如果未传递产品ID，提供相应的错误消息
    echo  '<script>alert("未提供产品ID。");</script>';
}
?>
