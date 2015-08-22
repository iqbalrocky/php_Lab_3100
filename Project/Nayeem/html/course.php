<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rapid Learning</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <style>
  #section1 {color: #fff; background-color: #1E88E5;}
  #section2 {color: #fff; background-color: #673ab7;}
  #section3 {color: #fff; background-color: #ff9800;}
  #section41 {color: #fff; background-color: #00bcd4;}
  #section42 {color: #fff; background-color: #009688;}


  .nav-pills > li.active > a, .nav-pills > li.active > a:focus {
        color: black;
        background-color: #fcd900;
    }

        .nav-pills > li.active > a:hover {
            background-color: #efcb00;
            color:black;
        }
  </style>
</head>
<body>

<div class="container">
  <div style="background-color:#2196F3;color:#fff;height:200px;">
    <?php
      if($_GET["course"] == "C Programming") {
        include('connection.php');
        $queryCourse = mysqli_query($dbc, "SELECT * FROM `course` WHERE `CourseName` = '".$_GET["course"]."'");
        $numrowsCourse = mysqli_num_rows($queryCourse);
        if ($numrowsCourse > 0) {
    				$queryResultCourse = mysqli_fetch_array($queryCourse);
            echo "<h2>".$queryResultCourse['CourseName']."</h2>";
            echo "<p>".$queryResultCourse['Description']."</p>";
            $queryChapter = mysqli_query($dbc, "SELECT * FROM `chapter` WHERE `Course_Id` = ".$queryResultCourse['Course_Id']);
            $numrowsChapter = mysqli_num_rows($queryChapter);
          }
        }
    ?>
  </div>
  <div class="row">
    <nav class="col-sm-3">
      <ul class="nav nav-pills nav-stacked">
        <?php
        if ($numrowsChapter > 0) {
          while ($queryResultChapter = mysqli_fetch_array($queryChapter)) {
            echo "<li><h3>".$queryResultChapter['ChapterName']."</h3></li>";
            $queryPost = mysqli_query($dbc, "SELECT * FROM `post` WHERE `Chapter_Id` = ".$queryResultChapter['Chapter_Id']);
            $numrowsPost = mysqli_num_rows($queryPost);
            if ($numrowsPost > 0) {
              $indexFotPost = 0;
              while ($queryResultPost = mysqli_fetch_array($queryPost)) {

                if ($indexFotPost == 0) {
                  echo "<li class=\"active\" ><a href=\"#section".$indexFotPost."\" data-toggle=\"pill\">";
                  $indexFotPost++;
                } else {
                  echo "<li><a href=\"#section".$indexFotPost."\" data-toggle=\"pill\">";
                }
                echo "<h4>".$queryResultPost['Title']."</h4>";
                echo "</a></li>";
              }
            }


          }
        }
        ?>
      </ul>
    </nav>
    <div class="col-sm-9 tab-content">
      <?php
        for($index = 1 ; $index <= $numrowsPost ; $index++) {
          // echo "<div id=\"section".$index."\" class=\"tab-pane fade in active\">";
          echo "<div id=\"section1\" class=\"tab-pane fade in active\">";
          $queryDocument = mysqli_query($dbc, "SELECT * FROM `Document` WHERE `Post_Id` = 1");
          $numrowsDocument = mysqli_num_rows($queryDocument);
          if ($numrowsDocument > 0) {
            while ($queryResultDocument = mysqli_fetch_array($queryDocument)) {
              echo "<h1>".$queryResultDocument['Title']."</h1>";
              echo "<p>".$queryResultDocument['FullDocument']."</p>";
            }
          }
          echo "</div>";
        }
      ?>

      <!-- </div> -->
      <!-- <div id="section2" class="tab-pane fade">
        <h1>Section 2</h1>
        <p>Try to scroll this section and look at the navigation list while scrolling!</p>
      </div>
      <div id="section3" class="tab-pane fade">
        <h1>Section 3</h1>
        <p>Try to scroll this section and look at the navigation list while scrolling!</p>
      </div> -->
    </div>
  </div>
</div>

</body>
</html>
