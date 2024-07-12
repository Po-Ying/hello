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
                <!-- Add more items as needed -->
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

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
