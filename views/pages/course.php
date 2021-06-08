    <div class="text-box">
        <h1>Our courses</h1>
    </div>

    </header>


    <!-- course -->

    <div class="course">
        <h1>Courses We Offer</h1>
        <p>Lorem ipsum dolor sit amet, asdjfh kcadsjhf askj,sahfdkj.</p>
        <div class="row">
            <?php
            $appeared = [];
            for ($i = 1; $i <= 6; $i++) {
                do {
                    $index = rand(0, count($subjects) - 1);
                } while (in_array($index, $appeared));
                echo "";
                echo "<div class='course-col'>";
                echo "<a style='color:black;' href='?controller=pages&action=subject&id=" . $subjects[$index]->_id . "'><h3>" . $subjects[$index]->name . "</h3>";
                echo "<div class='subject-preview' style='display: flex'>";
                echo "<div class='left-preview'><p>" . $subjects[$index]->description . "</p></div>"; ?>
                <div class="right-preview"><img style="width: 200px;height: 300px; border-radius: 10px" src="<?php if (!empty($subjects[$index]->lecturer->avatar)) echo $subjects[$index]->lecturer->avatar ?>" alt="">
                    <div class="lecturer-info" style="text-align: left;">
                        <p><b>Lecturer:</b> <?php echo $subjects[$index]->lecturer->name ?></p>
                        <p><b>Department:</b> <?php echo $subjects[$index]->lecturer->department->name ?></p>
                        <p><b>Email:</b>
                            <?php
                            for ($j = 0; $j < count($subjects[$index]->lecturer->email); $j++) {
                                if (!empty($subjects[$index]->lecturer->email[$j])) {
                                    if ($j != count($subjects[$index]->lecturer->email) - 1)
                                        echo $subjects[$index]->lecturer->email[$j] . "| ";
                                    else echo $subjects[$index]->lecturer->email[$j];
                                }
                            }
                            ?>
                        </p>
                        <p><b>Web:</b> <a href="<?php echo $subjects[$index]->lecturer->detail ?>" target="_blank"><?php echo $subjects[$index]->lecturer->detail ?></a></p>
                    </div>
                </div>
            <?php
                echo "</div></a>";
                echo "</div>";
                array_push($appeared, $index);
            }
            ?>
        </div>
    </div>

    <div class="semester">

    </div>

    <script>
        window.onload = function() {
            var el = document.getElementsByTagName('header');
            el[0].classList.add('sub-header');
            el[0].classList.add('course-header');
        }

        function select(id) {
            window.location.href = "?controller=pages&action=subject&id=" + id;
        }
    </script>