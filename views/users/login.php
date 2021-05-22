</header>
<div class="container">
    <div class="icon">
        <img id="icon" src="assets/img/logo.png" alt="">
    </div>
    <div class="form-input">
        <h3>
        <?php
            if (isset($fromRegister) && $fromRegister == true)
                print 'Registered successfully, now login to ICT Hub';
            else
                print 'Login to ICT Hub';
        ?>
        </h3>
        <form method="POST" action="?controller=users&action=postLogin">
            <p>
                <input type="text" id="username" name="username" placeholder="Username" <?php if (!empty($username)) print "value=\"$username\""; ?> required>
                <br>
            </p>
            <p>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <br>
            </p>
            <button class="button-login" type="submit">Login</button>
            <?php
                if (isset($loginSuccess) && $loginSuccess == false) {
                    print '<div class="invalid-feedback">You have entered wrong identity</div>';
                }
            ?>
            <br><br>
            <a href="#" style="float: left; margin-left: 30px">Forgot your password?</a>
            <a href="#" onclick="register()" style="float: right; margin-right: 30px">Create account</a><br>
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
<script>
    <?php
        if (isset($fromRegister) && $fromRegister == true)
            print 'window.history.pushState({}, null, "?controller=users&action=login");\n';
    ?>
    window.onload = function() {
        el = document.getElementsByTagName('nav');
        head = document.getElementsByTagName('header');
        el[0].classList.add('navbar');
        head[0].classList.add('login');
    }

    function register() {
        window.location.href = "?controller=users&action=register";
    }
</script>