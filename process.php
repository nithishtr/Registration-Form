<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $host = "localhost";
    $username = "root";  // Replace with your MySQL username
    $password = "";      // Replace with your MySQL password
    $database = "registration"; // Replace with your database name

    // Collect form data
    $name = htmlspecialchars($_POST["name"]);
    $title = htmlspecialchars($_POST["title"]);
    $category = htmlspecialchars($_POST["category"]);
    $description = htmlspecialchars($_POST["description"]);

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'registration');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO students (name, title, category, description) 
            VALUES ('$name', '$title', '$category', '$description')";

if ($conn->query($sql) === TRUE) {
    // Fetch the most recent record based on created_at
    $result = $conn->query("SELECT * FROM students ORDER BY created_at DESC LIMIT 1");
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        die("Error fetching data.");
    }
} else {
    die("Error: " . $sql . "<br>" . $conn->error);
}

// Close the connection
$conn->close();
?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Registration Successful!</h1>
        <h2>Details Submitted</h2>
        <p><strong>Name:</strong> <?php echo $data['name']; ?></p>
        <p><strong>Project Title:</strong> <?php echo $data['title']; ?></p>
        <p><strong>Category:</strong> <?php echo $data['category']; ?></p>
        <p><strong>Description:</strong> <?php echo $data['description']; ?></p>
        <a href="index.html" class="button">Register Another Project</a>
    </div>
</body>
</html>
<?php
} else {
    header("Location: index.html");
    exit();
}
?>
