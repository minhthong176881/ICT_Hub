    <h1>Our courses</h1>

</header>


<!-- course -->

<div class="course">
    <h1>Courses We Offer</h1>
    <p>Lorem ipsum dolor sit amet, asdjfh kcadsjhf askj,sahfdkj.</p>
    <div class="row">
        <?php
            $appeared = [];
            for ($i = 1; $i <= 4; $i++) {
                $index = rand(0, count($subjects) - 1);
                echo "<div class='course-col'>";
                echo "<h3>".$subjects[$index]->name."</h3>";
                echo "<p>".$subjects[$index]->description."</p>";
                echo "</div>";
            }
        ?>
    </div>
</div>

<div class="semester">
        
</div>

<script>
    window.onload = function() {
        var el =document.getElementsByTagName('header');
        el[0].classList.add('sub-header');
        el[0].classList.add('course-header');
    }
</script>