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

            // 获取队伍名
            $teamName = $_GET['team']; // 假设 URL 中包含了 team 参数，值为队伍名

            // 查询数据库获取队伍成员信息
            $query = "SELECT * FROM team_member WHERE teams = ?";
            $stmt = $link->prepare($query);
            $stmt->bind_param("s", $teamName);
            $stmt->execute();
            $result = $stmt->get_result();

            // 检查是否找到了对应的队伍
            if ($result->num_rows === 0) {
                echo "目前無此隊伍";
                exit();
            }

            // 获取队伍信息
            $teamMembers = $result->fetch_all(MYSQLI_ASSOC);
        ?>
        <?php

            function getTeamBackgroundColor($teamName) {
                switch ($teamName) {
                    case 'braves':
                        return 'bg-primary'; // 蓝色
                    case 'kings':
                        return 'bg-warning'; // 黄色
                    case 'pilots':
                        return 'bg-orange'; // 橙色
                    case 'lioneers':
                        return 'bg-purple'; // 紫色
                    case 'dreamers':
                        return 'bg-greenn'; // 绿色
                    case 'steelers':
                        return 'bg-danger'; // 红色
                    default:
                        return 'bg-greenn'; // 綠色
                }
            }

            // 假设 $teamName 是你获取到的队伍名称
            $teamName = $_GET['team']; // 这里仅作示例，你可以从数据库或其他地方获取真实的队伍名称
            $backgroundColorClass = getTeamBackgroundColor($teamName);
        ?>
        <section class="bg-deepgray mx-0">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-2">
                        <img class="pd img-fluid" src="team_mb.png" alt="pd_detail">
                    </div>
                </div>
            </div>
        </section>

        <section class="<?php echo $backgroundColorClass; ?> mx-0">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-2">
                        <img class="pd img-fluid" src="<?php echo $teamName; ?>.png" alt="pd_detail">
                    </div>
                </div>
            </div>
        </section>

        <section>
        <?php 
            if(isset($_SESSION['role']) && $_SESSION['role'] === 'root')
            {   
                echo '<div class="container mt-5">';
                    echo '<div class="row justify-content-center">';
                        echo '<div class="col-auto">';
                        echo '<button onclick="window.location.href=\'chTeammb.php?team=' . $teamName . '\'" class="btn btn-primary">修改隊員</button>';                        
                        echo '</div>';
                        echo '<div class="col-auto">';
                        echo '<button onclick="window.location.href=\'team_member_insert.php\'" class="btn btn-success">新增隊員</button>';
                    echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        ?>
        </section>

        <section>
        <div class="container mt-5">
            <div class="row">
                <?php $count = 0; ?>
                <?php foreach ($teamMembers as $member): ?>
                    <?php if ($count % 3 == 0): ?>
                        </div><div class="row mb-3 justify-content-center">
                    <?php endif; ?>
                    <div class="col-md-4 mb-3 d-flex align-items-stretch">
                        <div class="card member d-flex align-items-stretch">
                            <img src="<?php echo $member['image_url']; ?>" class="card-img-top" alt="<?php echo $member['name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $member['name']; ?></h5>
                                <p class="card-text">Position: <?php echo $member['position']; ?></p>
                                <p class="card-text">Role: <?php echo ucfirst($member['role']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php $count++; ?>
                <?php endforeach; ?>
            </div>
        </div>

        </section>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
