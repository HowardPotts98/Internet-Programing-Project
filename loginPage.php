<?php
// Start Session
session_start();
 
// Check If User Logged In, If Yes Send To Home Page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}
 
// Include Config File
require_once "config.php";
 
// Define Variables And Start Empty
$username = $password = "";
$username_err = $password_err = "";
 
// Processing Data From Form Upon Submission
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if Username Is Empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check If Password Is Empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Check Credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare A Select Statement
        $sql = "SELECT username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Set Var For Parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Try To Execute Prepared Statement
            if(mysqli_stmt_execute($stmt)){
                // Store Result In Database Table
                mysqli_stmt_store_result($stmt);
                
                // If Username Exists, Check Password As Well
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Set Result Variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password Is Correct. Start New Session
                            session_start();
                            
                            // Store Data In Session Variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;                            
                            
                            // Sends User To Home Page
                            header("location: home.php");
                        } else{
                            // Display An Error Message If Password Is Not Valid
                            $password_err = "The Password You Entered Was Not Valid.";
                        }
                    }
                } else{
                    // Display Error Message When Username Doesn't Exist
                    $username_err = "That Username Does't Exist";
                }
            } else{
                echo "Error: Please Try Again";
            }

            // Close Statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close Connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your username and password to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login" >
            </div>
            <p>No Account Yet? <a href="createaccount.php">Create One Here!</a>.</p>
        </form>
    </div>    
</body>
</html>