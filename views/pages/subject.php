<h1 style="text-align: left; margin-left: 6%"><?php echo $subject->name; ?></h1><br>
</header>
<div style="display: flex">
    <div class="subject-content" style="width: 20%; margin-left: 2%; margin-top: 2%; padding: 10px; border-right: 1px #777777 solid">
        <?php
        $index = 1;
        foreach ($articles as $article) {
            if ($article->_id == $selectedArticle->_id) {
                echo '<div class="article-list selected-article"><a href="?controller=pages&action=subject&id=' . $subject->_id . '&articleId=' . $article->_id . '">' . $index . '. ' . $article->title . '</a></div><br>';    
            }
            else echo '<div class="article-list"><a href="?controller=pages&action=subject&id=' . $subject->_id . '&articleId=' . $article->_id . '">' . $index . '. ' . $article->title . '</a></div><br>';
            $index++;
        }
        ?>
    </div>
    <div class="article-content" style="max-width: 74%; margin-left: 2%; margin-top: 2%; padding: 20px">
        <?php
        if (is_null($selectedArticle))
            echo $articles[0]->html;
        else echo $selectedArticle->html;
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