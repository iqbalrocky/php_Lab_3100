<?php

// The value of the variable name is found

  if($_GET["course"] == "C Programming") {
    include('connection.php');
    $query = mysqli_query($dbc, "SELECT * FROM `course` WHERE `CourseName` = '".$_GET["course"]."'");
    $numrows = mysqli_num_rows($query);
    if ($numrows != 0) {
				$queryResult = mysqli_fetch_array($query);
        $query = mysqli_query($dbc, "SELECT * FROM `chapter` WHERE `Course_Id` = ".$queryResult['Course_Id']);
        $numrows = mysqli_num_rows($query);
        if ($numrows > 0) {
            while ($queryResult = mysqli_fetch_array($query)) {
              echo "<h3>".$queryResult['ChapterName']."</h3>";

              $queryChapter = mysqli_query($dbc, "SELECT * FROM `post` WHERE `Chapter_Id` = ".$queryResult['Chapter_Id']);
              $numrowsChapter = mysqli_num_rows($query);
              if ($numrowsChapter > 0) {
                while ($queryResultChapter = mysqli_fetch_array($queryChapter)) {
                  echo "<h4>".$queryResultChapter['Title']."</h4>";
                }
              }
            }


        }
			}
  }
?>
