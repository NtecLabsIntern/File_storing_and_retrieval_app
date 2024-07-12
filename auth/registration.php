<?php
include 'db.php';
//  getting the informations from the form and storing them in variables
if(isset($_POST['submit'])){
   $full_name = $_POST['full_name'];
   $telephone = $_POST['telephone'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $gender =  $_POST['gender'];

//    check if user already exist
   $query = "SELECT * FROM `users` WHERE F_name = ?";
   $statement = $conn->prepare($query);
   $statement->bind_param("s",$full_name);
   $statement->execute();
   $result = $statement->get_result();

    if ($result->num_rows > 0) {
    // Username already exists, return error
    echo json_encode(["message" => "Username already exists. Please choose a different one."]);
    http_response_code(400);
    return;
    }
// insert a new user
   $sql ="INSERT INTO `users` (`F_name`, `Email`, `tel`,`Password`, `gender` ) 
   VALUES (?, ?, ?, ?, ?)";
   $statement = $conn->prepare($sql);
   $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password
   $statement->bind_param("sssss",$full_name,$email,$telephone,$hashed_password,$gender);

   if ($statement->execute()) {
    header("Location: login.php");
    exit;
} else {
    echo "Failed to create user: " . $statement->error;
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

    <title>SignUp | File storage app</title>
</head>
<body>
    <div class="wrapper ">
        <div class="inside">
        <div class="img"><img src="img/file.jpg" alt=""></div>
            <div class="formR">
                <form method="post" >
                    <header class="text-center"> SIGN UP</header>
                        <div class="input-field ">
                            <label for="">FULL NAME:</label><br>
                            <input type="text" name="full_name" class="input"  id="fullName" required>
                        </div>
                        <div class="input-field ">
                            <label for="">EMAIL:</label><br>
                            <input type="email" name="email" class="input"  id="email" required>
                        </div>
                        <div class="input-field ">
                            <label for="">TELEPHONE:</label><br>
                            <input type="tel" name="telephone" class="input"  id="tel" required>
                        </div>
                        <div class="input-field">
                            <label for="">PASSWORD:</label><br>
                            <input type="password"  name="password" class="input px-1"  id="password" required>
                        </div>
                        <div class="input-field">
                            <label for="">GENDER: </label>
                            <input type="radio" name="gender" id="male" class="form-check-input" value="male">
                            <label for="male" class="form-input-label">Male</label>
                            <input type="radio" name="gender" id="female" class="form-check-input" value="female">
                            <label for="female" class="form-input-label">Female</label><br>
                        </div>
                        <div class="input-field1">
                            <input type="submit" name="submit" class="submit" value="Sign Up">
                        </div>
                        <div class="signin">
                            <span>Already have an account? <a href="login.php">Get In!</a></span>
                        </div>
                </form>
            </div>
        </div>

    </div>
 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>