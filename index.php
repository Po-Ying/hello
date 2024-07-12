<!DOCTYPE html>
<html>
    <head>
        <?php 
            require 'hd.php';
        ?>
    </head>

    <body>
        <?php
            require 'header.php';

            // 获取类别和关键字参数
            $category = isset($_GET['category']) ? $_GET['category'] : '';
            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

            // 查询数据库获取商品总数
            $conditions = [];
            if (!empty($category)) {
                $conditions[] = "category = '" . mysqli_real_escape_string($link, $category) . "'";
            }
            if (!empty($keyword)) {
                $conditions[] = "product_name LIKE '%" . mysqli_real_escape_string($link, $keyword) . "%'";
            }

            $whereClause = !empty($conditions) ? " WHERE " . implode(" AND ", $conditions) : "";

            $query = "SELECT COUNT(*) AS total FROM products" . $whereClause;
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_assoc($result);
            $totalProducts = $row['total'];

            // 每页显示的商品数量
            $limit = 10;

            // 计算总页数
            $totalPages = ceil($totalProducts / $limit);

            // 当前页码，默认为第一页
            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            // 计算偏移量
            $offset = ($page - 1) * $limit;

            // 构建基本查询
            $query = "SELECT * FROM products" . $whereClause . " LIMIT $limit OFFSET $offset";

            // 执行查询
            $result = mysqli_query($link, $query);
        ?>

        <section>
            <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="10000">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="5" aria-label="Slide 6"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://shoplineimg.com/5a409e7f9a76f090d40002d6/655206fb55fc1dfb61bd3a80/3200x.webp?source_format=jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://shoplineimg.com/61307036faac3c002eb26d30/6530b0939a0f7d00201015df/2160x.webp?source_format=jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="KKtix_KV_1200x630__PLG例行賽事_.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="slide-1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="399040190_331747926165664_1437968759332957612_n.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://cdn.cybassets.com/media/W1siZiIsIjIwMTc3L2F0dGFjaGVkX3Bob3Rvcy8xNzEyODkxNjA3X8OpwqPCm8OowqHCjMOkwrjCrcOpwprCisOnwpDCg8OowqHCo19CYW5uZXIrU1RBTkNBVkVfw6XCt8Klw6TCvcKcw6XCjcKAw6XCn8KfIDEtMDEuanBnLmpwZWciXV0.jpeg?sha=f610b9144af35dd3" class="d-block w-100" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#bannerCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#bannerCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </section>

        <section class="bg-deepgray py-md-4 py-1 mx-0">
            <div class="container">
                <div class="row justify-content-center align-items-center mx-auto text_strong">
                    <div class="col-2 text-center py-md-2 mouseOver">
                        <a class="text-light btn btn-square <?php echo ($category == '') ? 'active' : ''; ?>" href="index.php">全部商品</a>
                    </div>
                    <div class="col-2 text-center py-md-2 mouseOver">
                        <a class="text-light btn btn-square <?php echo ($category == 'Jerseys') ? 'active' : ''; ?>" href="index.php?category=Jerseys">球衣</a>
                    </div>
                    <div class="col-2 text-center py-md-2 mouseOver">
                        <a class="text-light btn btn-square <?php echo ($category == 'T_shirts') ? 'active' : ''; ?>" href="index.php?category=T_shirts">T_shirt</a>
                    </div>
                    <div class="col-2 text-center py-md-2 mouseOver">
                        <a class="text-light btn btn-square <?php echo ($category == 'Basketball') ? 'active' : ''; ?>" href="index.php?category=Basketball">籃球</a>
                    </div>
                    <div class="col-2 text-center py-md-2 mouseOver">
                        <a class="text-light btn btn-square <?php echo ($category == 'Accessories') ? 'active' : ''; ?>" href="index.php?category=Accessories">配件</a>
                    </div>
                    <div class="col-2 text-center py-md-2 mouseOver">
                        <a class="text-light btn btn-square <?php echo ($category == 'Merchandise') ? 'active' : ''; ?>" href="index.php?category=Merchandise">周邊</a>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form class="input-group" action="index.php" method="GET">
                            <input type="text" class="form-control" name="keyword" placeholder="輸入..." value="<?php echo htmlspecialchars($keyword); ?>">
                            <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">搜尋</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
            if((isset($_SESSION['role']) && $_SESSION['role'] === 'root')||(isset($_SESSION['role']) && $_SESSION['role'] === 'seller'))
            {   
                echo '<div class="container mt-5">';
                    echo '<div class="row justify-content-center">';
                        echo '<div class="col-auto">';
                            echo '<button onclick="window.location.href=\'insert_product.php\'" class="btn btn-success">新增商品</button>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }

            if ($result) {
                echo "<div class='container mt-5'>";
                $count = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($count == 0) {
                        echo "<div class='row mb-3 justify-content-center'>";
                    }
                    echo "<div class='col-4'>";
                        echo "<a class='text-dark' href='product_item.php?id=" . $row['id'] . "'>";
                            echo "<div class='card'>";
                                $imageSrc = $row['image_url'];
                                echo "<img class='card-img-top' style='min-height: 20rem;' src='$imageSrc' alt='Product Image'>";
                                echo "<div class='card-body'>";
                                    echo "<h5 class='card-title'>" . $row['product_name'] . "</h5>";
                                    echo "<p class='card-text'>Price: $" . intval($row['price']) . "</p>";
                                echo "</div>";
                            echo "</div>";
                        echo "</a>";
                    echo "</div>";
                    $count++;
                    if ($count == 2) {
                        echo "</div>";
                        $count = 0;
                    }
                }
                if ($count != 0) {
                    echo "<div class='col-4'></div>";
                    echo "</div>";
                }
                echo "</div>";
                mysqli_free_result($result);
            } else {
                echo "Failed to retrieve data from the database.";
            }

            mysqli_close($link);
        ?>

        </section>

        <div class="cart-btn">
            <a href="<?php echo isset($_SESSION['username']) ? 'cart.php' : '#'; ?>">
                <img src="cart-shopping.png" alt="Shopping Cart" />
            </a>
        </div>
        <script>
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
                var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                if (scrollTop > 20) {
                    document.querySelector('.cart-btn').classList.remove('d-none');
                } else {
                    document.querySelector('.cart-btn').classList.add('d-none');
                }
            }
        </script>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?><?php echo isset($_GET['category']) ? '&category=' . $_GET['category'] : ''; ?><?php echo isset($_GET['keyword']) ? '&keyword=' . $_GET['keyword'] : ''; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?><?php echo isset($_GET['category']) ? '&category=' . $_GET['category'] : ''; ?><?php echo isset($_GET['keyword']) ? '&keyword=' . $_GET['keyword'] : ''; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                
                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?><?php echo isset($_GET['category']) ? '&category=' . $_GET['category'] : ''; ?><?php echo isset($_GET['keyword']) ? '&keyword=' . $_GET['keyword'] : ''; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
