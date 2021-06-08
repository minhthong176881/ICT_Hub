<div class="text-box" style="top: 25%; text-indent: -5.4%"><h1 style="text-align: left; margin-left: 6%">
<?php
    echo "<a style='font-size: 36px; color: white; font-size: 56px' href='?controller=pages&action=blog'>Blog</a> <span><i class='fad fa-chevron-double-right'></i></span> ";
    echo $tag;
    ?>
</h1><br>
</div>
</header>
<div class="post-tag-content">
    <?php
    foreach ($posts as $post) {
        echo '<div class="subject-list"><a href="?controller=posts&action=detail&id=' . $post->_id . '">' . $post->title . '</a>- Author: ' . $post->author->given_name . '</div><br>';
    }
    ?>
</div>
<script>
    window.onload = function() {
        var el = document.getElementsByTagName('header');
        el[0].classList.add('sub-header');
        el[0].classList.add('post-header');
    }
</script>