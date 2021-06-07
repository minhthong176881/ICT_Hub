<div class="text-box" style="top: 25%; text-indent: -5.4%"><h1 style="text-align: left; margin-left: 6%; font-size: 36px">
    <a style="font-size: 36px; color: white; font-weight: 600" href="?controller=users&action=profile&id=<?php echo $user->_id ?>">Profile</a>
    <span><i class='fad fa-chevron-double-right'></i></span> Edit <span><i class='fad fa-chevron-double-right'></i></span>
    <?php
    echo $user->username;
    $warning = 'profile';
    $mode = 'profile';
    $isWarn = false;
    ?>
</h1>
</div>

</header>
<div class="edit-content">
    <h1 style="text-align: center;">Information</h1>
    <div style="margin: auto">
        <form method="POST" action="javascript:submit();">
            <p>
                <input type="text" id="given-name" name="given_name" placeholder="First name" required>
                <br>
            </p>
            <p>
                <input type="text" id="family-name" name="family_name" placeholder="Last name" required>
                <br>
            </p>
            <p>
                <input type="text" id="email" name="email" placeholder="Email" <?php if ($user->external) echo "disabled" ?>>
                <br>
            </p>
            <p>
                <input type="text" id="class" name="class" placeholder="Class (e.g. ICT 02 K62)">
                <br>
            </p>
            <p>
                <input type="text" id="school-year" name="school_year" placeholder="School year (e.g. K62)">
                <br>
            </p>
            <div class="btn-group" style="display: flex; margin-top: 20px;">
                <div style="margin-left: auto">
                    <button type="submit" name="btn-submit" class="button-login" style="width: 200px; margin-right: 20px">Submit</button>
                    <button type="reset" class="button-cancel" style="width: 200px;" onclick="cancel()">Cancel</button>
                </div>
            </div>
            <br><br>
        </form>
    </div>
</div>
<?php include "views/popup/noti.php" ?>
<?php include "views/popup/warn_noti.php" ?>
<script>
    window.onload = function() {
        var el = document.getElementsByTagName('header');
        el[0].classList.add('sub-header');
        el[0].classList.add('profile-header');
        var given_name = document.getElementById('given-name');
        given_name.value = "<?php echo $user->given_name ?>";
        var family_name = document.getElementById('family-name');
        family_name.value = "<?php echo $user->family_name ?>";
        var email = document.getElementById('email');
        <?php
        if (isset($user->email)) {
            echo "email.value ='" . $user->email . "';";
        }
        ?>
        var klass = document.getElementById('class');
        <?php
        if (isset($user->class)) {
            echo "klass.value ='" . $user->class . "';";
        }
        ?>
        var school_year = document.getElementById('school-year');
        <?php
        if (isset($user->school_year)) {
            echo "school_year.value ='" . $user->school_year . "';";
        }
        ?>
    }

    function submit() {
        var formData = new FormData();
        formData.append("given_name", document.getElementById('given-name').value);
        formData.append("family_name", document.getElementById('family-name').value);
        formData.append("email", document.getElementById('email').value);
        formData.append("class", document.getElementById('class').value);
        formData.append("school_year", document.getElementById('school-year').value);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                if (parseInt(this.responseText) > 0) {
                    var popup = document.querySelector('.noti-popup');
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    if (popup.classList.contains('popup-hide')) popup.classList.remove('popup-hide');
                } else {
                    <?php $isWarn = true; ?>
                    var popup = document.querySelector('.warn-popup');
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    if (popup.classList.contains('popup-hide')) popup.classList.remove('popup-hide');
                }
            }
        }
        xmlhttp.open("POST", "?controller=users&action=editInfo&id=<?php echo $user->_id ?>");
        xmlhttp.send(formData);
    }

    function cancel() {
        window.location.href = "?controller=users&action=profile&id=<?php echo $user->_id ?>";
    }

    function btnCloseOnClick() {
        <?php if ($isWarn) echo  "var popup = document.querySelector('.warn-popup');";
        else echo "var popup = document.querySelector('.popup');";
        ?>
        if (!popup.classList.contains('popup-hide')) popup.classList.add('popup-hide');
        window.location.href = "?controller=users&action=profile&id=<?php echo $user->_id ?>";
    }

    function btnCancelOnClick() {
        var popup = document.querySelector('.warn-popup');
        if (!popup.classList.contains('popup-hide')) popup.classList.add('popup-hide');
    }
</script>