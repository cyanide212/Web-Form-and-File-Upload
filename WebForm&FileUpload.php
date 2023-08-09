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
    function validate_email($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        return true;
    }
    if(isset($_POST["email"]) && validate_email($_POST["email"]) === true){
        echo "Email is Valid";
    }else{
        echo "Email is Invalid";
    }

    $allowed_types = ['PNG', 'JPEG'];
    foreach ($allowed_types as $type) {
        if (exif_imagetypes($_FILES['image']['tmp_name']) !== $type) {
            echo "Invalid file type.";
            exit();
        }
    }
    header('Location: /');
    exit();
?>