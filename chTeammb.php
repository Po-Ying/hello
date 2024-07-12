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
        <section>
            <?php
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
 
            <div> 
                <?php foreach ($teamMembers as $member): ?>
                <div class="chteammb"> 
                    <img src="<?php echo $member['image_url']; ?>" alt="<?php echo $member['name']; ?>">
                    <span><?php echo $member['name']; ?></span>
                    <span>Position: <?php echo $member['position']; ?></span>
                    <span>Role: <?php echo ucfirst($member['role']); ?></span>
                    <input type="hidden" class="member-id" value="<?php echo htmlspecialchars($member['id']); ?>">
                    <button type="button" class="btn btn-primary modify-btn" data-bs-toggle="modal" data-bs-target="#modifyTeamMbModal">
                        修改此隊員
                    </button>
                    <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#delTeamMbModal">
                        刪除此隊員
                    </button>
                </div>
                <?php endforeach; ?>
            
            </div>
        </section>
        
        <div class="modal fade" id="modifyTeamMbModal" tabindex="-1" role="dialog" aria-labelledby="modifyTeamMbModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyTeamMbModalLabel">修改隊員資訊(若無需改變則輸入原值)</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- 修改商品的表单 -->
                        <form action="ch_teammb.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="newImage">修改隊員圖片(url)</label>
                                <input type="text" class="form-control" id="newImage" name="newImage" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="newName">修改隊員名字</label>
                                <input type="text" class="form-control" id="newName" name="newName" placeholder="輸入新的商品名稱">
                            </div>
                            <div class="form-group">
                                <label for="newPosition">修改隊員職位</label>
                                <textarea class="form-control" id="newPosition" name="newPosition" placeholder="輸入新的商品描述"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="newRole">修改隊員角色</label>
                                <select class="form-control" id="newRole" name="newRole">
                                    <option value="coach">教練</option>
                                    <option value="player">球員</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="newTeam">修改隊伍</label>
                                <select class="form-control" id="newTeam" name="newTeam">
                                    <option value="braves">臺北富邦勇士</option>
                                    <option value="kings">新北國王</option>
                                    <option value="pilots">桃園璞園領航猿</option>
                                    <option value="lioneers">新竹御頂攻城獅</option>
                                    <option value="dreamers">福爾摩沙夢想家</option>
                                    <option value="steelers">高雄17直播鋼鐵人</option>
                                </select>
                            </div>
                            <input type="hidden" id="modifyMemberIdInput" name="memberId">
                            

                            <button type="submit" class="btn btn-primary ">確認</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delTeamMbModal" tabindex="-1" role="dialog" aria-labelledby="delTeamMbModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center"><h3 class="modal-title my-4" id="delTeamMbModalLabel">確定要刪除此隊員嗎？</h3>
                        <img src="remove.png" class="rounded my-4" style="width: 100px;height: 100px;"alt="removeTeamMember?"></div>
                        
                        <form action="del_teammb.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="deleteMemberIdInput" name="memberId">
                            <input type="hidden" id="team" name="team" value="<?php echo $teamName?>">

                            <button type="submit" class="btn btn-danger mt-4">確認</button>
                            <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal">取消</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var teamMembers = document.querySelectorAll('.chteammb');

                teamMembers.forEach(function(member) {
                    var modifyButton = member.querySelector('.modify-btn');
                    var deleteButton = member.querySelector('.delete-btn');

                    modifyButton.addEventListener('click', function() {
                        var memberId = member.querySelector('.member-id').value;
                        document.getElementById('modifyMemberIdInput').value = memberId;
                    });

                    deleteButton.addEventListener('click', function() {
                        var memberId = member.querySelector('.member-id').value;
                        document.getElementById('deleteMemberIdInput').value = memberId;
                    });
                });
            });
        </script>
        

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
