<?php
    require 'db.php';
?>

<header class="header shadow-sm">     
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-2">
                        <a href="index.php"><img src="Pylogo.png" alt="PY logo" /></a>
                    </div>
                    <div class="col-3 align-items-end">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            球隊
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                            <a class="dropdown-item" href="team.php?team=braves">
                            <div class="d-flex">
                            <div class="lead text-muted pt-1">
                            <img src="https://d36fypkbmmogz6.cloudfront.net/upload/p_team/logo_1_1605758005.png" />
                            </div>
                            <div class="ml-2">
                            <b class="d-block text-black text-heading">臺北富邦勇士</b><small class="d-block text-muted">隊員名單</small>
                            </div>
                            </div>
                            </a>
                            </li><li class="dropdown-divider"></li> <li>
                            <a class="dropdown-item" href="team.php?team=kings">
                            <div class="d-flex">
                            <div class="lead text-muted pt-1">
                            <img src="https://d36fypkbmmogz6.cloudfront.net/upload/p_team/logo_5_1632361561.png" />
                            </div>
                            <div class="ml-2">
                            <b class="d-block text-black text-heading">新北國王</b><small class="d-block text-muted">隊員名單</small>
                            </div>
                            </div>
                            </a>
                            </li><li class="dropdown-divider"></li> <li>
                            <a class="dropdown-item" href="team.php?team=pilots">
                            <div class="d-flex">
                            <div class="lead text-muted pt-1">
                            <img src="https://d36fypkbmmogz6.cloudfront.net/upload/p_team/logo_2_1665046121.png" />
                            </div>
                            <div class="ml-2">
                            <b class="d-block text-black text-heading">桃園璞園領航猿</b><small class="d-block text-muted">隊員名單</small>
                            </div>
                            </div>
                            </a>
                            </li><li class="dropdown-divider"></li> <li>
                            <a class="dropdown-item" href="team.php?team=lioneers">
                            <div class="d-flex">
                            <div class="lead text-muted pt-1">
                            <img src="https://d36fypkbmmogz6.cloudfront.net/upload/p_team/logo_3_1703055256.png" />
                            </div>
                            <div class="ml-2">
                            <b class="d-block text-black text-heading">新竹御頂攻城獅</b><small class="d-block text-muted">隊員名單</small>
                            </div>
                            </div>
                            </a>
                            </li><li class="dropdown-divider"></li> <li>
                            <a class="dropdown-item" href="team.php?team=dreamers">
                            <div class="d-flex">
                            <div class="lead text-muted pt-1">
                            <img src="https://d36fypkbmmogz6.cloudfront.net/upload/p_team/logo_4_1693553032.png" />
                            </div>
                            <div class="ml-2">
                            <b class="d-block text-black text-heading">福爾摩沙夢想家</b><small class="d-block text-muted">隊員名單</small>
                            </div>
                            </div>
                            </a>
                            </li><li class="dropdown-divider"></li> <li>
                            <a class="dropdown-item" href="team.php?team=steelers">
                            <div class="d-flex">
                            <div class="lead text-muted pt-1">
                            <img src="https://d36fypkbmmogz6.cloudfront.net/upload/p_team/logo_5_1665644838.png" />
                            </div>
                            <div class="ml-2">
                            <b class="d-block text-black text-heading">高雄17直播鋼鐵人</b><small class="d-block text-muted">隊員名單</small>
                            </div>
                            </div>
                            </a>
                            </li> 
                        </ul>
                        </div>
                    </div>
                    <div class="col-3 align-items-end">
                        <a href="index.php">商品</a>
                    </div>
                    <div class="col-3 align-items-end">

                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                購票
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                            <a class="dropdown-item" href="https://tix.fubonbraves.com/">
                            <div class="d-flex">
                            <div class="lead text-muted pt-1">
                            <img src="https://d36fypkbmmogz6.cloudfront.net/upload/p_team/logo_1_1605758005.png" />
                            </div>
                            <div class="ml-2">
                            <b class="d-block text-black text-heading">臺北富邦勇士</b>
                            </div>
                            </div>
                            </a>
                            </li><li class="dropdown-divider"></li> <li>
                            <a class="dropdown-item" href="https://newtaipeikings.kktix.cc/events/jry6t35jtui?fbclid=IwAR3t44PJmnIJusVYXJcIK3hpGmicwYwF8qT6v0f-gywAGgDy-zZkth7JNLk">
                            <div class="d-flex">
                            <div class="lead text-muted pt-1">
                            <img src="https://d36fypkbmmogz6.cloudfront.net/upload/p_team/logo_5_1632361561.png" />
                            </div>
                            <div class="ml-2">
                            <b class="d-block text-black text-heading">新北國王</b>
                            </div>
                            </div>
                            </a>
                            </li><li class="dropdown-divider"></li> <li>
                            <a class="dropdown-item" href="https://ticket.ibon.com.tw/ActivityInfo/Details/38020">
                            <div class="d-flex">
                            <div class="lead text-muted pt-1">
                            <img src="https://d36fypkbmmogz6.cloudfront.net/upload/p_team/logo_2_1665046121.png" />
                            </div>
                            <div class="ml-2">
                            <b class="d-block text-black text-heading">桃園璞園領航猿</b>
                            </div>
                            </div>
                            </a>
                            </li><li class="dropdown-divider"></li> <li>
                            <a class="dropdown-item" href="https://tinyurl.com/7adubra6">
                            <div class="d-flex">
                            <div class="lead text-muted pt-1">
                            <img src="https://d36fypkbmmogz6.cloudfront.net/upload/p_team/logo_3_1703055256.png" />
                            </div>
                            <div class="ml-2">
                            <b class="d-block text-black text-heading">新竹御頂攻城獅</b>
                            </div>
                            </div>
                            </a>
                            </li><li class="dropdown-divider"></li> <li>
                            <a class="dropdown-item" href="https://ticket.ibon.com.tw/Index/Sport">
                            <div class="d-flex">
                            <div class="lead text-muted pt-1">
                            <img src="https://d36fypkbmmogz6.cloudfront.net/upload/p_team/logo_4_1693553032.png" />
                            </div>
                            <div class="ml-2">
                            <b class="d-block text-black text-heading">福爾摩沙夢想家</b>
                            </div>
                            </div>
                            </a>
                            </li><li class="dropdown-divider"></li> <li>
                            <a class="dropdown-item" href="https://ticket.ibon.com.tw/ActivityInfo/Details/38003">
                            <div class="d-flex">
                            <div class="lead text-muted pt-1">
                            <img src="https://d36fypkbmmogz6.cloudfront.net/upload/p_team/logo_5_1665644838.png" />
                            </div>
                            <div class="ml-2">
                            <b class="d-block text-black text-heading">高雄17直播鋼鐵人</b>
                            </div>
                            </div>
                            </a>
                            </li> 
                        </ul>
                        </div>
                    </div>
                    <div class="col-1 text-end position-relative">
                        <div class="user-card d-none position-absolute top-100 start-0 mt-2">
                            <div class="card" style="width: 8rem; height: auto;" onmouseover="showUserCard()" onmouseout="hideUserCard()">
                                <div class="card-body">
                                    <p class="card-title text-dark"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : '使用者'; ?></p>
                                    <div class="mt-2"> 
                                    <a href="lg.php<?php echo isset($_SESSION['username']) ? '?logout=1' : '?logout=0'; ?>" class="card-link text-dark">
                                        <?php echo isset($_SESSION['username']) ? '登出' : '登入'; ?>
                                    </a>
                                    </div> 
                                </div>
                            </div>
                        </div>
                            <a href="user_account.php" class="d-inline-block small-icon" onmouseover="showUserCard()" onmouseout="hideUserCard()">
                            <img src="people.png" alt="Account" />
                        </a>
                    </div>
                </div>
            </div>
            
            <script>
                function showUserCard() {
                    document.querySelector('.user-card').classList.remove('d-none');
                }

                function hideUserCard() {
                    document.querySelector('.user-card').classList.add('d-none');
                }
            </script>
        </header>

