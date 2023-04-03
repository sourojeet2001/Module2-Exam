<?php
  // Session start.
  session_start();
  include("TodoList.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    
  </head>

  <body>
    <!-- Form Start -->
    <form class="login" class=" container mt-5" method="POST" action="connect.php">
      <div class="formcontrol">
        <div class="formfields">
          <div class="mb-3">
            <label for="items" class="form-label">Add Item</label>
            <input type="text" name="item" required class="form-control" id="item" aria-describedby="itemHelp">
          </div>
          <div class="name">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </form>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> 
</html>
