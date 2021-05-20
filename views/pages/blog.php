    <h1>Maybe you miss this knowledge...</h1><br>
    <h3><span><i class="fas fa-horizontal-rule"></i></span><span><i class="fas fa-horizontal-rule"></i></span> Sharing is caring <span><i class="fas fa-horizontal-rule"></i></span><span><i class="fas fa-horizontal-rule"></i></span></h3>
    </header>

    <!-- blog page -->
    <div class="blog-content">
        <div class="row">
            <div class="blog-left">
                <img src="assets/img/certificate.jpg" alt="">
                <h2>Recommended post</h2>
                <?php
                echo "<ul>";
                foreach ($posts as $post) {
                    echo "<li class='recommend'><a style='font-size: 21px'>" . $post->title . "</a><br/>Author: ".$post->user->username."<br/>Tags: ";
                    foreach($post->tags as $tag) {
                        echo $tag->name."/ ";
                    }
                    echo "</li><br/>";
                }
                echo "</ul>";
                ?>

                <div class="comment-box">
                    <h3>Leave a comment</h3>
                    <form action="submit" class="comment-form">
                        <input type="text" style="width: 100%; border:none" name="" id="" placeholder="Enter Name">
                        <input type="email" style="width: 100%; border:none" placeholder="Enter email">
                        <textarea rows="5" placeholder="Your comment"></textarea>
                        <button class="hero-btn red-btn">POST COMMENT</button>
                    </form>
                </div>

            </div>
            <div class="blog-right">
                <h3>Post Tags</h3>
                <div id="tags">
                    <?php
                    foreach ($tags as $tag) {
                        if ($tag->count != 0) {
                            echo "<div class='tag'><span>" . $tag->name . "</span>";
                            echo "<span>" . $tag->count . "</span></div>";
                        }
                    }
                    ?>
                </div>
                <br>
                <div>
                    <button class="button-login" onclick="createPost()" style="width:100%"><span><i class="fas fa-pen"></i></span> CREATE POST</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var httpObject = null;
        var posts = null;
        window.onload = async function() {
            var el = document.getElementsByTagName('header');
            el[0].classList.add('sub-header');
            el[0].classList.add('blog');
        }

        function createPost() {
            window.location.href = "?controller=posts&action=post";
        }
    </script>