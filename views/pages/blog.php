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
                $appeared = [];
                for ($i = 1; $i <= 5; $i++) {
                    do {
                        $index = rand(0, count($posts) - 1);
                    } while (in_array($index, $appeared));
                    echo "<li class='recommend'><a style='font-size: 21px' href='?controller=posts&action=detail&id=" . $posts[$index]->_id . "'>" . $posts[$index]->title . "</a><br/>Author: " . $posts[$index]->author->given_name . "<br/>Tags: ";
                    for ($j = 0; $j < count($posts[$index]->tags); $j++) {
                        if ($j != count($posts[$index]->tags) - 1)
                            echo "<a href='?controller=posts&action=tag&tag=" . $posts[$index]->tags[$j]->name . "'>" . $posts[$index]->tags[$j]->name . "</a>| ";
                        else echo "<a href='?controller=posts&action=tag&tag=" . $posts[$index]->tags[$j]->name . "'>" . $posts[$index]->tags[$j]->name . "</a>";
                    }
                    array_push($appeared, $index);
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
                        if ($tag->count != 0) { ?>
                            <div class='tag' onclick="window.location.href='?controller=posts&action=tag&tag=<?php echo $tag->name ?>'"><span><?php echo $tag->name ?></span>
                                <span><?php echo $tag->count ?></span>
                            </div>
                    <?php }
                    }
                    ?>
                </div>
                <br>
                <div>
                    <?php
                    if (isset($_SESSION['userId']))
                        echo '<button class="button-login" onclick="createPost()" style="width:100%"><span><i class="fas fa-pen"></i></span> CREATE POST</button>';
                    else echo '<button class="button-login" onclick="loginToPost()" style="width:100%"><span><i class="fas fa-pen"></i></span> CREATE POST</button>';
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = async function() {
            var el = document.getElementsByTagName('header');
            el[0].classList.add('sub-header');
            el[0].classList.add('blog');
        }

        function createPost() {
            window.location.href = "?controller=posts&action=post";
        }

        function loginToPost() {
            window.location.href = "?controller=users&action=login";
        }
    </script>