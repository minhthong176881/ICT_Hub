<h1 style="text-align: left; margin-left: 6%">
    <?php
    if (isset($semester) && isset($subject)) {
        echo "<a style='font-size: 36px; color: white; font-weight: 600' href='?controller=pages&action=semester&id=" . $semester->_id . "'>" . $semester->name . "</a> <span><i class='fad fa-chevron-double-right'></i></span> ";
        echo $subject->name;
    }
    ?></h1><br>
</header>
<div style="display: flex">
    <div class="subject-content">
        <?php
        if (isset($articles)) {
            if (count($articles) >= 1) {
                $index = 1;
                foreach ($articles as $article) {
                    if ($article->_id == $selectedArticle->_id) {
                        echo '<div class="article-list selected-article"><a href="?controller=pages&action=subject&id=' . $subject->_id . '&articleId=' . $article->_id . '">' . $index . '. ' . $article->title . '</a></div><br>';
                    } else echo '<div class="article-list"><a href="?controller=pages&action=subject&id=' . $subject->_id . '&articleId=' . $article->_id . '">' . $index . '. ' . $article->title . '</a></div><br>';
                    $index++;
                }
            }
        }
        ?>
    </div>
    <div class="article-content">
        <?php
        if (isset($articles)) {
            if (count($articles) >= 1) {
                if (is_null($selectedArticle))
                    echo $articles[0]->html;
                else echo $selectedArticle->html;
            } else echo '<h1>No content.</h1>';
        }
        ?>
    </div>
</div>
<script>
    window.onload = function() {
        var el = document.getElementsByTagName('header');
        el[0].classList.add('sub-header');
        el[0].classList.add('semester-header');
    }
</script>