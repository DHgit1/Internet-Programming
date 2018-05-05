<?php
 include 'inc/header.php';
?>
    <style>
        #carouselContainer {
            margin:0 auto;
            background-color: rgba(0, 0, 0, .2);;
        }
    </style>
    <div id="carouselContainer">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-inline w-25" src="img/alex.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-inline w-25" src="img/otter.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-inline w-25" src="img/samantha.jpg" alt="Third slide">
                </div>
                <div class="carousel-item">
                    <img class="d-inline w-25" src="img/tiger.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <br>
    <a href="pets.php" class="btn btn-outline-primary" role="button" aria-pressed="true"> Adopt Now! </a>
    <br>

<?php
    include 'inc/footer.php';
?>