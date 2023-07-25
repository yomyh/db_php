<!DOCTYPE html>
<html>
<head>
  <title>User Registration</title>
</head>
<body>
  <h1>User Registration</h1>
  <form action="submit.php" method="POST" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br><br>
    
    <label for="password">Password:</label>
    <input type="password" name="password" required><br><br>
    
    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>
    
    <label for="room_number">Room Number:</label>
    <input type="number" name="room_number"><br><br>
    
    <label for="profile_picture">Profile Picture:</label>
    <input type="file" name="profile_picture"><br><br>
    
    <input type="submit" value="Submit">
  </form>

  <?php
   // Check if the form is submitted
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $roomNumber = $_POST["room_number"];

  // Database connection
  $host = "localhost";
  $Username = "olopsman";
  $Password = "12345678";
  $dbName = "user_db";

  $conn = new mysqli($host, $Username, $Password, $dbName);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // SQL table creation query
  $sql = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    room_number INT,
    profile_picture VARCHAR(100)
  )";

  // Execute the SQL query
  if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }
   // Prepare and execute the SQL INSERT statement
   $save = $conn->prepare("INSERT INTO users (name, password, email, room_number) VALUES (?, ?, ?, ?)");
   $save->bind_param("sssi", $name, $password, $email, $roomNumber);
   $save->execute();


  // Close the connection
  $save->close();
    $conn->close();
  }
  ?>
</body>
</html>
