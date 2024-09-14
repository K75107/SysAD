<?php 
include 'db_connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    if(empty($firstname || $lastname || $email || $password)){
        exit();
        header("Location: /crudapp/index.php");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);



    $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    // Close the connection
    $conn->close();
    header("Location: /crudapp/login.php");
}
?>