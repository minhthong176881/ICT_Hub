<h1 style="text-align: left; margin-left: 6%">Profile <span><i class='fad fa-chevron-double-right'></i></span>
    <?php
    session_start();
    echo $user->family_name . " " . $user->given_name ?></h1>
<h4 style="text-align: left; margin-left: 15%"><?php echo $user->username ?></h4>
</header>
<div class="profile-content">
    <div class="user-posts">
        <div class="nav-bar">
            <ul>
                <li <?php if ($option == 0) echo "class='selected'" ?>><a href="?controller=users&action=profile&id=<?php echo $user->_id ?>">Posts</a></li>
                <li <?php if ($option == 1) echo "class='selected'" ?>><a href="?controller=users&action=profile&id=<?php echo $user->_id ?>&option=1">Tags</a></li>
                <li <?php if ($option == 2) echo "class='selected'" ?>><a href="?controller=users&action=profile&id=<?php echo $user->_id ?>&option=2">Information</a></li>
                <li <?php if ($option == 3) echo "class='selected'" ?>><a href="?controller=users&action=profile&id=<?php echo $user->_id ?>&option=3">Contact</a></li>
            </ul>
        </div>
        <div style="margin-top: 20px">
            <?php
            if ($option == 0) {
                echo "<ul>";
                foreach ($user->posts as $post) {
                    echo "<li class='user-post'><a style='font-size: 21px' href='?controller=posts&action=detail&id=" . $post->_id . "'>" . $post->title . "</a>";
                    if (isset($_SESSION['userId']) && $user->_id == $_SESSION['userId']) {
            ?>
                        <button class="btn-edit" onclick="window.location.href='?controller=posts&action=edit&id=<?php echo $post->_id ?>'"><span><i class="fal fa-edit"></i></span></button>
                        <button class="btn-delete" onclick="btnDeleteOnClick('<?php echo $post->_id ?>')"><span><i class="fal fa-trash-alt"></i></span></button>
                    <?php }
                    echo "<br/>Author: " . $user->given_name . "<br/>Tags: ";
                    for ($j = 0; $j < count($post->tags); $j++) {
                        if ($j != count($post->tags) - 1)
                            echo "<a href='?controller=posts&action=tag&tag=" . $post->tags[$j]->name . "'>" . $post->tags[$j]->name . "</a>| ";
                        else echo "<a href='?controller=posts&action=tag&tag=" . $post->tags[$j]->name . "'>" . $post->tags[$j]->name . "</a>";
                    }
                    echo "</li><br/>";
                }
                echo "</ul>";
            }
            if ($option == 1) {
                echo "<ul>";
                foreach ($user->tags as $tag) {
                    echo "<li><a href='?controller=posts&action=tag&tag=" . $tag . "'>" . $tag . "</a>";
                    echo "</li><br/>";
                }
                echo "</ul>";
            }
            if ($option == 2) {
                echo "<div class='infor'>Username: " . $user->username . "</div>";
                echo "<div class='infor'>First name: " . $user->given_name . "</div>";
                echo "<div class='infor'>Last name: " . $user->family_name . "</div>";
                if (isset($user->class))
                    echo "<div class='infor'>Class: " . $user->class . "</div>";
                else echo "<div class='infor'>Class: Not provided.</div>";
                if (isset($user->school_year))
                    echo "<div class='infor'>School year: " . $user->school_year . "</div>";
                else echo "<div class='infor'>School year: Not provided.</div>";
                if (isset($_SESSION['userId']) && $user->_id == $_SESSION['userId']) { ?>
                    <div style="margin-top: 20px"><button class="edit-btn" onclick="window.location.href='?controller=users&action=edit&id=<?php echo $_SESSION['userId']; ?>'">Edit</button></div>
                <?php
                }
            }
            if ($option == 3) { ?>
                <div class="contact-col">
                    <form action="javascript:sendMail();" method="POST">
                        <input type="text" style="width: 100%;" id="name" placeholder="Enter your name" required>
                        <input type="email" name="" style="width: 100%;" id="email" placeholder="Email">
                        <input type="text" name="" style="width: 100%;" id="subject" placeholder="Your subject">
                        <textarea rows="8" placeholder="Message" style="width: 100%;" id="message" required></textarea>
                        <button type="submit" class="hero-btn red-btn">Send message</button>
                    </form>
                </div>
            <?php }
            ?>
        </div>
    </div>
    <div class="right-side">
        <div id="summary">
            <div class="right-items" onclick="window.location.href='?controller=users&action=profile&id=<?php echo $user->_id ?>'"><span>Posts</span><span><b><?php echo count($user->posts) ?></b></span></div>
            <div class="right-items" onclick="window.location.href='?controller=users&action=profile&id=<?php echo $user->_id ?>&option=1'"><span>Tags</span><span><b><?php echo count($user->tags) ?></b></span></div>
        </div>
    </div>
</div>
<?php include "views/popup/del_noti.php"; ?>
<?php include "views/popup/confirm_noti.php"; ?>
<script>
    window.onload = function() {
        var el = document.getElementsByTagName('header');
        el[0].classList.add('sub-header');
        el[0].classList.add('profile-header');
    }

    var deletePostId = "";

    function sendMail() {
        var subject = document.getElementById('subject').value;
        var body = document.getElementById('message').value;
        <?php if (!empty($user->email)) { ?>
            window.open('mailto:<?php echo $user->email ?>?subject=' + subject + '&body=' + body);
        <?php } else {
            echo "console.log('User has no email.');";
        } ?>
    }

    function deletePost(id) {
        <?php $mode = 'delete' ?>
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (parseInt(this.responseText) > 0) {
                    var popup = document.querySelector('.del-popup');
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    if (popup.classList.contains('popup-hide')) popup.classList.remove('popup-hide');
                } else {
                    var popup = document.querySelector('.warn-popup');
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    if (popup.classList.contains('popup-hide')) popup.classList.remove('popup-hide');
                }
            }
        }
        xmlhttp.open("GET", "?controller=posts&action=delete&id=" + id, true);
        xmlhttp.send();
    }

    function btnCloseOnClick() {
        var popup = document.querySelector('.popup');
        if (!popup.classList.contains('popup-hide')) popup.classList.add('popup-hide');
        <?php
        echo "window.location.href = '?controller=users&action=profile&id=" . $_SESSION['userId'] . "'";
        ?>
    }

    function btnOKOnClick() {
        var popup = document.querySelector('.confirm-popup');
        if (!popup.classList.contains('popup-hide')) popup.classList.add('popup-hide');
        deletePost(deletePostId);
    }

    function closePopup() {
        var popup = document.querySelector('.confirm-popup');
        if (!popup.classList.contains('popup-hide')) popup.classList.add('popup-hide');
    }

    function btnDeleteOnClick(id) {
        var popup = document.querySelector('.confirm-popup');
        if (popup.classList.contains('popup-hide')) popup.classList.remove('popup-hide');
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        deletePostId = id;
    }
</script>