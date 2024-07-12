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
    <div class="container mt-5">
        <h2 class="mb-4">新增球員/教練</h2>
        <form action="insertteammber.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">姓名：</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">職位：</label>
                <input type="text" id="position" name="position" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="image_url" class="form-label">圖片 URL：</label>
                <input type="text" id="image_url" name="image_url" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">角色：</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="coach">教練</option>
                    <option value="player">球員</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="team" class="form-label">所屬隊伍：</label>
                <select id="team" name="team" class="form-select" required>
                    <option value="braves">台北富邦勇士</option>
                    <option value="kings">新北國王</option>
                    <option value="pilots">桃園璞園領航猿</option>
                    <option value="lioneers">新竹御頂攻城狮</option>
                    <option value="dreamers">福爾摩沙夢想家</option>
                    <option value="steelers">高雄17直播鋼鐵人</option>
                </select>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">插入</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
