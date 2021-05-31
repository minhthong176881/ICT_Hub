<h1 style="text-align: left; margin-left: 6%">Search Results for: <?php echo $query ?></h1><br>
</header>
<div class="search-content">
    <div class="left">
        <div class="semester-section">
            <div class="section">
                <h4>Semesters</h4>
            </div>
            <?php
            if (count($semesters) == 0) echo "No result!";
            else {
                foreach ($semesters as $semester) {
                    echo "<a href='?controller=pages&action=semester&id=" . $semester->_id . "'>" . $semester->name . "</a><br>";
                }
            }
            ?>
        </div>
        <div class="subject-section">
            <div class="section">
                <h4>Subjects</h4>
            </div>
            <?php
            if (count($subjects) == 0) echo "No result!";
            else {
                foreach ($subjects as $subject) {
                    echo "<a href='?controller=pages&action=subject&id=" . $subject->_id . "'>" . $subject->name . "</a><br>";
                }
            }
            ?>
        </div>
        <div class="article-section">
            <div class="section">
                <h4>Articles</h4>
            </div>
            <?php
            if (count($articles) == 0) echo "No result!";
            else {
                foreach ($articles as $article) {
                    echo "<a href='?controller=pages&action=subject&articleId=" . $article->_id . "'>" . $article->title . "</a><br>";
                }
            }
            ?>
        </div>
    </div>
    <div class="mid">
        <div class="post-section">
            <div class="section">
                <h4>Posts</h4>
            </div>
            <?php
            if (count($posts) == 0) echo "No reult!";
            else {
                foreach ($posts as $post) {
                    echo "<a href='?controller=posts&action=detail&id=" . $post->_id . "'>" . $post->title . "</a><br>";
                }
            }
            ?>
        </div>
        <div class="tag-section">
            <div class="section">
                <h4>Tags</h4>
            </div>
            <?php
            if (count($tags) == 0) echo "No result!";
            else {
                foreach ($tags as $tag) {
                    echo "<a href='?controller=posts&action=tag&tag=" . $tag->name . "'>" . $tag->name . "</a><br>";
                }
            }
            ?>
        </div>
    </div>
    <div class="right">
        <div class="user-section">
            <div class="section">
                <h4>Users</h4>
            </div>
            <?php
            if (count($users) == 0) echo "No result!";
            else {
                foreach ($users as $user) {
                    echo "<a href='?controller=pages&action=semester&id=" . $user->_id . "'>" . $user->family_name . " " . $user->given_name . "</a><br>";
                }
            }
            ?>
        </div>
    </div>
</div>
<script>
    window.onload = function() {
        var el = document.getElementsByTagName('header');
        el[0].classList.add('sub-header');
        el[0].classList.add('search-header');
    }
</script>