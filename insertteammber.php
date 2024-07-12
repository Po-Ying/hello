<?php
require 'db.php';

// 检查是否接收到表单提交的数据
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单提交的数据
    $name = $_POST['name'];
    $position = $_POST['position'];
    $image_url = $_POST['image_url'];
    $role = $_POST['role'];
    $team = $_POST['team'];

    // 准备 SQL 语句
    $query = "INSERT INTO team_member (name, position, image_url, role, teams) VALUES (?, ?, ?, ?, ?)";
    
    // 创建预处理语句对象
    $stmt = $link->prepare($query);
    
    // 绑定参数并执行预处理语句
    $stmt->bind_param("sssss", $name, $position, $image_url, $role, $team);
    $stmt->execute();
    
    // 检查是否成功插入数据
    if ($stmt->affected_rows > 0) {
        echo "插入成功。";
    } else {
        echo "插入数据时出现问题：" . $stmt->error;
    }
    
    // 关闭预处理语句和数据库连接
    $stmt->close();
    $link->close();
}
?>
