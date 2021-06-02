<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<h1 style="text-align: left; margin-left: 6%">Blog</h1><br>
</header>
<div class="post-content" style="display: flex">
    <div class="left-content">
        <h1><?php echo $post->title; ?></h1>
        <div style="margin-top: 2%; margin-bottom: 2%; display: flex">
            <div>Author: <?php echo "<a href='?controller=users&action=profile&id=" . $post->author->_id . "'>" . $post->author->given_name . "</a>" ?></div>
            <div style="margin-left: auto">
                Tags:
                <?php
                for ($i = 0; $i < count($post->tags); $i++) {
                    if ($i != count($post->tags) - 1)
                        echo "<a href='?controller=posts&action=tag&tag=" . $post->tags[$i]->name . "'>" . $post->tags[$i]->name . "</a>| ";
                    else echo "<a href='?controller=posts&action=tag&tag=" . $post->tags[$i]->name . "'>" . $post->tags[$i]->name . "</a>";
                }
                ?>
            </div>
        </div>
        <div class="detail-content">
            <?php
            echo $post->content . '<br>'; ?>
        </div>
    </div>
    <div class="right-content">
        <div>
            <h3>More from <?php echo $post->author->given_name ?>: </h3>
            <hr style="width: 95%">
            <div class="list-post" style="margin-top: 10px">
                <ul>
                    <?php
                    foreach ($listPost as $item) {
                        if ($item->_id != $post->_id)
                            echo "<li style='margin-bottom: 10px'><a href='?controller=posts&action=detail&id=" . $item->_id . "'>" . $item->title . "</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <hr style="margin-top: 20px; width: 95%">
        </div>
        <div style="margin-top: 50px">
            <h3>From other authors:</h3>
            <hr style="width: 95%">
            <div class="list-post">

            </div>
        </div>
    </div>
</div>
<div class="comment-box">
    <h3>Leave a comment</h3>
    <form action="submit" class="comment-form" name="comment">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['userId'] ?? ''; ?>">
        <input type="hidden" name="post_id" value="<?php echo $post['_id'] ?? ''; ?>">
        <textarea rows="3" placeholder="Your comment" name="content"></textarea>
        <button class="hero-btn red-btn">POST COMMENT</button>
    </form>
</div>
<script>
    window.onload = function() {
        var el = document.getElementsByTagName('header');
        el[0].classList.add('sub-header');
        el[0].classList.add('post-header');
    }

    window.comment.onsubmit = function (e) {
        e.preventDefault();
        data = {
            'user_id': document.comment.user_id.value,
            'post_id': document.comment.post_id.value,
            'content': document.comment.content.value
        };

        xhrPost({
            url: 'index.php?controller=posts&action=postComment',
            data: data,
            success: function (txtResponse) {
                alert("OK" + txtResponse);
            }
        })
    }
</script>