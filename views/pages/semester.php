<h1 style="text-align: left; margin-left: 6%"><?php echo $semester->name; ?></h1><br>
</header>
    <div class="semester-content">
        <?php 
            foreach($subjects as $subject) {
                echo '<div class="subject-list"><a href="?controller=pages&action=subject&id='.$subject->_id.'">'.$subject->name.'</a></div><br>';
            }
        ?>
    </div>
<script>
     window.onload = function() {
            var el = document.getElementsByTagName('header');
            el[0].classList.add('sub-header');
            el[0].classList.add('semester-header');
        }
</script>