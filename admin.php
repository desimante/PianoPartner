<?php ob_start(); ?>

<?php

include 'includes/connect_mysql.php';
include 'includes/html_head.php';
session_start();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['password'])){
    $password = test_input($_POST["password"]);
    if ($stmt = $conn->prepare("SELECT Pass FROM Boss")){
      $stmt->execute();
      $stmt->bind_result($pass);
      $stmt->fetch();
      if ($password==$pass){
        $_SESSION["active"] = true;
        header("Location: orders_table");
        exit;
      }
      $stmt->close();
    }
  }
  $conn->close();
}

?>

<body>

  <h1 id="main_h1"> Backlight Recordings</h1>
  <div class="form">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <input type="password" id="password" name="password">
      <input type="submit" name="ok" value="OK" id="submit_button">
    </form>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="fullpage.js/vendors/scrolloverflow.js"></script>
  <script src="fullpage.js/dist/fullpage.js"></script>
  <script src=js/admin.js></script>
</body>

</html>
<?php ob_flush(); ?>
