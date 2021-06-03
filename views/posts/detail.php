<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<link rel="stylesheet" href="assets/stylesheets/pages/comment.css">
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
        <?php if (count($listPost) >= 2) { ?>
            <div style="margin-bottom: 50px">
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
        <?php } ?>
        <div>
            <h3>From other authors:</h3>
            <hr style="width: 95%">
            <div class="list-post">
                <ul>
                    <?php
                    foreach ($other as $item) {
                        echo "<li style='margin-bottom: 10px'><a href='?controller=posts&action=detail&id=" . $item->_id . "'>" . $item->title . "</a> - <a href='?controller=users&action=profile&id=" . $item->author->_id . "'>" . $item->author->given_name . "</a></li>";
                    }
                    ?>
                </ul>
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

<div class="comment-container" id="comment-list">
<?php
    require_once 'common/utility.php';
    use Common\Utility;

    for ($i = count($post['comments']) - 1; $i >= 0; --$i) {
        $comment = $post['comments'][$i];
        $avatar = $comment['avatar'] ?? 'https://i.pinimg.com/564x/85/8f/29/858f29fb77a5882831df52bf5de55d13.jpg';
        $name = $comment['given_name'];
        $profileUrl = !empty($comment['user_id']->__toString()) ? 'index.php?controller=users&action=profile&id='.$comment['user_id']->__toString() : '#';
        $content = $comment['content'];
        $timestamp = Utility::gmdateToLocalDate($comment['created_at']->toDateTime());
        echo <<<EOD
        <div class="comment-item">
            <div class="comment-left">
                <div class="avatar-container"><a href="{$profileUrl}" target="_blank"><img class="comment-avatar" height="40" src="{$avatar}" width="40"></a></div>
            </div>
            <div class="comment-right">
                <div class="comment-header">
                    <div class="author"><a href="{$profileUrl}" target="_blank">{$name}</a></div>
                    <div class="comment-time"><span class="comment-timestamp">{$timestamp}</span></div>
                </div>
                <div class="comment-body"><span class="comment-text">{$content}</span></div>
                <div class="comment-footer"></div>
            </div>
        </div>
        EOD;
    }
?>
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
                let commentLst = document.getElementById('comment-list');
                let comment = JSON.parse(txtResponse);
                let avatar = comment['avatar'] ? comment['avatar'] : 'https://i.pinimg.com/564x/85/8f/29/858f29fb77a5882831df52bf5de55d13.jpg';
                let name = comment['given_name'];
                let profileUrl = comment['user_id'] ? 'index.php?controller=users&action=profile&id='+comment['user_id'] : '#';
                let content = comment['content'];
                let timestamp = comment['created_at'];
                let commentHtml = `
                <div class="comment-item">
                    <div class="comment-left">
                        <div class="avatar-container"><a href="${profileUrl}" target="_blank"><img class="comment-avatar" height="40" src="${avatar}" width="40"></a></div>
                    </div>
                    <div class="comment-right">
                        <div class="comment-header">
                            <div class="author"><a href="${profileUrl}" target="_blank">${name}</a></div>
                            <div class="comment-time"><span class="comment-timestamp">${timestamp}</span></div>
                        </div>
                        <div class="comment-body"><span class="comment-text">${content}</span></div>
                        <div class="comment-footer"></div>
                    </div>
                </div>
                `;
                
                commentLst.innerHTML = commentHtml + commentLst.innerHTML;
                window.comment.reset();
            },
            error: function (statusCode, txtResponse) {
                if (statusCode == '401') {
                    alert("You should login before commenting to this post!");
                }
            }
        })
    }
</script>