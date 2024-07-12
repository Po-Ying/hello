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
                        <img class="pd img-fluid" src="pd.png" alt="pd_detail">
                    </div>
                    <div class="col-2"></div> <!-- 这里是一个占位列，保持布局对齐 -->
                </div>
            </div>
        </section>

        <section>
            <div class="container bg-light my-3">
                <div class="row">
                    <?php
                    // 检查是否传递了商品 ID
                    if(isset($_GET['id'])) {
                        // 获取传递的商品 ID
                        $product_id = $_GET['id'];

                        // 查询数据库获取指定 ID 的商品信息
                        $query = "SELECT * FROM products WHERE id = $product_id";
                        $result = mysqli_query($link, $query);

                        // 检查查询是否成功
                        if ($result && mysqli_num_rows($result) > 0) {
                            // 输出商品信息
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <div class="col-12 col-md-6">
                                <!-- 产品图片 -->
                                <?php $imageSrc = $row['image_url']; ?>
                                <img src="<?php echo $imageSrc ?>" alt="Product Image" style="width: 100%; height: auto;">
                            </div>    
                                <!-- 其他产品信息 -->
                            <div class="col-12 col-md-6">
                                <h2><?php echo $row['product_name']; ?></h2>
                                <?php 
                                        $description = $row['description']; // 從資料庫中獲取描述
                                        $lines = explode("\n", $description); // 將描述按換行符分割成行
                                        
                                        // 輸出每一行描述，使用 " · " 進行分隔
                                        foreach ($lines as $line) {
                                            echo "<p>· " . nl2br($line) . "</p>";
                                        }
                                ?>
                                <h3>Price: $<?php echo intval($row['price']); ?></h3>
                                <div class="col-12 mt-3">
                                    <form action="add_to_cart.php" method="GET">
                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">數量：</label>
                                            <select id="quantity" name="quantity" class="form-select" required>
                                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $product_id; ?>">
                                        <button type="submit" class="btn btn-dark text-light">新增至購物車</button>
                                    </form>
                                </div>
                                <?php
                                
                                if((isset($_SESSION['role']) && $_SESSION['role'] === 'root')||(isset($_SESSION['role']) && $_SESSION['role'] === 'seller' && $_SESSION['member_id'] === $row['whoInput'])) 
                                    {
                                        // 如果角色为 "root"，显示按钮
                                        echo '<div class="col-12 mt-3">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifyProductModal">
                                                    修改商品內容
                                                </button>
                                            </div>';
                                            echo '<div class="col-12 mt-3">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delProductModal">
                                                刪除此商品
                                            </button>
                                        </div>';
                                    }
                                ?>    
                            </div>
                            
                            <?php
                            // 释放查询结果的内存
                            mysqli_free_result($result);
                        } else {
                            // 如果未找到对应 ID 的商品，输出相应的错误信息
                            echo "<div class='col-12'>";
                            echo "Product not found.";
                            echo "</div>"; // col-12
                        }
                    } else {
                        // 如果未传递商品 ID，输出相应的错误信息
                        echo "<div class='col-12'>";
                        echo "Product ID not provided.";
                        echo "</div>"; // col-12
                    }

                    // 关闭数据库连接
                    mysqli_close($link);
                    ?>
                </div><!-- row -->
            </div><!-- container -->

            
        </section>
        
        <div class="modal fade" id="modifyProductModal" tabindex="-1" role="dialog" aria-labelledby="modifyProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyProductModalLabel">修改商品資訊(若無需改變則輸入原值)</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- 修改商品的表单 -->
                        <form action="modify_product.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="newImage">修改商品圖片</label>
                                <input type="file" class="form-control-file" id="newImage" name="newImage" accept="image/*">
                            </div>
                            <div>
                                <h3>&nbsp;</h3>
                            </div>
                            <div class="form-group">
                                <label for="newProductName">修改商品名稱</label>
                                <input type="text" class="form-control" id="newProductName" name="newProductName" placeholder="輸入新的商品名稱">
                            </div>
                            <div class="form-group">
                                <label for="newDescription">修改商品描述</label>
                                <textarea class="form-control" id="newDescription" name="newDescription" rows="3" placeholder="輸入新的商品描述"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="newPrice">修改商品價格</label>
                                <input type="number" class="form-control" id="newPrice" name="newPrice" placeholder="輸入新的商品價格">
                            </div>
                            <div class="form-group">
                                <label for="newCategory">修改商品種類</label>
                                <select class="form-control" id="newCategory" name="newCategory">
                                    <option value="Jerseys">球衣</option>
                                    <option value="T_shirt">T-shirt</option>
                                    <option value="Basketball">籃球</option>
                                    <option value="Accessories">配件</option>
                                    <option value="Merchandise">周邊</option>
                                </select>
                            </div>
                            <div>
                                <h3>&nbsp;</h3>
                            </div>
                            <input type="hidden" name="productId" id="productId" value="<?php echo $product_id; ?>">

                            <button type="submit" class="btn btn-primary">確認</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delProductModal" tabindex="-1" role="dialog" aria-labelledby="delProductModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center"><h3 class="modal-title my-4" id="delProductModalLabel">確定要刪除此商品嗎？</h3>
                        <img src="remove.png" class="rounded my-4" style="width: 100px;height: 100px;"alt="removeProduct?"></div>
                        
                        <form action="del_product.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="delProductId" name="id" value="<?php echo $product_id; ?>">

                            <button type="submit" class="btn btn-danger mt-4">確認</button>
                            <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal">取消</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        
    </body>

</html>