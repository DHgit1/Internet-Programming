<?php
  $backgroundImage = "img/sea.jpg";
  if (isset($_GET['keyword'])) { //if form was submitted
      include 'api/pixabayAPI.php';
      echo "<div id='title'>";
      echo "<h2>You searched for: " . $_GET['keyword'] . "</h2>";
      echo "</div>";
      $orientation = "horizontal";
      $keyword = $_GET['keyword'];
      if (isset($_GET['layout'])) {  //user checked a layout
        $orientation = $_GET['layout'];
      }
      if (!empty($_GET['category'])) { //user selected a category
        $keyword = $_GET['category'];
      }
      $imageURLs = getImageURLs($keyword, $orientation);
      $backgroundImage = $imageURLs[array_rand($imageURLs)];
  }
      function checkCategory($category){
        if($category == $_GET['category']){
            echo " selected";
      }
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Lab 4: Pixabay Carousel </title>
    </head>
    <style>
        @import url("https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css");
        @import url("css/styles.css");
        body {
            background-image: url(<?=$backgroundImage?>);
            background-size: cover; 
            background-repeat: no-repeat;
        }
    </style>
    <body>
        <?php
            if (!isset($_GET['keyword'])) {
              echo "<div id='title'>";
              echo "<h2> You must type a keyword or select a category </h2>";
              echo "</div>";
            }  
        ?>
        <form method="GET">
            <input type="text" size="20" name="keyword" placeholder="Keyword to search for" value="<?=$_GET['keyword']?>"/>
            <br>
            <div id='rb'>
            <input type="radio" name="layout" value="horizontal" id="hlayout"
            <?php
               if ($_GET['layout'] == "horizontal") {
                 echo "checked";
               }
            ?> >
            <label for="hlayout"> Horizontal </label>
            <input type="radio" name="layout" value="vertical" id="vlayout" <?= ($_GET['layout']=="vertical")?"checked":"" ?>>
            <label for="vlayout"> Vertical </label>
            </div>
            <select name="category">
              <option value="">  Select One </option> 
              <option value="sea" <?=checkCategory('sea')?>>  Ocean </option>
              <option <?=checkCategory('Forest')?>>  Forest </option>
              <option <?=checkCategory('Sky')?>>  Sky </option>
            </select>
            <input type="submit" value="Submit!"/>
        </form>
        <?php
           if (isset($_GET['keyword'])) {
        ?>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <?php
                  for($i = 1; $i < 7; $i++){ ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i?>"></li>
                <?php } ?>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="<?=$imageURLs[0]?>" alt="First slide">
                </div>
                <?php
                  for($i = 1; $i < 7; $i++){ ?>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="<?=$imageURLs[$i]?>" alt="Second slide">
                  </div>
                <?php } ?>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
        </div>
        <?php
            }
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>