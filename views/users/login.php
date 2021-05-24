</header>
<script src="https://apis.google.com/js/client:platform.js"></script>
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
                <!-- <br> -->
            </p>
            <p>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <br>
            </p>
            <button class="button-login" type="submit">Login</button>
            <?php
                if (isset($loginSuccess) && $loginSuccess == false) {
                    if (isset($external) && $external == true) {
                        print '<div class="invalid-feedback">Account is registered with a third-party application</div>';
                    } else {
                        print '<div class="invalid-feedback">You have entered wrong identity or unregistered account</div>';
                    }
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
        <button class="inner" id="fb" onclick="loginFB()"><span><i style="color: blue" class="fab fa-facebook-f"></i></span> Facebook</button>
        <button class="inner" id="gg"><span><i style="color: red" class="fab fa-google"></i></span> Google</button>
        <button class="inner" id="outlook">Outlook</button>
    </div>
</div>
<script>
    <?php
        if (isset($fromRegister) && $fromRegister == true)
            print 'window.history.pushState({}, null, "?controller=users&action=login");';
    ?>
    window.onload = function() {
        el = document.getElementsByTagName('nav');
        head = document.getElementsByTagName('header');
        el[0].classList.add('navbar');
        head[0].classList.add('login');
    }


    function externalLogin(access_token, provider) {
        var data = {
            "idToken": access_token,
            "provider": provider,
        };

        virtualFormSubmit('?controller=users&action=externalLogin', data, 'post');

        // Validate external login on server
        // xhrPost(
        //     url = '?controller=users&action=externalLogin',
        //     data = data,
        //     success = function (responseTxt) {
        //         response = JSON.parse(responseTxt);
        //         window.location.href = '?controller=pages&action=home';
        //     },
        //     error = function (status, responseTxt) {
        //         alert('Authenticate error!');
        //         window.location.reload();
        //     }
        // )
    }
  
    // Login Google
    function loginGoogle  () {
        if (typeof gapi !== 'undefined') {
            try {
                gapi.load('auth2', function () {
                    auth2 = gapi.auth2.init({
                        client_id: '764151411721-2l3pha8qtpb2jt5rm2smkpp2ucpronj2.apps.googleusercontent.com'
                    });

                    var loginButton = document.getElementById('gg');
                    auth2.attachClickHandler(loginButton, {},
                        function (googleUser) {         // on success
                            if (googleUser.getAuthResponse()) {
                                var access_token = googleUser.getAuthResponse().id_token;
                                externalLogin(access_token, "Google");
                            }
                        },
                        function (error) {
                            alert("Sign in Google error!");
                        });
                });
               
            } catch (err) {
                console.log(err);
            }
        }
    }

    loginGoogle();

    // Initial FB
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '799342317388985',
            cookie     : true,
            xfbml      : true,
            version    : 'v10.0'
        });        
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/vi_VN/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Login Facebook
    function loginFB() {
        FB.login(function(response) {
            if (response.authResponse) {
                try {
                    FB.api('/me', {
                        fields: "",
                    }, function(response) {
                        let access_token = FB.getAuthResponse()['accessToken'];
                        externalLogin(access_token, "Facebook");
                    });
                } catch (err) {
                    alert("Sign in Facebook error!");
                }
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        }, {
            scope: "email, public_profile, user_birthday"
        });
    }

    function register() {
        window.location.href = "?controller=users&action=register";
    }
</script>