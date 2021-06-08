    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $currentPage = 1;
    $pageNum = ceil(count($posts) / 5);
    ?>
    <div class="text-box">
        <h1>Maybe you miss this knowledge...</h1><br>
        <h2><span><i class="fas fa-horizontal-rule"></i></span><span><i class="fas fa-horizontal-rule"></i></span> Sharing is caring <span><i class="fas fa-horizontal-rule"></i></span><span><i class="fas fa-horizontal-rule"></i></span></h2>
    </div>
    </header>

    <!-- blog page -->
    <div class="blog-content">
        <div class="row">
            <div class="blog-left">
                <img src="assets/img/certificate.jpg" alt="">
                <h2>Posts</h2>
                <div class="post-list">
                </div>
                <div class="paginate">
                    <div class="btn-paging" id="first" onclick="paging(1)"><span><i class="fas fa-chevron-double-left"></i></span></div>
                    <div class="btn-paging" id="prev" onclick="prevOnClick()"><span><i class="fas fa-chevron-left"></i></span></div>
                    <?php
                    for ($i = 1; $i <= $pageNum; $i++) {
                        if ($i == $currentPage) {
                            echo "<div class='btn-paging selected-paging' onclick='paging(" . $i . ")'>";
                            echo $i . " </div>";
                        } else {
                            echo "<div class='btn-paging' onclick='paging(" . $i . ")'>";
                            echo $i . " ";
                            echo "</div>";
                        }
                    }
                    ?>
                    <div class="btn-paging" id="next" onclick="nextOnClick()"><span><i class="fas fa-chevron-right"></i></span></div>
                    <div class="btn-paging" id="last" onclick="paging(<?php echo $pageNum ?>)"><span><i class="fas fa-chevron-double-right"></i></span></div>
                </div>

            </div>
            <div class="blog-right">
                <div>
                    <h3 style="text-align: center;">Post Tags</h3>
                    <div id="tags">
                        <div><span><b>Tags</b></span><span><b>#</b></span></div>
                        <hr>
                        <?php
                        foreach ($tags as $tag) {
                            if ($tag->count != 0) { ?>
                                <div class='tag' onclick="window.location.href='?controller=posts&action=tag&tag=<?php echo $tag->name ?>'"><span><?php echo $tag->name ?></span>
                                    <span><?php echo $tag->count ?></span>
                                </div>
                        <?php }
                        }
                        ?>
                        <hr>
                    </div>
                </div>
                <div style="margin-top: 50px">
                    <h3 style="text-align: center;">Featured Authors</h3>
                    <div id="authors">
                        <div><span><b>Name</b></span><span><b>Posts</b></span></div>
                        <hr>
                        <?php
                        foreach ($authors as $author) {
                            if (count($author->posts) != 0) { ?>
                                <div class='author' onclick="window.location.href='?controller=users&action=profile&id=<?php echo $author->_id ?>'"><span><?php echo $author->family_name . " " . $author->given_name ?></span>
                                    <span><?php echo count($author->posts) ?></span>
                                </div>
                        <?php }
                        }
                        ?>
                        <hr>
                        <br>
                        <div>
                            <?php
                            if (session_status() === PHP_SESSION_NONE) {
                                session_start();
                            }
                            if (isset($_SESSION['userId']))
                                echo '<button class="button-login" onclick="createPost()" style="width:100%"><span><i class="fas fa-pen"></i></span> CREATE POST</button>';
                            else echo '<button class="button-login" onclick="loginToPost()" style="width:100%"><span><i class="fas fa-pen"></i></span> CREATE POST</button>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var posts = <?php echo json_encode($posts); ?>;
        var currentPage = 1;
        var pageNum = <?php echo $pageNum; ?>;
        window.onload = async function() {
            var el = document.getElementsByTagName('header');
            el[0].classList.add('sub-header');
            el[0].classList.add('blog');
            posts.sort();
            paging(1);
        }

        function createPost() {
            window.location.href = "?controller=posts&action=post";
        }

        function loginToPost() {
            window.location.href = "?controller=users&action=login";
        }

        function paging(page) {
            var buttons = document.querySelectorAll('.btn-paging');
            var postList = document.querySelector('.post-list');
            currentPage = page;
            buttons.forEach(btn => {
                if (btn.innerHTML == page) {
                    if (!btn.classList.contains('selected-paging')) btn.classList.add('selected-paging');
                } else {
                    if (btn.classList.contains('selected-paging')) btn.classList.remove('selected-paging');
                }
            });
            var list = '<ul>';
            var end = 0;
            if (posts.length - (page - 1) * 5 >= 5) {
                end = 5;
            } else end = posts.length - (page - 1) * 5;
            for (let i = (page - 1) * 5; i < (page - 1) * 5 + end; i++) {
                var li = '<li class="recommend">';
                var liContent = '<a style="font-size: 21px" href="?controller=posts&action=detail&id=' + posts[i]._id.$oid + '">' + posts[i].title + '</a>';
                liContent += '<br/>Author: <a href="?controller=users&action=profile&id=' + posts[i].author._id.$oid + '">' + posts[i].author.given_name + '</a><br/>Tags: ';
                var tags = "";
                for (let j = 0; j < posts[i].tags.length; j++) {
                    if (j != posts[i].tags.length - 1) {
                        tags += '<a href="?controller=posts&action=tag&tag=' + posts[i].tags[j].name + '">' + posts[i].tags[j].name + '</a>| ';
                    } else tags += '<a href="?controller=posts&action=tag&tag=' + posts[i].tags[j].name + '">' + posts[i].tags[j].name + '</a>';
                }
                liContent += tags + '<br><span><i class="fas fa-comments-alt"></i></span> ';
                if ('comments' in posts[i] && posts[i].comments.length > 0) {
                    liContent += posts[i].comments.length;
                } else liContent += '0';
                liContent += '<hr style="margin-top: 5px"></li><br/>';
                list += liContent;
            }
            list += "</ul>";
            postList.innerHTML = list;
        }

        function prevOnClick() {
            if (currentPage > 1) {
                paging(currentPage - 1);
            }
        }

        function nextOnClick() {
            if (currentPage < pageNum) {
                paging(currentPage + 1);
            }
        }
    </script>