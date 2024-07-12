<!DOCTYPE html>
<html lang="en">
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
                <div class="row justify-content-center align-items-center mx-auto">
                    <div class="col-2">
                        <img class="pd img-fluid" src="reg.png" alt="註冊">
                    </div>
                </div>
            </div>
        </section>

    <div class="container">
        <h2 class="mb-4"></h2>
        <form action="rb.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">使用者信箱：</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">使用者密碼：</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">使用者名稱：</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">使用者角色：</label>
                <select class="form-select" id="role" name="role">
                    <option value="buyer">買方</option>
                    <option value="seller">賣方</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-success">註冊</button>
                <button type="button" class="btn btn-primary float-end" onclick="window.location.href='login.php'">回到登入頁</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

</body>
</html>


