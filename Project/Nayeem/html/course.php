<?php
  session_start();
?>
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
    .tab-pane {color: #000; background-color: #fff;}


    .nav-pills > li.active > a, .nav-pills > li.active > a:focus {
        color: black;
        background-color: #fcd900;
    }

    .nav-pills > li.active > a:hover {
        background-color: #efcb00;
        color:black;
    }

    .jumbotron {
        padding: 2em 1em;
        min-height: 200px;
        background-color: #2196F3 ;
        color:#fff ;
    }
  </style>
</head>
<body>
<?php
  include('connection.php');
  if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $CourseName =  mysqli_real_escape_string($dbc,trim($_POST['course']));
    $_SESSION["course"] = $CourseName;
  }
  else if (!empty($_SESSION["course"])){
    $CourseName = $_SESSION["course"];
  }
  else {
    header("location:index.html");
  }
?>
<div class="container-fluid">
  <div class="jumbotron">
    <?php
        $queryCourse = mysqli_query($dbc, "SELECT * FROM `course` WHERE `CourseName` = '".$CourseName."'");
        $numrowsCourse = mysqli_num_rows($queryCourse);
        if ($numrowsCourse > 0) {
    				$queryResultCourse = mysqli_fetch_array($queryCourse);
            echo "<h2>".$queryResultCourse['CourseName']."</h2>";
            echo "<p><small>".$queryResultCourse['Description']."</small></p>";
        } else {
            header("location:index.html");
        }
    ?>
  </div>
  <div class="row">
    <nav class="col-sm-3">
      <ul class="nav nav-pills nav-stacked">
        <?php
        $queryChapter = mysqli_query($dbc, "SELECT * FROM `chapter` WHERE `Course_Id` = ".$queryResultCourse['Course_Id']);
        $numrowsChapter = mysqli_num_rows($queryChapter);
        if ($numrowsChapter > 0) {
          $chapterIndex = 0;
          while ($queryResultChapter = mysqli_fetch_array($queryChapter)) {
            $chapterIndex++;
            echo "<li><h3>".$queryResultChapter['ChapterName']."</h3></li>";
            $queryPost = mysqli_query($dbc, "SELECT * FROM `post` WHERE `Chapter_Id` = ".$queryResultChapter['Chapter_Id']);
            $numrowsPost = mysqli_num_rows($queryPost);
            if ($numrowsPost > 0) {
              $postIndex = 0;
              while ($queryResultPost = mysqli_fetch_array($queryPost)) {
                $postIndex++;
                //echo $chapterIndex.$postIndex;
                if ($postIndex == 1) {
                  echo "<li class=\"active\" ><a href=\"#section".$chapterIndex.$postIndex."\" data-toggle=\"pill\">";
                } else {
                  echo "<li><a href=\"#section".$chapterIndex.$postIndex."\" data-toggle=\"pill\">";
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
        for($indexChapter = 1 ; $indexChapter <= $numrowsChapter ; $indexChapter++) {
          for($indexPost = 1 ; $indexPost <= $numrowsPost ; $indexPost++) {
            // echo "<div id=\"section".$index."\" class=\"tab-pane fade in active\">";
            echo "<div id=\"section".$indexChapter.$indexPost."\" class=\"tab-pane fade in active\">";
            //echo $indexChapter.$indexPost;
            $queryDocument = mysqli_query($dbc, "SELECT * FROM `Document` WHERE `Post_Id` = $indexPost");
            $numrowsDocument = mysqli_num_rows($queryDocument);
            if ($numrowsDocument > 0) {
              while ($queryResultDocument = mysqli_fetch_array($queryDocument)) {
                echo "<h2>".$queryResultDocument['Title']."</h2>";
                if ($queryResultDocument['Type'] == 'code') {
                  echo "<pre>".$queryResultDocument['FullDocument']."</pre>";
                } else {
                  echo "<p>".$queryResultDocument['FullDocument']."</p>";
                }
              }
            }
            echo "</div>";
          }
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
