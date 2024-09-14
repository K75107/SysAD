<?php
session_start();
include 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: /crudapp/login.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Handle profile update
    if (isset($_POST['update'])) {
        $firstname = htmlspecialchars($_POST["firstname"]);
        $lastname = htmlspecialchars($_POST["lastname"]); 
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        // Validate inputs
        if (empty($firstname) || empty($lastname) || empty($email)) {
            echo "Please fill in all required fields.";
            exit();
        }

        // Update password only if it's provided
        $passwordQuery = "";
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $passwordQuery = ", password = '$hashedPassword'";
        }

        // Update user information in the database
        $sql = "UPDATE users SET firstname = ?, lastname = ?, email = ? $passwordQuery WHERE email = ?";
        $stmt = $conn->prepare($sql);
        if ($passwordQuery) {
            $stmt->bind_param("ssss", $firstname, $lastname, $email, $_SESSION['user_email']);
        } else {
            $stmt->bind_param("sss", $firstname, $lastname, $email);
        }
        $stmt->execute();

        // Update session variables
        $_SESSION['user_firstname'] = $firstname;
        $_SESSION['user_lastname'] = htmlspecialchars($_POST["lastname"]); // Make sure to add lastname field in the form if required
        $_SESSION['user_email'] = $email;
        if (!empty($password)) {
            $_SESSION['user_password'] = $password;
        }

        header("Location: ../crudapp/profile.php");
        exit();
    }

    // Handle account deletion
    if (isset($_POST['delete'])) {
        $email = $_SESSION['user_email'];

        // Delete user from the database
        $sql = "DELETE FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        // Destroy session and redirect to login page
        session_destroy();
        header("Location: ../crudapp/login.php");
        exit();
    }


    if (isset($_POST['logout'])) {
        // Destroy all session data
        session_unset();
        session_destroy();

        // Redirect to login page
        header("Location: ../crudapp/login.php");
        exit();
    }


}
?>
