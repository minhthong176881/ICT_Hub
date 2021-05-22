</header>
<div class="container" style="height: 650px;">
    <div class="icon">
        <img id="icon" src="assets/img/logo.png" alt="">
    </div>
    <div class="form-input">
        <h3>Register account</h3>
        <form method="POST" action="?controller=users&action=postRegister">
            <p>
                <input type="text" id="username" name="username" placeholder="Username" <?php if (!empty($username)) print "value=\"$username\""; ?> required>
                <br>
            </p>
            <p>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <br>
            </p>
            <p>
                <input type="password" id="cpassword" name="cpassword" placeholder="Confirm password" required>
                <br>
                <?php
                    if (isset($isDup) && $isDup == true) {
                        print '<div class="invalid-feedback">Not matching</div>';
                    }
                ?>
            </p>
            <button class="button-login" type="submit">Register</button>
            <?php
                if (isset($registerSuccess) && $registerSuccess == false) {
                    print '<div class="invalid-feedback">Your username has been existed</div>';
                }
            ?>
            <br><br>
            <a href="?controller=users&action=login" style="float: right; margin-right: 30px">Already had account? Login</a><br>
        </form>
    </div>
    <div class="other-login">
        Or register with <br><br>
    </div>
    <div class="outter">
        <button class="inner" id="fb">Facebook</button>
        <button class="inner" id="gg">Google</button>
        <button class="inner" id="outlook">Outlook</button>
    </div>
</div>
<script>
    window.onload = function() {
        el = document.getElementsByTagName('nav');
        head = document.getElementsByTagName('header');
        el[0].classList.add('navbar');
        head[0].classList.add('login');
    }
</script>