<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PYGOGO</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="Pylogo.png">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <?php
            require 'header.php';
        ?>
        <?php    
            // 连接数据库
            // 检查用户是否已登录
            if (!isset($_SESSION['username'])) {

                // header("Location: login.php");
                echo "<script>window.location.href='login.php'</script>";
                exit();
            }

            // 获取用户信息
            $username = $_SESSION['username'];

            // 查询数据库以获取用户的其他信息，例如邮箱和角色
            $query = "SELECT account, role , password FROM userinfo WHERE username = ?";
            $stmt = $link->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($account, $role, $password);
            $stmt->fetch();
            $stmt->close();

            $passwordLength = strlen($password);
            
            $maskedPassword = str_repeat("*", $passwordLength);

            
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
                            <img class="pd img-fluid" src="acma.png" alt="pd_detail">
                        </div>
                        <div class="col-2"></div> <!-- 这里是一个占位列，保持對齊 -->
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
                                echo '<button onclick="window.location.href=\'viewAll_UserInfo.php\'" class="btn btn-success">檢視所有使用者</button>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            ?>
                
            
            <div class="container mt-5">
                <p><strong>使用者名稱:</strong> <?php echo $username; ?></p>
                <p><strong>信箱:</strong> <?php echo $account; ?></p>
                <p><strong>密碼:</strong><?php echo $maskedPassword; ?></p> <!-- 模糊显示密码 -->
                <p><strong>角色:</strong> <?php echo $role; ?></p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifyAccountModal">修改帳號資訊</button> <!-- 提供修改账户信息的按钮 -->
                <button type="button" class="btn btn-danger" id="deleteAccountBtn">刪除帳號</button>

            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var deleteAccountBtn = document.getElementById('deleteAccountBtn');
                    if (deleteAccountBtn) {
                        deleteAccountBtn.addEventListener('click', function() {
                            // 发送 AJAX 请求到服务器来删除用户账户
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', 'delete_user.php', true);
                            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                            xhr.onload = function() {
                                if (xhr.status == 200) {
                                    // 如果删除成功，重新加载页面或者执行其他操作
                                    alert('帳號已刪除成功，將自動導至登入畫面');
                                        // 如果用户点击了确认，则重定向到登录页面
                                        window.location.href = 'login.php';
                                    
                                    
                                } else {
                                    // 处理删除失败的情况
                                    console.error('删除失败：' + xhr.responseText);
                                }
                            };
                            xhr.send();
                        });
                    }
                });
            </script>

        </section>
 
        <div class="modal fade" id="modifyAccountModal" tabindex="-1" role="dialog" aria-labelledby="modifyAccountModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyAccountModalLabel">修改帳戶資訊（如需改變角色，請聯絡管理員）</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- 修改帳戶的表單 -->
                        <form action="change_userinfo.php" method="POST">
                            <div class="form-group">
                                <label for="newUsername">新的使用者名稱</label>
                                <input type="text" class="form-control" id="newUsername" name="newUsername" placeholder="新的使用者名稱">
                            </div>
                            <div class="form-group">
                                <label for="newEmail">新的信箱帳號</label>
                                <input type="email" class="form-control" id="newEmail" name="newEmail" placeholder="輸入新的信箱帳號">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">新的密碼</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="輸入新的密碼">
                            </div>

                            <button type="submit" class="btn btn-primary">確認</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    </body>
</html>
