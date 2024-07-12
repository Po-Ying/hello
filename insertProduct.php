<?php
    require 'db.php';
// Check if file is uploaded successfully
if ($_FILES['image']['size'] > 0) {
    // Define upload directory
    $uploadDir = 'upload/';

    // Get file name
    $fileName = $_FILES['image']['name'];

    // Move uploaded file to specified location
    //$file = $_FILES['image']['tmp_name'];
    $dest = $uploadDir . $fileName;
    //move_uploaded_file($file, $dest);

    // Get other form data
    $productName = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $member_id=$_SESSION['member_id'];

    // Construct file URL or path
    $fileUrl = $dest; // Change this to your actual domain

    // Connect to database


    // Prepare SQL statement to insert data
    $sql = "INSERT INTO products (image_url, product_name, description, price, category, whoInput) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ssssss", $fileUrl, $productName, $description, $price, $category, $member_id);

    // Execute SQL statement
    if ($stmt->execute()) {
        $stmt->close();
        $link->close();
        echo "<script>window.alert('新增成功')</script>";
        echo "<script>window.location.href='insert_product.php'</script>";
        exit();
        
    } else {
        echo "Failed to add product.";
    }

    // Close statement and database connection
    $stmt->close();
    $link->close();
} else {
    echo "No image uploaded.";
}
?>