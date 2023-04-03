<?php
  // Session Start.
  session_start();
  use Dotenv\Dotenv;
  //Load Composer's autoloader
  require_once "./vendor/autoload.php";
  $dotenv = Dotenv::createImmutable("./.env");
  $dotenv->safeload();
  // Fetching Database details from environment variable.
  $env = parse_ini_file('./.env');
  $servername = $env['SERVERNAME'];
  $username = $env["USERNAME"];
  $password = $env['PASSWORD'];
  $dbname = $env['DBNAME'];

  $itemName = $_POST['item'];
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO TODO (ItemName)
    VALUES (:itemname)");
    $stmt->bindParam(':itemname', $itemName);
    $stmt->execute();
    // Redirecting to different page.
    header("Location: list.php");
  } 
  catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
?>
