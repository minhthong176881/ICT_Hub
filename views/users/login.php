<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/stylesheets/login.css">
    <link rel="stylesheet" href="../../assets/stylesheets/components/input.css">
    <link rel="stylesheet" href="../../assets/stylesheets/components/button.css">
</head>
<body>
    <div class="container">
        <div class="icon">
            <img id="icon" src="../../assets/icons/ict_hub.jpg" alt="">
        </div>
        <div class="form-input">
            <h3>Login to ICT Hub</h3>
            <form method="POST" action="?controller=users&action=postLogin">
                <p>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                    <br>
                </p>
                <p>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <br>
                </p>
                <button class="button-login" type="submit">Login</button><br><br>
                <a href=" #" style="float: left; margin-left: 30px">Forgot your password?</a>
                <a href="#" style="float: right; margin-right: 30px">Create account</a><br>
            </form>
        </div>
        <div class="other-login">
            Or login with <br><br> 
        </div>
        <div class="outter">
            <button class="inner" id="fb">Facebook</button>
            <button class="inner" id="gg">Google</button>
            <button class="inner" id="outlook">Outlook</button>
        </div>
    </div>
</body>

</html>