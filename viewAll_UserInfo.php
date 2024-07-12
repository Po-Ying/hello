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
        <h2 class="text-center mb-4">所有註冊使用者</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>名字</th>
                            <th>帳號</th>
                            <th>密碼</th>
                            <th>角色</th>
                            <th>修改區按鈕</th>
                            <th>刪除按鈕</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            // 查詢數據庫獲取所有註冊用戶的信息
                            $query = "SELECT * FROM userinfo";
                            $result = mysqli_query($link, $query);

                            // 檢查是否找到用戶
                            if (mysqli_num_rows($result) > 0) {
                                // 輸出每個用戶的信息
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['account']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                                    echo "<input type='hidden' class='user-id' value='" . htmlspecialchars($row['member_id']) . "'>";
                                    echo "<td>";
                                    echo "<button type='button' class='btn btn-primary modify-account-btn' data-bs-toggle='modal' data-bs-target='#modifyAccountModal' data-user-id='" . htmlspecialchars($row['member_id']) . "'>修改此帳號資訊</button>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<button type='button' class='btn btn-danger del-account-btn' data-bs-toggle='modal' data-bs-target='#delAccountModal' data-user-id='" . htmlspecialchars($row['member_id']) . "'>刪除此帳號</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>目前無註冊使用者</td></tr>";
                            }

                            // 關閉數據庫連接
                            mysqli_close($link);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="modifyAccountModal" tabindex="-1" role="dialog" aria-labelledby="modifyAccountModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyAccountModalLabel">修改帳戶資訊</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- 修改帳戶的表單 -->
                        <form action="rootChangeUserInfo.php" method="POST">
                            <div class="form-group">
                                <label for="newUsername">修改使用者名稱</label>
                                <input type="text" class="form-control" id="newUsername" name="newUsername" placeholder="新的使用者名稱">
                            </div>
                            <div class="form-group">
                                <label for="newEmail">修改信箱帳號</label>
                                <input type="email" class="form-control" id="newEmail" name="newEmail" placeholder="輸入新的信箱帳號">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">修改密碼</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="輸入新的密碼">
                            </div>
                            <div class="form-group">
                                <label for="newRole">修改使用者角色</label>
                                <select class="form-control" id="newRole" name="newRole">
                                    <option value="buyer">買家</option>
                                    <option value="seller">賣家</option>
                                </select>
                            </div>
                            <input type="hidden" id="modifyMemberIdInput" name="modifyMemberIdInput">
                            <button type="submit" class="btn btn-primary">確認</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delAccountModal" tabindex="-1" role="dialog" aria-labelledby="delAccountModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delAccountModalLabel">刪除帳戶</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- 刪除帳戶的表單 -->
                        <form action="rootDeleteUser.php" method="POST">
                            <div class="text-center"><h3 class="modal-title my-4">確定要刪除此帳號嗎？</h3>
                                <img src="delete-friend.png" class="rounded my-4" style="width: 100px;height: 100px;"alt="removeTeamMember?"></div>
                            <input type="hidden" id="deleteMemberIdInput" name="deleteMemberIdInput">
                            <button type="submit" class="btn btn-danger">確定刪除</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var modifyButtons = document.querySelectorAll('.modify-account-btn');
                var delButtons = document.querySelectorAll('.del-account-btn');

                modifyButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        var userId = button.getAttribute('data-user-id');
                        var modifyInput = document.getElementById('modifyMemberIdInput');
                        if (modifyInput) {
                            modifyInput.value = userId;
                        }
                    });
                });

                delButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        var userId = button.getAttribute('data-user-id');
                        var deleteInput = document.getElementById('deleteMemberIdInput');
                        if (deleteInput) {
                            deleteInput.value = userId;
                        }
                    });
                });
            });
        </script>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
