<!DOCTYPE html>
<html>
    <head>
        <?php 
            require 'hd.php';
        ?>
    </head>

    <body>
        <?php
            require 'header.php'
        ?>


        <section class="bg-deepgray mx-0">
            <div class="container">
                <div class="row justify-content-between align-items-center mx-auto text_strong">
                    <div class="col-2  ">
                        <!-- Back 按钮 -->
                        <a href="javascript:history.back()"><img src="left-chevron.png" alt="Back" class="back"/></a>
                    </div>
                    <div class="col-2 text-center">
                        <!-- 图片 -->
                        <img class="pd img-fluid" src="cart.png" alt="pd_detail">
                    </div>
                    <div class="col-2"></div> <!-- 这里是一个占位列，保持布局对齐 -->
                </div>
            </div>
        </section>

        <h1>&nbsp;</h1>
        <div class="container">
        <?php
        // 查询数据库，获取用户购物车中的所有产品信息
        $member_id = $_SESSION['member_id'];
        $query = "SELECT cart.cart_id,products.product_name, products.image_url, products.price, cart.quantity FROM cart INNER JOIN products ON cart.product_id = products.id WHERE cart.member_id = $member_id";
        $result = mysqli_query($link, $query);

        // 检查查询结果是否为空
        if (mysqli_num_rows($result) > 0) {
            $total_price = 0;
            // 循环显示每个产品
            while ($row = mysqli_fetch_assoc($result)) {
                $product_total = $row['price'] * $row['quantity']; 
                $total_price += $product_total; 
                echo '<div class="product">';
                $imageSrc = $row['image_url'];
                echo "<img src='$imageSrc' alt='Product Image'>";
                echo '<div>';
                echo '<h3>' . $row['product_name'] . '</h3>';
                echo '<p>$' . htmlspecialchars($row['price']) . ' x ' . htmlspecialchars($row['quantity']) . ' = $' . number_format($product_total, 0) . '</p>';
                
                echo '<div class="d-flex">';
                echo '<form action="update_cart_quantity.php" method="POST" class="d-flex align-items-center ">';
                echo '<input type="hidden" name="cart_id" value="' . htmlspecialchars($row['cart_id']) . '">';
                echo '<input type="number" name="quantity" value="' . htmlspecialchars($row['quantity']) . '" min="1" class="form-control w-25">';
                echo '<button type="submit" class="btn btn-primary ms-5">更新數量</button>';
                echo '</form>';

               
                echo '<form action="remove_from_cart.php" method="POST">';
                echo '<input type="hidden" name="cart_id" value="' . $row['cart_id'] . '">';
                echo '<button type="submit" class="btn btn-danger delete-btn">刪除商品</button>';
                echo '</form>';
                echo '</div>';
                
                echo '</div>';

                echo '</div>';
                
            }
        } else {
            // 如果购物车为空，显示消息
            echo '<p>你的購物車為空喔><</p>';
        }

        // 释放查询结果的内存
        mysqli_free_result($result);

        // 关闭数据库连接
        mysqli_close($link);
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
