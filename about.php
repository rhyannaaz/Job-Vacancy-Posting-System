<!DOCTYPE html>
<html lang="en">
<head>
 <title>About | Job Vacancy Posting</title>
  <meta charset="utf-8">
  <meta name="description" content="COS30020 Assignment 1">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="author" content="Rhyanna Arisya Zaharom">
  <link href="style.css" rel="stylesheet" />
  <link href="style/icon.png" rel="icon" type="image/gif" sizes="20x20" />
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
      <li><a href="searchjobform.php">Search</a></li>
      <li><a href="about.php" class="active">About</a></li>
    </ul>
  </nav>

  <fieldset class="about">
    <legend>ABOUT THE ASSIGNMENT</legend>
    <form>
      <ol>
       <li>What is the PHP version installed in mercury?
         <br><br>The PHP version installed in mercury is <?php echo phpversion(); // display version of php?>.
       </li>
       <br>

       <li>What tasks you have not attempted or not completed?
         <br><br>I have attempted and completed all except Task 8(a) Properly sort the result which I have attempted but not completed.
       </li>
       <br>

       <li>What special features have you done, or attempted, in creating the
         site that we should know about?
         <br><br>
         <ul>
           <li>Active navigation bar.</li>
           <li>Regex validation.</li>
           <li>Incorporated favicon for all pages.</li>
           <li>Deny access to 'postjobprocess.php' and 'searchjobprocess.php' pages without going through the form pages.</li>
         </ul>
       </li>
       <br>

       <li>What discussion points did you participated on in the unit’s discussion
         board for Assignment 1? If you did not participate, state your reason.
         <br><br>I did not participate in the unit's discussion board. This is because I believe the requirements
         of this assignment has been clarified in detail by the lecturer and the tutor during classes.
         <br><br>
         <img src="style/discussion.png" id="discussionss" alt="Screenshot of a discussion">
         <br>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <i>Screenshot of Discussion I Did Not Participate</i>
       </li>

     </ol>
   </form>
 </fieldset>
 <br><br>

</body>
</html>
