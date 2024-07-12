<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require 'hd.php';
    ?>

    <!-- Custom CSS -->
    <style>
        body {
            overflow: hidden;
        }
        #video-background {
            position: fixed;
            right: 0;
            top:0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1000;
        }
        #login-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: rgba(255, 255, 255,1);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        #login-container input {
            width: 100%;
            margin-bottom: 10px;
        }
        #login-container button {
            width: 100%;
        }

        .video-container {
            position: relative;
            top: 50px; /* 調整這個數值以適應你的導覽列高度 */
        }
    </style>

</head>
    <body>

        <?php
            require 'header.php'
        ?>
        <div class="video-container">
            <video id="video-background" autoplay muted loop>
                <source src="Pyvideo.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>


        <div id="login-container" class="container col-md-4">
            <h2>登入</h2>
            <form action="lg.php" method="POST">
                <div class="mb-3">
                    <input type="email" class="form-control" name="account" placeholder="使用者信箱" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="密碼" required>
                </div>
                <div>
                    <span>尚未註冊嗎?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>
                    <a href="register.php" class="text-success mouseOverReg" >註冊PyGOGO</a>
                </div>
                <div>    
                    <button type="submit" class="btn btn-primary">登入</button>
                </div>
            </form>
        </div>

        <!-- Bootstrap JS Bundle -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
