<!DOCTYPE html>
<html lang="en">
<head>
 <title>Search | Job Vacancy Posting</title>
  <meta charset="utf-8">
  <meta name="description" content="COS30020 Assignment 1">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="author" content="Rhyanna Arisya Zaharom">
  <link href="style.css" rel="stylesheet" />
  <link href="style/icon.png" rel="icon" type="image/gif" sizes="16x16" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
</head>

<body>

  <header>
  	<h1><a href="index.php" class="index" title="Job Vacancy Posting System">JOB VACANCY POSTING SYSTEM</a></h1>
  </header>

  <nav class="navMenu">
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="postjobform.php">Post</a></li>
      <li><a href="searchjobform.php" class="active">Search</a></li>
      <li><a href="about.php">About</a></li>
    </ul>
  </nav>

<?php

  // If a user just entered this url, redirect them to the search form
  if (!isset($_GET["searchBtn"])) {
    header("location:searchjobform.php");
    exit();
  }

  // Initialize value for each data
  $errorMsg = "";
  $title = "";
  $position = "";
  $contract = "";
  $application1 = "";
	$application2 = "";
  $location = "";
  $filename = "../../data/jobposts/jobs.txt";
  $dir = "../../data/jobposts";

  if (isset($_GET["title"]) && $_GET["title"] != "") {
    $title = $_GET["title"];
    if (strlen($title) > 20) { // check if title length is more than 20
      $errorMsg .= "<p>Title must be between 1 and 20 characters in length.</p>\n<b>";
    }
    if (!preg_match("/^[a-zA-Z0-9,.! ]{1,20}$/", $title)) { // check if title matches pattern
      $errorMsg .= "<p>Title must only contain a maximum of 20 alphanumeric characters
    including spaces, comma, period (full stop), and exclamation point.</p>\n<br>";
    }

    if (isset($_GET["position"])) {
      $position = $_GET["position"];
    }

    if (isset($_GET["contract"])) {
      $contract = $_GET["contract"];
    }

    if (isset($_GET["application1"])) {
      $application = $_GET["application1"];
    }

    if (isset($_GET["application2"])) {
      $application = $_GET["application2"];
    }

    if (isset($_GET['location'])) {
      $location = $_GET['location'];
    }

    if ($location = "---") { // if field is left as default value
      $location = "";
    }
  } else { // check if field is empty, display error message
    $errorMsg = "<p>Please enter a job title.</p>";
  }

  if ($errorMsg != "") { // display error message
      echo ("<fieldset>
        <legend>SEARCH JOB FORM ERRORS</legend>
        <form>
        $errorMsg
        <br><br>
        <a href='searchjobform.php'>Return to form</a><br>
        <a href='index.php'>Return to homepage</a>
        </form>
        </fieldset>");
  } else {
		$dateData = array();
    if (file_exists($filename)) {                                       // checks if file exists
      $handle = fopen($filename, "r");                                  // open the file in read mode
      echo "<fieldset><legend> SEARCH JOB FORM RESULTS</legend><form>";
      $dataFound = false;                                               // initialize variable as false before it is found
			while (!feof($handle)) {                                          // if not end of file
				$oneData = fgets($handle);                                      // read a line from the text file
        if ($oneData != "") {                                           // ignore blank lines
          $data = explode("\t",  $oneData);                             // explode string to array
          $dateData[] = $data;
          array_push($dateData, $data);
          if (strpos(strtolower($data[1]), strtolower($title)) !== false) {     // checks if title matches title within array
            $date = date("d/m/y");                                              // set current date
            if ($data[3] >= $date) {                                            // checks if closing date haven't expired
              if ($position == "" || $data[4] === $position) {                  // checks if position matches with position within array
                if ($contract == "" || $data[5] === $contract) {                // checks if contract matches with contract within array
                  if ($application1 == "" || $data[6] === $application1 && $application2 == "" || $data[7] === $application2) { // checks if application by post matches with application within array
                    if ($application2 == "" || $data[7] === $application2 ) {   // checks if application by email matches with application within array
                      if ($location == "" ||  $data[8] === $location) {         // checks if location  matches with location within array
                        $dataFound = true;                                      // if search is found, it will return search results
                        echo "<br><p>Job Title: " . $data[1] . "</br>";
                        echo "Description: " . $data[2] . "</br>";
                        echo "Closing Date: " . $data[3] . "</br>";
                        echo "Position: " . $data[4] . " - " . $data[5] . "</br>";
                        if ($data[6] == " ") {                                  // if application by post is empty within array, dsiplay application by email only
                          echo "Application by: " . $data[7] . "</br>";
                        }
                        if ($data[7] == " ") {                                  // if application by email is empty within array, dsiplay application by post only
                          echo "Application by: " . $data[6] . "</br>";
                        }
                        if ($data[6] != " " && $data[7] != " ") {               // if application by post and email are not empty within array, dsiplay both data
                          echo "Application by: " . $data[6] . ", " . $data[7]. "</br>";
                        }
                        echo "Location: " . $data[8] . "</p></br>";
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
      fclose($handle); // close file
      usort($dateData, "dateCompare");
      if($dataFound == false) {  // if the string search is not found, an error message + link to  home page & search job vacancy
        echo "<p>No Postion Found</p><br><br>";
			}
      echo "<p><a href='searchjobform.php'>Search another job vacancy</a><br>
      <a href='index.php'>Return to homepage</a></p></form></fieldset>";
    } else { // if file des not exists, display error message
      echo "<fieldset>
      <legend>SEARCH JOB FORM ERROR</legend>
      <form>
      <p>File does not exist.</p>
      <br><br>
      <p><a href='searchjobform.php'>Return to form</a><br>
      <a href='index.php'>Return to homepage</a></p>
      </form>
      </fieldset>";
    }
  }

  function dateCompare($a, $b) { // function that compares date for sorting
    $date1 =strtotime($a[3]);
		$date2 =strtotime($b[3]);
		return $date1 - $date2;
  }

?>

</body>
</html>
