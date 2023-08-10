<!DOCTYPE html>
<html>
<head>
    <title>Email Validation</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Email Validation</h1>
    <form action="email_validation.php" method="post" enctype="multipart/form-data">
        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email">

        <label for="image">Image File:</label>
        <input type="file" name="image" id="image">

        <button type="submit">Submit</button>
    </form>
</body>
</html>

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function validate_email($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return false;
    }
    return true;
}

if(isset($_POST["email"]) && validate_email($_POST["email"]) === true){
    $email = $_POST["email"];
    $sql = "INSERT INTO emails (email) VALUES ('$email')";
    if ($conn->query($sql) === TRUE) {
        echo "Email is Valid and stored in the database.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}else{
    echo "Email is Invalid";
}

$allowed_types = ['image/png', 'image/jpeg'];
if (isset($_FILES['image']) && in_array($_FILES['image']['type'], $allowed_types)) {
    $image_path = "uploads/" . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    echo "Image uploaded successfully.";
}else{
    echo "Invalid";
}

header('Location: /');
exit();

$conn->close();
?>