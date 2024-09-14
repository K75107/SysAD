<?php
session_start();

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Check if email and password are empty
    if (empty($email) || empty($password)) {
        header("Location: /crudapp/login.php");
        exit();
    }

    // Updated SQL query to include firstname and lastname
    $sql = "SELECT firstname, lastname, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);  // Prepare the SQL statement
    $stmt->bind_param("s", $email); // Bind the parameter to the placeholder
    $stmt->execute(); // Execute the statement
    $result = $stmt->get_result();

    // Fetch the data
    if ($row = $result->fetch_assoc()) {
        $dbfirstname = $row['firstname'];
        $dblastname = $row['lastname'];
        $dbEmail = $row['email'];
        $dbPassword = $row['password'];
        
        if (password_verify($password, $dbPassword)) {
            $_SESSION['user_firstname'] = $dbfirstname;
            $_SESSION['user_lastname'] = $dblastname;
            $_SESSION['user_email'] = $dbEmail;
            $_SESSION['user_password'] = $password;
            
            header("Location: ../crudapp/profile.php");
            exit();
        } else {
            echo "Wrong password.";
        }

    } else {
        echo "No user found with that email.";
    }
}
?>