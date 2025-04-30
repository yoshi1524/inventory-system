<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/login (1).css">
    <link rel="shortcut icon" href="qweee.png" type="image/x-icon">
</head>

<body>
    
    <form action='login.php' method='POST'>

        <div class= 'wrapper'>

            <h2>Login</h2>
                
                <center>
                    <span class='warn text-danger'><i><?php echo $notif; ?></i></span>
                </center>


                    <div class= 'form-group'>
                        <input type='email' name='user' placeholder='Username'>
                    </div>

                    <div class= 'form-group'>
                        <input type='password' name='password' placeholder='Password' id='password'>
                    </div>

                    <div class= 'form-group'>
                        <input type='submit' name='btnLogin' id='login' value="Login">
                    </div>

                    <center>
                        <a href="reg.php">New user? Click here to create an account</a>
                    </center>

        </div>

    </form>

</body>
</html>