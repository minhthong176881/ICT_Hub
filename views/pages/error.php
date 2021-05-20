</header>
<div style="text-align: center; margin-top: 30px">
<?php
echo "<h1>Oh no! An error occured!</h1>";
?>
</div>
<script>
    window.onload = function() {
        el = document.getElementsByTagName('nav');
        head = document.getElementsByTagName('header');
        el[0].classList.add('navbar');
        head[0].classList.add('error');
    }
</script>