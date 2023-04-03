<?php
session_start();
require_once "./vendor/autoload.php";
use Dotenv\Dotenv;
class TodoList {  
  /**
   * item
   *
   *  @var string $item
   *    Initialisg item variable.
   */
  public $item;
  
  /**
   * __construct
   *
   * Constructor intialises item variable.
   *  @param  string $item
   *    Accepting item as a passed parameter.
   */
  public function __construct(string $item) {
    $this->item = $item;
  }
  
  /**
   * createConnection
   *
   * Creating database connection.
   */
  public function createConnection() {
    // Fetching Database details from environment variable.
    $env = parse_ini_file('./.env');
    $servername = $env['SERVERNAME'];
    $username = $env["USERNAME"];
    $password = $env['PASSWORD'];
    $dbname = $env['DBNAME'];
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
    }
    // Handling database errors.
    catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }  
  /**
   * addItems
   *
   * Adding items to our DB.
   *  @param  string $item
   *    Accepting the item as passed parameter.
   *  @return void
   */
  public function addItems($item) {
    $itemName = $_POST['item'];
    try {
    // Database connection is being established.
    $conn = $this->createConnection();
    $stmt = $conn->prepare("INSERT INTO TODO (ItemName)
    VALUES (:itemname)");
    $stmt->bindParam(':itemname', $itemName);
    $stmt->execute();
      header("Location: list.php");
    } 
    catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

}
?>
