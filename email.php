<?php session_start(); ?>
<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

// Allows database credentials to be used from separate file
include($_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/CPSC431Project3/credentials.php');
$uploadOK = true;
$dsn = "mysql:host=$dbServer;dbname=$dbName";

// FEATURE 2) Session Handling. User's input to the form are held in session
if ($_POST) {
  $_SESSION['name'] = $_POST['name'];
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['session'] = $_POST['session'];
  $_SESSION['date'] = $_POST['date'];
  $_SESSION['session_time'] = $_POST['session_time'];
  $_SESSION['location'] = $_POST['location'];
  $_SESSION['details'] = $_POST['details'];
}
?>

<?php
// Setting the POST of user input into data fields into associated variables
if (isset($_POST['submit'])) {

  $clientname = isset($_POST['name']) ? $_POST['name'] : '';
  $emailaddy = isset($_POST['email']) ? $_POST['email'] : '';
  $sessionType = isset($_POST['session']) ? $_POST['session'] : '';
  $sessionDate = isset($_POST['date']) ? $_POST['date'] : '';
  $sessionTime = isset($_POST['session_time']) ? $_POST['session_time'] : '';
  $location = isset($_POST['location']) ? $_POST['location'] : '';
  $projectDetails = isset($_POST['details']) ? $_POST['details'] : '';

  // Inserting client info into database
  try {

    $db = new PDO($dsn, $dbUsername, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // FEATURE 1) Insert image content into database
    $insert = $db->query("INSERT into BookingInfo (Client_Name, Email_Address, Session_Type, Session_Date, Session_Time, 
    Requested_Location, Project_Details) 
          VALUES ('$clientname', '$emailaddy', '$sessionType', '$sessionDate', '$sessionTime', '$location', '$projectDetails')");
  } catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
    echo "failed to send to the database";
  }
  unset($db);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Donavie Photography</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
  <link rel="stylesheet" href="css/color.css" />
</head>

<body>

  <header>
    <h2>Donavie Ordonez Photography</h2>
  </header>

  <div class="container">
    <div class="row">

      <div class="col-md">
        <button type="button" class="btn btn-outline-dark btn-rounded" onclick="window.location.href='home.html'">
          Home
        </button>
      </div>

      <div class="col-md">
        <button type="button" class="btn btn-outline-dark btn-rounded" data-mdb-ripple-color="dark" onclick="window.location.href='contact.html'">
          Contact
        </button>
      </div>

      <div class="col-md">
        <button type="button" class="btn btn-outline-dark btn-rounded" data-mdb-ripple-color="dark" onclick="window.location.href='pricing.html'">
          Pricing & FAQ
        </button>
      </div>

      <div class="col-md">
        <button type="button" class="btn btn-outline-dark btn-rounded" data-mdb-ripple-color="dark" onclick="window.location.href='aboutme.html'">
          About Me
        </button>
      </div>

      <div class="col-md">
        <button type="button" class="btn btn-outline-dark btn-rounded" data-mdb-ripple-color="dark" onclick="window.location.href='portfolio.html'">
          Portfolio
        </button>
      </div>

    </div>
  </div>

  <body class="container">
    <div class="center">
      <h1 class="p1">
        <?php echo 'Thank you ' . $_SESSION['name'] . ' for booking with me!'; ?>
      </h1>

      <!--FEATURE 3) Email: This form will email the user their answers and will email Donavie's photography
      email a copy of the user's submission after selecting the submit button-->
      <form action="https://formsubmit.co/donavie.photographie@gmail.com" method="POST">
        <label class="form-label">Keep a copy of your form submission by selecting the button bellow</label>
        <section>
          <div class="panel panel-default">
            <div class="form-group">
              <label class="form-label">Your Name</label>
              <input type="text" name="name" class="form-control" value="
              <?php echo (isset($_SESSION['name'])) ? htmlspecialchars($_SESSION['name']) : ''; ?>" />
            </div>

            <div class="form-group">
              <label class="form-label">Email Address</label>
              <input type="email" name="email" class="form-control" value="
              <?php echo (isset($_SESSION['email'])) ? htmlspecialchars($_SESSION['email']) : ''; ?>" />
            </div>

            <div class="form-group">
              <label class="form-label">What type of session are you interested in booking? (Fashion, Grad/Senior,
                Family, Couple, Product, Headshot or Other) </label>
              <input type="text" name="session" class="form-control" value="
              <?php echo (isset($_SESSION['session'])) ? htmlspecialchars($_SESSION['session']) : ''; ?>" />
            </div>

            <div class="form-group">
              <label class="form-label">When are you hoping to book for?</label>
              <input type="text" name="date" class="form-control" value="
              <?php echo (isset($_SESSION['date'])) ? htmlspecialchars($_SESSION['date']) : ''; ?>" />
            </div>

            <div class="form-group">
              <label class="form-label">How long of session would you like to do?</label>
              <input type="text" name="session_time" class="form-control" value="
              <?php echo (isset($_SESSION['session_time'])) ? htmlspecialchars($_SESSION['session_time']) : ''; ?>" />
            </div>

            <div class="form-group">
              <label class="form-label">Location</label>
              <input type="text" name="location" class="form-control" value="
              <?php echo (isset($_SESSION['location'])) ? htmlspecialchars($_SESSION['location']) : ''; ?>" />
            </div>

            <div class="form-group">
              <label class="form-label">What is your vision for this project?</label>
              <input type="text" name="details" class="form-control" value="
              <?php echo (isset($_SESSION['details'])) ? htmlspecialchars($_SESSION['details']) : ''; ?>" />
            </div>

            <input type="hidden" name="_autoresponse" value="This is a review of your submission 
                        to book a session with me! Please expect a response within 3-5 business days. Looking forward to 
                        working with you! - Donavie">


            <input type="hidden" name="_next" value="http://ecs.fullerton.edu/~cs431s16/CPSC431Project3/contact.html">

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Submit</button>
      </form>

      <footer>
        <a href="https://www.instagram.com/donavie.photographie/?hl=en"><i class="fab fa-instagram">
          </i></a>
      </footer>

      <!-- MDB -->
      <script type="text/javascript" src="js/mdb.min.js"></script>
      <!-- Custom scripts -->
      <script type="text/javascript"></script>
  </body>

</html>