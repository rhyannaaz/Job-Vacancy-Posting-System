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

  <fieldset>
		<legend>POST JOB VACANCY FORM</legend>
    <form id="postForm" method="POST" action="postjobprocess.php" novalidate>
      <div class="row">
        <div class="column">
          <p><label for="positionid">Position ID:</label></p>
        </div>
        <div class="column">
          <p><input type="text" name="positionid" id="positionid" pattern="[A-Za-z]+"
          size="25"/></p>
        </div>
      </div>
      <br><br>

      <div class="row">
        <div class="column">
          <p><label for="title">Title:</label></p>
        </div>
        <div class="column">
          <p><input type ="text" name="title" id="title" size="25"/></p>
        </div>
      </div>
      <br><br>

      <div class="row">
        <div class="column">
          <p><label for="description">Description:</label></p>
        </div>
        <div class="column">
          <p><textarea id="description" name="description" rows="1" cols="31"></textarea></p>
        </div>
      </div>
      <br><br>

      <div class="row">
        <div class="column">
          <p><label for="date">Closing Date:</label></p>
        </div>
        <div class="column">
          <p><input id="date" name="date" type="text" value="<?php echo date("d/m/y")?>"></input></p>
        </div>
      </div>
      <br><br>

      <div class="row">
        <div class="column">
          <p><label>Position:</label></p>
        </div>
        <div class="column">
          <p><input type="radio" value="Full Time" name="position" id="fulltime"/>
            <label for="fulltime">Full Time</label>
            <input type="radio" value="Part Time" name="position" id="parttime"/>
            <label for="parttime">Part Time</label></p>
        </div>
      </div>
      <br><br>

      <div class="row">
        <div class="column">
          <p><label>Contract:</label></p>
        </div>
        <div class="column">
          <p><input type="radio" value="On-going" name="contract" id="ongoing"/>
            <label for="ongoing">On-going</label>
            <input type="radio" value="Fixed Term" name="contract" id="fixedterm"/>
            <label for="fixedterm">Fixed Term</label></p>
        </div>
      </div>
      <br><br>

      <div class="row">
        <div class="column">
          <p><label>Application By:</label></p>
        </div>
        <div class="column">
          <p><input type="checkbox" value="Post" name="application1" id="post"/>
            <label for="post">Post</label>
            <input type="checkbox" value="Email" name="application2" id="email"/>
            <label for="mail">Email</label></p>
        </div>
      </div>
      <br><br>

      <div class="row">
        <div class="column">
          <p><label for="location">Location:</label></p>
        </div>
        <div class="column">
          <p><select id="location" name="location">
            <option disabled selected value>---</option>
            <option value="ACT">ACT</option>
            <option value="NSW">NSW</option>
            <option value="NT">NT</option>
            <option value="QLD">QLD</option>
            <option value="SA">SA</option>
            <option value="TAS">TAS</option>
            <option value="VIC">VIC</option>
            <option value="WA">WA</option>
          </select></p>
        </div>
      </div>
      <br>

      <button type="reset" class="btn">RESET</button>
      <button type="submit" class="btn" name="postBtn">POST</button>
      <br><br>

      All fields are required. <a href="index.php">Return to homepage</a>

    </form>
  </fieldset>
  <br><br>

</body>
</html>
