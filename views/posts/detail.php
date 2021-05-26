<h1 style="text-align: left; margin-left: 6%">Blog</h1><br>
</header>
<div class="post-content">
    <?php 
        echo '<h2>'.$post->title.'</h2>';
        echo $post->content.'<br>';
        echo '<div style="margin-left:auto">Author: '.$post->author->username.'</div>';
    ?>
</div>
<script>
    window.onload = function() {
        var el = document.getElementsByTagName('header');
        el[0].classList.add('sub-header');
        el[0].classList.add('post-header');
    }
</script>