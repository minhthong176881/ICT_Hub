</header>
<script src="https://apis.google.com/js/client:platform.js"></script>
<div class="container">
    <div class="icon">
        <img id="icon" src="assets/img/logo.png" alt="">
    </div>
    <div class="form-input">
        <h3>Register account</h3>
        <form method="POST" action="?controller=users&action=postRegister">
            <p>
                <input type="text" id="given-name" name="given_name" placeholder="First name" <?php if (!empty($given_name)) print "value=\"$given_name\""; ?> required>
                <label class="required"></label>
                <br>
            </p>
            <p>
                <input type="text" id="family-name" name="family_name" placeholder="Last name" <?php if (!empty($family_name)) print "value=\"$family_name\""; ?> required>
                <label class="required"></label>
                <br>
            </p>
            <p>
                <input type="text" id="username" name="username" placeholder="Username" <?php if (!empty($username)) print "value=\"$username\""; ?> required>
                <label class="required"></label>
                <br>
            </p>
            <p>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <label class="required"></label>
                <br>
            </p>
            <p>
                <input type="password" id="cpassword" name="cpassword" placeholder="Confirm password" required>
                <label class="required"></label>
                <br>
                <?php
                    if (isset($isDup) && $isDup == true) {
                        print '<div class="invalid-feedback">Not matching</div>';
                    }
                ?>
            </p>
            <p>
                <input type="text" id="email" name="email" placeholder="Email" <?php if (!empty($email)) print "value=\"$email\""; ?>>
                <br>
            </p>
            <p>
                <input type="text" id="class" name="class" placeholder="Class (e.g. ICT 02 K62)" <?php if (!empty($class)) print "value=\"$class\""; ?>>
                <br>
            </p>
            <p>
                <input type="text" id="school-year" name="school_year" placeholder="School year (e.g. K62)" <?php if (!empty($school_year)) print "value=\"$school_year\""; ?>>
                <br>
            </p>
            <button class="button-login" type="submit">Register</button>
            <?php
                if (isset($registerSuccess) && $registerSuccess == false) {
                    if (isset($external) && $external == true) {
                        print '<div class="invalid-feedback">Your email has been registered</div>';
                    } else {
                        print '<div class="invalid-feedback">Your username has been existed</div>';
                    }
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
        <button class="inner" id="fb" onclick="registerFB()"><span><i style="color: blue" class="fab fa-facebook-f"></i></span> Facebook</button>
        <button class="inner" id="gg"><span><i style="color: red" class="fab fa-google"></i></span> Google</button>
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

    function externalRegister(access_token, username, provider, fullName, portraitImage) {
        var data = {
            "idToken": access_token,
            "username": username,
            "provider": provider,
            "name": fullName,
            "avatar": portraitImage,
        };

        virtualFormSubmit('?controller=users&action=externalRegister', data, 'post');

        // // Validate external register on server
        // xhrPost(
        //     url = '?controller=users&action=externalRegister',
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
                                var profile = googleUser.getBasicProfile();
                                var name = profile.getName();
                                var email = profile.getEmail();
                                var imageUrl = profile.getImageUrl();
                                var access_token = googleUser.getAuthResponse().id_token;
                                externalRegister(access_token, email, "Google", name, imageUrl);
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
    function registerFB() {
        FB.login(function(response) {
            if (response.authResponse) {
                try {
                    FB.api('/me', {
                        fields: "id,first_name,last_name,email,picture.type(normal),birthday",
                    }, function(response) {
                        let access_token = FB.getAuthResponse()['accessToken'];
                        let avatar = response.picture.data.url;
                        externalRegister(access_token, response.email, "Facebook", response.name, avatar);
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
</script>