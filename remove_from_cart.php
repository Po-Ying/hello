<?php

require_once 'db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cart_id'])) {
    // 獲取產品id
    $cart_id = $_POST['cart_id'];

    // 刪除購物車的產品
    $query = "DELETE FROM cart WHERE cart_id = $cart_id";
    $result = mysqli_query($link, $query);

    if ($result) {
        // 刪除成功，重新導回頁面
        header("Location: cart.php");
        exit();
    } else {
        // 刪除失敗
        echo 'Failed to remove product from cart.';
    }
} else {
    // 未收到產品id
    echo 'Product ID not provided.';
}
?>
