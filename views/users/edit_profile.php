<h1 style="text-align: left; margin-left: 6%">
    <a style="font-size: 36px; color: white; font-weight: 600" href="?controller=users&action=profile&id=<?php echo $user->_id ?>">Profile</a>
    <span><i class='fad fa-chevron-double-right'></i></span> Edit <span><i class='fad fa-chevron-double-right'></i></span>
    <?php
    echo $user->username ?>
</h1>

</header>
<div class="profile-content">
</div>
<script>
    window.onload = function() {
        var el = document.getElementsByTagName('header');
        el[0].classList.add('sub-header');
        el[0].classList.add('profile-header');
    }
</script>