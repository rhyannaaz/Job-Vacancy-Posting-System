<!DOCTYPE html>
<html lang="en">
<head>
 <title>Post | Job Vacancy Posting</title>
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
      <li><a href="postjobform.php" class="active">Post</a></li>
      <li><a href="searchjobform.php">Search</a></li>
      <li><a href="about.php">About</a></li>
    </ul>
  </nav>

<?php

  // If a user just entered this url, redirect them to the post form
  if (!isset($_POST["postBtn"])) {
    header("location:postjobform.php");
    exit();
  }

  // Initialize value for each data
  $errorMsg = "";
  $positionID = "";
  $title = "";
  $description = "";
  $date = "";
  $position = "";
  $contract = "";
  $application=  array();
  $location = "";

  // Validate Position ID
  if (isset($_POST["positionid"]) && $_POST["positionid"] != "" ) {
    $positionID = $_POST["positionid"];
    if (strlen($positionID) != 5) { // check if position ID length is not equal to 5 characters
      $errorMsg .= "<p>Position ID must be 5 characters in length.</p>\n<br>";
    }
    if (!preg_match("/[P]{1}\d{4}/", $positionID)) { // check if position ID matches pattern
      $errorMsg .= "<p>Position ID must start with capital P followed by 4 digits.</p>\n<br>";
    }
  } else { // check if field is empty, display error message
    $errorMsg .= "<p>Please enter a position ID.</p>\n<br>";
  }

  // Validate Job Title
  if (isset($_POST["title"]) && $_POST["title"] != "" ) {
    $title = $_POST["title"];
    if (strlen($title) > 20) { // check if title length is more than 20
      $errorMsg .= "<p>Title must be between 1 and 20 characters in length.</p>\n<br>";
    }
    if (!preg_match("/^[a-zA-Z0-9,.! ]{1,20}$/", $title)) { // check if title matches pattern
      $errorMsg .= "<p>Title must only contain a maximum of 20 alphanumeric characters
    including spaces, comma, period (full stop), and exclamation point.</p>\n<br>";
    }
  } else { // check if field is empty, display error message
    $errorMsg .= "<p>Please enter a job title.</p>\n<br>";
  }

  // Validate Description
  if (isset($_POST["description"]) && $_POST["description"] != "" ) {
    $description = $_POST["description"];
    if (strlen($description) > 260) { // check if description length is more than 260 characters
      $errorMsg .= "<p>Description must be no more than 260 characters in length.</p>\n<br>";
    }
  } else { // check if field is empty, display error message
    $errorMsg .= "<p>Please enter a description.</p>\n<br>";
  }

  // Validate Date
  if (isset($_POST["date"]) && $_POST["date"] != "" ) {
    $date = $_POST["date"];
    if (!preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{2}$/", $date)) {
      $errorMsg .= "<p>Please enter a valid date with the format: dd/mm/yy.</p>\n<br>";
    }
  } else { // check if field is empty, display error message
    $errorMsg .= "<p>Please choose a closing date.</p>\n<br>";
  }

  // Validate Position
  if (isset($_POST["position"]) && $_POST["position"] != "" ) {
    $position = $_POST["position"];
  } else { // check if field is empty, display error message
    $errorMsg .= "<p>Please choose a position.</p>\n<br>";
  }

  // Validate Contract
  if (isset($_POST["contract"]) && $_POST["contract"] != "" ) {
    $contract = $_POST["contract"];
  } else { // check if field is empty, display error message
    $errorMsg .= "<p>Please choose a contract.</p>\n<br>";
  }

  // Validate Application
  if ((isset($_POST["application1"]) && !empty($_POST["application1"])) || (isset($_POST["application2"]) && !empty($_POST["application2"]))) {
    if (empty($_POST["application1"])) { // check if application1 is empty
      $application1 = " "; // initialize application1 as " "
    } else { // if application1 is not empty
      $application1 = $_POST["application1"];
    }

    if (empty($_POST["application2"])) { // check if application2 is empty
      $application2 = " "; // initialize application2 as " "
    } else { // if application2 is not empty
      $application2 = $_POST["application2"];
    }
  } else { // check if field is empty, display error message
    $errorMsg .= "<p>Please tick any application.</p>\n<br>";
  }

  // Validate Location
  if (isset($_POST["location"]) && $_POST["location"] != "" ) {
    $location = $_POST["location"];
    if ($location == "---") { // check if field is left as default value
      $errorMsg .= "<p>Please choose a location.</p>\n<br>";
    }
  } else { // check if field is empty, display error message
    $errorMsg .= "<p>Please choose a location.</p>\n<br>";
  }

  if ($errorMsg != "") {   // display error message
    echo ("<fieldset>
      <legend>POST JOB FORM ERRORS</legend>
      <form>
      $errorMsg
      <br><br>
      <p><a href='postjobform.php'>Return to form</a><br>
      <a href='index.php'>Return to homepage</a></p>
      </form>
      </fieldset>");
  } else { // no error, save data to file
    $filename = "../../data/jobposts/jobs.txt";
    $dir = "../../data/jobposts";
    if(!(file_exists($dir))) { // if file directory does not exist, create directory with permission to access.
      umask(0007);
      mkdir($dir, 02770);
    }

    if (file_exists($filename)) {                     // if file exists, read file
      $IDdata = array();                              // create an empty array
      $handle = fopen($filename, "r");                // open file in read mode
      while (!feof($handle)) {                        // loop while not end of file
        $oneData = fgets($handle);                    // read a line from the text file
        if ($oneData != "" ) {
          $data = explode("\t",  $oneData);           // explode string to array
          $IDdata[] = $data[0];                       // create a string element
        }
      }
      fclose($handle); // close the text file
      $newdata = (!(in_array($positionID, $IDdata))); // position ID does not exists in array
    } else {
      $newdata = true;    // position ID does not exists, thus it must be a new data
    }
    if ($newdata) { // check if it is a new data being entered
      $handle = fopen($filename, "a"); // open text file in append mode
      $contents = $positionID ."\t". $title ."\t" . $description ."\t". $date ."\t" . $position
      ."\t". $contract ."\t" .  $application1 . "\t" .  $application2 . "\t" . $location . "\n";

      fputs($handle, $contents); // insert content into file
      fclose($handle); // close file
      echo "<fieldset>
        <legend>POST JOB FORM CONFIRMATION</legend>
        <form>
        <p>Successfully saved information into file!</p>
        <br><br>
        <p><a href='postjobform.php'>Post another job vacancy</a><br>
        <a href='index.php'>Return to homepage</a></p>
        </form>
        </fieldset>";
    } else { // if it is not a new data and there are duplicates
      echo "<fieldset>
      <legend>POST JOB FORM ERROR</legend>
      <form>
      <p>Duplicate Postion ID found. Please use a different Position ID.</p>
      <br><br>
      <p><a href='postjobform.php'>Return to form</a><br>
      <a href='index.php'>Return to homepage</a></p>
      </form>
      </fieldset>";
    }
  }

?>

</body>
</html>
