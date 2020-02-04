<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password  = $fname = $lname = $email = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
    $email = trim($_POST["email"]);
    
    // Prepare an insert statement
    $sql = "INSERT INTO users_new (username, password, fname, lname, email) VALUES (?, ?, ?, ?, ?)";
     
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_fname, $param_lname, $param_email);
        
        // Set parameters
        $param_username = $username;
        $param_password = $password;
        $param_fname = $fname;
        $param_lname = $lname; 
        $param_email = $email;

        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to login page
            header("location: logintest.php");
            //echo "<h1> Your sign up has been successfully recorded in MYSQL DB!"
        } 
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            </div>
            <div class="form-group">
                <label>Firstname</label>
                <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
            </div>
            <div class="form-group">
                <label>LastName</label>
                <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>    
</body>
</html>