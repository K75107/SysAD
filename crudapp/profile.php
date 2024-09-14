<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    
</head>
        <?php
        session_start();
        include '../crudapp/db_connect.php';

        // Ensure the user is logged in
        if (!isset($_SESSION['user_firstname'])) {
            header("Location: ../crudapp/login.php");
            exit();
        }
        ?>

<body>
    
    <main>
        <div class="cover-photo"></div>
        <div class="profile-photo"></div>

        <h2>Edit Profile</h2>
        <form action="../crudapp/handle_profile.php" method="POST">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input id="firstname" type="text" name="firstname" value="<?php echo htmlspecialchars($_SESSION['user_firstname']); ?>" required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" name="lastname" value="<?php echo htmlspecialchars($_SESSION['user_lastname']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" value="<?php echo htmlspecialchars($_SESSION['user_password']); ?>" required>
            </div>

            <button type="submit" name="update">Save Changes</button>
        </form>

        <form action="../crudapp/handle_profile.php" method="POST">
            <button class="delete-btn" type="submit" name="delete">Delete Account</button>
        </form>

        <form action="../crudapp/handle_profile.php" method="POST" >
            <button type="submit" name="logout">Logout</button>
        </form>
    </main>
</body>



<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #1a202c;
            color: #e2e8f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        main {
            background: #2d3748;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            text-align: center;
            color: #edf2f7;
        }

        .cover-photo {
            background-color: #4a5568;
            height: 120px;
            border-radius: 12px 12px 0 0;
            margin-bottom: 2rem;
        }

        .profile-photo {
            width: 100px;
            height: 100px;
            background-color: #718096;
            border-radius: 50%;
            margin: -50px auto 1.5rem;
            border: 4px solid #2d3748;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        label {
            font-size: 0.9rem;
            color: #a0aec0;
        }

        input {
            padding: 0.8rem;
            border: 1px solid #4a5568;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #1a202c;
            color: #e2e8f0;
            transition: border-color 0.2s ease;
        }

        input:focus {
            border-color: #63b3ed;
            outline: none;
        }

        button {
            padding: 0.8rem;
            background-color: #2d3748;;
            color: white;
            border: 1px solid #1a202c; /* Border color */
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 5px;
        }

        button:hover {
            background-color: #1B1A55;
        }

        .delete-btn {
            background-color: #2d3748;
        }

        .delete-btn:hover {
            background-color: #535C91;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }
    </style>


</html>
