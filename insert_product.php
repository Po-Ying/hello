<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require 'hd.php';
    ?>
</head>

<body>
    <?php
        require 'header.php';
    ?>

    <section class="container mt-5">
        <h2 class="text-center mb-4">添加商品</h2>

        <form action="insertProduct.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="image" class="form-label">商品圖片:</label>
                <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
                <div class="invalid-feedback">請選擇商品圖片。</div>
            </div>

            <div class="mb-3">
                <label for="product_name" class="form-label">商品名稱:</label>
                <input type="text" class="form-control" name="product_name" id="product_name" required>
                <div class="invalid-feedback">請輸入商品名稱。</div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">商品內文:</label>
                <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
                <div class="invalid-feedback">請輸入商品內文。</div>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">價格:</label>
                <input type="number" class="form-control" name="price" id="price" required>
                <div class="invalid-feedback">請輸入價格。</div>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">產品種類:</label>
                <select class="form-select" name="category" id="category" required>
                    <option value="Jerseys">球衣</option>
                    <option value="T_shirts">T_shirt</option>
                    <option value="Basketball">籃球</option>
                    <option value="Accessories">配飾</option>
                    <option value="Merchandise">周邊</option>
                </select>
                <div class="invalid-feedback">請選擇產品種類。</div>
            </div>

            <button type="submit" class="btn btn-primary">加入商品</button>
        </form>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>
