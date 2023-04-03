<?php 
  use Dotenv\Dotenv;
  //Load Composer's autoloader
  require_once "./vendor/autoload.php";
  $dotenv = Dotenv::createImmutable("./.env");
  $dotenv->safeload();
  // Fetching Database details from environment variable.
  $env = parse_ini_file('./.env');
  $servername = $env['SERVERNAME'];
  $username = $env["USERNAME"];;
  $password = $env['PASSWORD'];
  $dbname = $env['DBNAME'];
  // Fetching all entries from TODO table.
  try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $sql = 'SELECT * FROM TODO';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
  }
  catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>List Items</title>
    <link href="./css/style.css" rel="stylesheet">
  </head>
  <body>
    <center>
      <div class="container">
        <h1>Todo List</h1>
        <table class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th>Item Id</th>
              <th>Item Name</th>
            </tr>
          </thead>

          <tbody>
            <?php while ($row = $q->fetch()): ?>
              <tr>
                <td>
                  <?php echo htmlspecialchars($row['ItemId']) ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['ItemName']); ?>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </center>
  </body>
  </div>
</html>
