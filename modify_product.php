<?php
require 'db.php';
mysqli_options($link, MYSQLI_OPT_CONNECT_TIMEOUT, 600); // 設置連接超時時間為 300 秒

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['productId'];
    $newProductName = $_POST['newProductName'];
    $newDescription = $_POST['newDescription'];
    $newPrice = $_POST['newPrice'];
    $newCategory = $_POST['newCategory'];

    // 处理文件上传
    if (isset($_FILES['newImage'])) {
        $uploadDir = 'upload/';

        // Get file name
        $fileName = $_FILES['newImage']['name'];
    
        // Move uploaded file to specified location
        $file = $_FILES['newImage']['tmp_name'];
        $dest = $uploadDir . $fileName;
        move_uploaded_file($file, $dest);
        $fileUrl = 'http://localhost/php/' . $dest;
        if ($newImg === false) {
            echo "Error reading uploaded file.";
        } else {
            echo "File uploaded successfully.";
        }
    } else {
        echo "No file uploaded.";
    }
    // 其他字段的处理逻辑，根据需要进行相应的操作

    // 准备更新字段数组
    $updateFields = [];
    $values = [];

    // 检查哪些字段有新的值，并添加到更新数组中
    if (!empty($fileUrl)) {
        $updateFields[] = "image_url=?";
        $values[] = $fileUrl;
    }
    if (!empty($newProductName)) {
        $updateFields[] = "product_name=?";
        $values[] = $newProductName;
    }
    if (!empty($newDescription)) {
        $updateFields[] = "description=?";
        $values[] = $newDescription;
    }
    if (!empty($newPrice)) {
        $updateFields[] = "price=?";
        $values[] = $newPrice;
    }
    if (!empty($newCategory)) {
        $updateFields[] = "category=?";
        $values[] = $newCategory;
    }

    // 如果有要更新的字段，则执行更新
    if (!empty($updateFields)) {
        // 构建更新查询
        $query = "UPDATE products SET " . implode(",", $updateFields) . " WHERE id = ?";
        $stmt = mysqli_prepare($link, $query);
        if ($stmt) {
            // 绑定参数
            $paramTypes = str_repeat("s", count($values) + 1); // 包括商品 ID 在内
            $params = array_merge($values, [$id]); // 商品 ID 作为最后一个参数
            mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);

            // 执行更新
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('商品已经成功更新');</script>";
                header("Location: index.php");
                exit();
            } else {
                echo "Error updating product: " . mysqli_stmt_error($stmt);
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
