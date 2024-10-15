<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from form
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    
    // Debugging: Display received values
    echo "<h2>Received Values:</h2>";
    echo "First Name: " . htmlspecialchars($firstName) . "<br>";
    echo "Last Name: " . htmlspecialchars($lastName) . "<br>";
    echo "Phone: " . htmlspecialchars($phone) . "<br>";
    echo "Email: " . htmlspecialchars($email) . "<br>";

    // Validation flags
    $errors = [];

    // Validate input
    if (empty($firstName) || empty($lastName) || empty($phone) || empty($email)) {
        $errors[] = "No field can be blank.";
    }
    if (strlen($firstName) > 20 || strlen($lastName) > 20) {
        $errors[] = "First name and last name must be 20 characters or less.";
    }
    if (strlen($email) > 30) {
        $errors[] = "Email must be 30 characters or less.";
    }
    if (strlen($phone) != 12 || !preg_match("/^\d{3}-\d{3}-\d{4}$/", $phone)) {
        $errors[] = "Phone number must be in the format xxx-xxx-xxxx.";
    }
    if (!preg_match("/^[a-zA-Z0-9]+@[a-zA-Z]+\.(com|edu)$/", $email)) {
        $errors[] = "Email format is invalid.";
    }

    // Strict validation for first and last name
    if (!preg_match('/^[a-zA-Z]+$/', $firstName)) {
        $errors[] = "First name must contain only alphabetical characters.";
    }
    if (!preg_match('/^[a-zA-Z]+$/', $lastName)) {
        $errors[] = "Last name must contain only alphabetical characters.";
    }

    // If errors exist, show them
    if (!empty($errors)) {
        echo "<h2>Errors:</h2><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul><a href='userInfo.html'>Go Back</a>";
    } else {
        echo "<h2>No errors, data is valid!</h2>";
    }
}
?>
