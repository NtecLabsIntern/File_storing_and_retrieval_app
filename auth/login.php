<?php

include 'db.php';
session_start();

// authenticaating users

if(isset($_POST['signin'])){
    $full_name = $_POST['full_name'];
    $password = $_POST['password'];

    // Retrieve hashed password from the database based on the provided username
    $query = "SELECT id,password,F_name FROM `users` WHERE F_name = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("s", $full_name);
    $statement->execute();
    $result = $statement->get_result();


    if ($result->num_rows == 1) {
        // User found, verify password
        $userData = $result->fetch_assoc();
        $hashedPassword = $userData['password'];

        // Verify the provided password against the hashed password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['user_name'] = $userData['F_name'];
            // Redirect to a dashboard or home page
            header("Location: dashboard.php");
            exit;
        } else {
            // Password is incorrect
            $error = "Incorrect password.";
        }
    } else {
        // User not found
        $error = "User not found.";
    }

}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Login | File storage app</title>
</head>
<body>
    <div class="wrapper ">
        <div class="inside">
            <div class="img"><img src="img/file.jpg" alt=""></div>
            <div class="form">
                <form method="post" class=" ">
                    <header class="text-center">SIGN IN</header>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                        <div class="input-field ">
                            <label for="email">FULL NAME:</label><br>
                            <input type="text" name="full_name" class="input"  id="email" required>
                        </div>
                        <div class="input-field">
                            <label for="password">PASSWORD:</label><br>
                            <input type="password"  name="password" class="input px-1"  id="password" required>
                        </div>
                        <div class="forget">
                            <span><a href="#">Forget Password?</a></span>
                        </div>
                        <div class="input-field1">
                            <input type="submit" name="signin" class="submit" value="Sign In">
                        </div>
                        <div class="signin">
                            <span>Already have an account? <a href="registration.php">Create an account!</a></span>
                        </div>
                </form>
            </div>
        </div>

    </div>
 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>